<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "";
$database = "libsys";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    echo '<script>alert("Connection failed: ' . $conn->connect_error . '");</script>';
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $idNo = $_POST['id_no'];
    $password = $_POST['password'];

    // Perform database query to check if the user exists
    $query = "SELECT * FROM users WHERE username = '$username' AND id_no = '$idNo' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $acctype = $row['acctype'];

        // Store user data in the session
        $_SESSION['username'] = $username;
        $_SESSION['acctype'] = $acctype;
        $_SESSION['id_no'] = $idNo;

        // Check the user's account type and redirect accordingly
        if ($acctype === 'admin') {
            // Redirect to the admin page
            header('Location: /LibMSv1/users/admin/index.php');
            exit();
        } elseif ($acctype === 'student') {
            // Redirect to the student page
            header('Location: /LibMSv1/users/students/index.php');
            exit();
        } elseif ($acctype === 'librarian') {
            // Redirect to the librarian page
            header('Location: librarian-page.php');
            exit();
        } elseif ($acctype === 'staff') {
            // Redirect to the staff page
            header('Location: staff-page.php');
            exit();
        }
    } else {
        // Invalid input, account does not exist
        echo '<script>alert("Invalid Input, Account does not exist!");</script>';
    }
}
?>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LMS</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/main/css/login.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMSv1/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMSv1/resources/fonts/fonts.css"/>
</head>
<body>
    
    <div class="logform">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title"><b>Login to your Account:</b></div>
                            <div class="login">
                                <form method="POST" action="/LibMSv1/main/login.php">
                                    <div class="form-group">
                                        <input type="text" name="username" id="id_no" placeholder="Username" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="id_no" id="id_no" placeholder="ID Number">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" placeholder="Password" required="">
                                    </div>

                                    <div class="container">
                                        <p>Can't Remember your Password? <a href="">Forgot Password</a></p>
                                    </div>

                                    <button type="submit" class="btn btn-primary col-md-12">
                                        <i class="fa-solid fa-right-to-bracket"></i> Log In
                                    </button>
                                    <hr>
                                    <a href="/LibMSv1/index.php">
                                        <button type="button" class="btn btn-primary col-md-12">
                                            <i class="fa-solid fa-rotate-left fa-sm"></i> Go Back
                                        </button>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>