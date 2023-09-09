<?php

session_start();

$servername = "localhost"; // Replace with your server name if different
$user_name = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "libsys"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $user_name, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $con_num = $_POST['con_num'];
    $password = $_POST['password'];
    $acctype = $_POST['acctype'];
    $schlvl = $_POST['schlvl'];
    $brgy = $_POST['brgy'];

    // Prepare and bind the SQL query to check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? and con_num = ?");
    $stmt->bind_param("ss", $email, $con_num);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email already exists in the database
        echo "<script>alert('Email or Contact Number is already in use. Please choose a different one.');</script>";
    } else {
        // Email does not exist, proceed with account creation

        // Hash the password using bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepare and bind the SQL query with placeholders
        $stmt = $conn->prepare("INSERT INTO users (username, firstname, lastname, email, con_num, password, acctype, schlvl, brgy, status) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active')");
        $stmt->bind_param("sssssssss", $username, $firstname, $lastname, $email, $con_num, $hashedPassword, $acctype, $schlvl, $brgy);

        // Execute the prepared statement
        if ($stmt->execute()) {
            // Data insertion successful
            echo "<script>alert('Account created successfully.');</script>";

            // Get the inserted user's ID from the database
            $idNo = $stmt->insert_id;

            // Set up session data for future login
            $_SESSION['acctype'] = $acctype;
            $_SESSION['id_no'] = $idNo;
            $_SESSION['username'] = $username;

            // Redirect to appropriate page based on the user's account type
            if ($acctype === 'Admin') {
                // Redirect to the admin page
                header('Location: /LibMSv1/users/admin/index.php');
                exit();
            } elseif ($acctype === 'Student') {
                header('Location: /LibMSv1/users/students/index.php');
                exit();
            } elseif ($acctype === 'Librarian') {
                // Redirect to the librarian page
                header('Location: librarian-page.php');
                exit();
            } elseif ($acctype === 'Guest') {
                // Redirect the user to the student portal after successful registration
                header('Location: guest-page.php');
                exit();
            }
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - LMS </title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/main/css/signup.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMSv1/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMSv1/resources/fonts/fonts.css"/>

</head>

<body>
    <div class="createform">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><b>Sign up:</b></div>
                                    <div class="createacc">
                                        <form action="#" method="post">
                                            <div class="form-group"><input type="text" Name="firstname" id="firstname" placeholder="First Name" required=""></div>
                                            <div class="form-group"><input type="text" Name="lastname" id="lastname" placeholder="Last Name" required=""></div>
                                            <div class="form-group"><input type="text" Name="username" id="username" placeholder="Username" required=""></div>
                                            <div class="form-group"><input type="text" Name="email" id="email" placeholder="Email" required=""></div>
                                            <div class="form-group"><input type="text" Name="con_num" id="con_num" placeholder="Contact Number" required=""></div>
                                            <div class="form-group"><input type="password" Name="password" id="password" placeholder="Password" required=""></div>
                                            <label for="acctype">Account Type: </label>
                                                <select name="acctype" class="form-select" id="acctype">
                                                    <option selected disabled>Select Account Type</option>
                                                    <option value="Student">Student</option>
                                                    <option value="Guest">Guest</option>
                                                </select>

                                            
                                            <label for="schlvl">School Level: </label>
                                                <select name="schlvl" class="form-select" id="schlvl">
                                                    <option selected disabled>Select School Level</option>
                                                    <option value="Elementary">Elementary</option>
                                                    <option value="Junior High School">Jr. High School</option>
                                                    <option value="Senior High School">Sr. High School</option>
                                                    <option value="College">College</option>
                                                    <option value="Graduate">Graduate</option>
                                                    <option value="Guest">Guest</option>
                                                </select>

                                            
                                                <label for="brgy">Barangay: </label>
                                                    <select name="brgy" class="form-select" id="brgy">
                                                        <option selected disabled>Select a Barangay</option>
                                                        <option value="Bagong Ilog">Bagong Ilog</option>
                                                        <option value="Bagong Katipunan">Bagong Katipunan</option>
                                                        <option value="Bambang">Bambang</option>
                                                        <option value="Buting">Buting</option>
                                                        <option value="Caniogan">Caniogan</option>
                                                        <option value="Dela Paz">Dela Paz</option>
                                                        <option value="Kalawaan">Kalawaan</option>
                                                        <option value="Kapasigan">Kapasigan</option>
                                                        <option value="Kapitolyo">Kapitolyo</option>
                                                        <option value="Malinao">Malinao</option>
                                                        <option value="Manggahan">Manggahan</option>
                                                        <option value="Maybunga">Maybunga</option>
                                                        <option value="Orando">Orando</option>
                                                        <option value="Palatiw">Palatiw</option>
                                                        <option value="Pinagbuhatan">Pinagbuhatan</option>
                                                        <option value="Pineda">Pineda</option>
                                                        <option value="Rosario">Rosario</option>
                                                        <option value="Sagad">Sagad</option>
                                                        <option value="San Antonio">San Antonio</option>
                                                        <option value="San Joaquin">San Joaquin</option>
                                                        <option value="San Jose">San Jose</option>
                                                        <option value="San Miguel">San Miguel</option>
                                                        <option value="San Nicolas">San Nicolas</option>
                                                        <option value="Santa Cruz">Santa Cruz</option>
                                                        <option value="Santa Lucia">Santa Lucia</option>
                                                        <option value="Santa Rosa">Santa Rosa</option>
                                                        <option value="Santo Tomas">Santo Tomas</option>
                                                        <option value="Santolan">Santolan</option>
                                                        <option value="Sumilang">Sumilang</option>
                                                        <option value="Ugong">Ugong</option>
                                                    </select>


                                              <script>
                                                var acctype = document.getElementById("acctype");
                                                var schlvl = document.getElementById("schlvl");

                                                acctype.addEventListener("change", function() {
                                                if (acctype.value === "Librarian" || acctype.value === "Guest") {
                                                    schlvl.disabled = true;
                                                    schlvl.selectedIndex = 0; // clears the selection of the schlvl dropdown
                                                } else {
                                                    schlvl.disabled = false;
                                                }
                                                });

                                                </script>

                                            <div class="container">
                                                <p style="font-weight: bold; font-size: 13px;"><i>Note: Please Remember your Account ID Number</i></p>
                                            </div>

                                            <div class="send-button">
                                                <button type="submit" class="btn btn-primary col-md-12"><i class="fa-solid fa-user-plus"></i> Create Account</button>
                                            </div>
                                            <hr>
                                            <a href="/LibMSv1/index.php">
                                                <button type="button" class="btn btn-primary col-md-12">
                                                    <i class="fa-solid fa-rotate-left fa-sm"></i> Go Back</button>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>

