<?php
session_start(); // Start the session

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

$data = $_SESSION['data'];
$email = $data['email'];


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered PIN from the form
    $enteredPin = $_POST["pin"];

    // Retrieve the user's email address
    // Replace $email, $firstname, $lastname with the actual variables containing the email and user details
    $userEmail = $email;

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
            header("Location: /LibMSv1/func/change_pass.php");
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