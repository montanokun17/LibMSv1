<?php

session_start();

$servername = "localhost";
$user_name = "root";
$password = "";
$database = "libsys";

// Create a connection
$conn = new mysqli($servername, $user_name, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$firstname = "";
$lastname = "";
$username = "";
$email = "";

if ($_SESSION['acctype'] === 'admin') {
    $idNo = $_SESSION['id_no'];
    $username = $_SESSION['username'];

    // Prepare and execute the SQL query
    $query = "SELECT * FROM users WHERE id_no = ? AND username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $idNo, $username);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Retrieve the user's information
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $idNo = $row['id_no'];
        $email = $row['email'];
    }
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered PIN from the form
    $enteredPin = $_POST["pin"];

    // Retrieve the user's email address
    // Replace $email, $firstname, $lastname with the actual variables containing the email and user details
    $userEmail = $email;
    $userFirstName = $firstname;
    $userLastName = $lastname;

    // Retrieve the saved token PIN and timestamp from the database
    // Here, assume you have columns named 'token_pin' and 'pin_timestamp' in the 'users' table
    $stmt = $conn->prepare("SELECT token_pin, pin_timestamp FROM users WHERE email = ?");
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $stmt->bind_result($tokenPin, $pinTimestamp);
    $stmt->fetch();
    $stmt->close();

    // Compare the entered PIN with the saved token PIN
    if ($enteredPin == $tokenPin) {
        // Verify the timestamp to ensure it is within the allowed timeframe (5 minutes)
        $currentTime = time();
        $tokenExpirationTime = strtotime($pinTimestamp) + (5 * 60); // Add 5 minutes to the saved timestamp

        if ($currentTime <= $tokenExpirationTime) {
            // PIN is correct and within the allowed timeframe
            // Redirect the user to the designated page
            header("Location: /LibMSv1/users/admin/func/a_changepass.php");
            exit();
        } else {
            // PIN is correct but has expired
            echo "<script>alert('The PIN has expired. Please request a new PIN.');</script>";
        }
    } else {
        // PIN is incorrect
        echo "<script>alert('Invalid PIN. Please try again.');</script>";
    }
}
?>
