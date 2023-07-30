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

$FetchEmail = "";
$FetchUsername = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Prepare and execute a database query
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ? AND email = ?');
    $stmt->bind_param('ss', $username, $email);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // User account found, fetch the data
        $data = $result->fetch_assoc();
        $FetchEmail = $data['email'];
        $FetchUsername = $data['username'];

        // Pass the data to the other PHP file
        $_SESSION['data'] = $data;

        // Redirect to the other PHP file
        header("Location: /LibMSv1/func/email_pin.php");
        exit;
    } else {
        // No matching account found
        echo '<script>alert("No accounts were matched with your given credentials.");</script>';
    }
}


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
    <link rel="stylesheet" type="text/css" href="/LibMSv1/func/css/enter_email.css">
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
                                    
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" placeholder="Username" required="">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" name="email" id="email" placeholder="Email" required="">
                                    </div>

                                    <button type="submit" class="btn btn-primary col-md-12">
                                         Next <i class="fa-solid fa-arrow-right fa-sm"></i>
                                    </button>
                                    <hr>
                                    <a href="/LibMSv1/index.php">
                                        <button type="button" class="btn btn-danger col-md-12">
                                             Cancel <i class="fa-solid fa-xmark fa-sm"></i>
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
    <!--MAIN CARD END-->

</body>
</html>