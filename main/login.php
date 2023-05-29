<?php
    require('../dbconn.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form inputs
        $username = $_POST['username'];
        $idNo = $_POST['id_no'];
        $password = $_POST['password'];
        
        // Validate the inputs (you can add more validation if needed)
        if (empty($username) || empty($idNo) || empty($password)) {
        }

        // Authenticate the user (replace this with your own authentication logic)
        // Assuming you have a table named 'users' with columns 'username', 'idNo', 'password', and 'acctype'
        // You would need to modify the SQL query to match your actual table structure
        $query = "SELECT * FROM users WHERE username = '$username' AND idNo = '$idNo' AND password = '$password'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            echo "Invalid input. No such account is existed.";
            exit;
        }
        
        // Redirect based on account type
        $acctype = $row['acctype'];
        switch ($acctype) {
            case 'admin':
                header("Location: /LibMSv1/users/admin/index.php");
                break;
            case 'librarian':
                header("Location: /LibMSv1/users/students/index.php");
                break;
            case 'staff':
                header("Location: staff-page.php");
                break;
            case 'student':
                header("Location: student-page.php");
                break;
            default:
                echo "Invalid type";
                exit;
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LMS </title>
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
                                        <form>
                                            <div class="form-group"><input type="text" Name="username" placeholder="Username" required=""></div>
                                            <div class="form-group"><input type="text" Name="id_no" placeholder="ID Number"></div>
                                            <div class="form-group"><input type="password" Name="password" placeholder="Password" required=""></div>
                                            <button type="submit" class="btn btn-primary col-md-12"><i class="fa-solid fa-right-to-bracket"></i> Log In</button>
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

</body>
</html>