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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['ConfPassword'];

    // Verify if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirm password do not match.');</script>";
        exit;
    }

    // Check if the current password matches the one in the database
    $sql = "SELECT password FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if (password_verify($currentPassword, $storedPassword)) {
            // Hash the new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
            if ($conn->query($updateSql) === TRUE) {
                echo "<script>alert('Password changed successfully.');</script>";
                header ("Location: /LibMSv1/main/login.php");
            } else {
                echo "<script>alert('Error updating password: . $conn->error. ');</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Enter Email</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/func/css/change_pass.css">
    <!--Link for NAVBAR and Sidebar CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/css/navbar-sidebar.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMSv1/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMSv1/resources/fonts/fonts.css"/>

</head>

<body>

    <!--MAIN CARD START-->
    <div class="logform">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>Enter the Username and Email you've registred your Account with:</b></div>
                            <div class="login">
                            <form method="POST" action="#">
                                <label for="password">Current Password:</label>
                                <div class="form-group"><input type="password" name="password" value="" required=""></div>

                                <label for="newPassword">New Password:</label>
                                <div class="form-group"><input type="password" name="newPassword" value="" required=""></div>

                                <label for="ConfPassword">Confirm Password:</label>
                                <div class="form-group"><input type="password" name="ConfPassword" value="" required=""></div>

                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Password</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--MAIN CARD END-->

</body>
</html>