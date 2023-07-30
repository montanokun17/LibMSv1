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

// Retrieve the data from the session
$data = $_SESSION['data'];

$FetchEmail = $data['email'];
$FetchUsername = $data['username'];


/*

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
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Password Pin</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/func/css/email_pin.css">
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
                            <div class="card-title"><b>Enter the PIN you received via Email:</b></div>
                            <div class="login">
                                <form method="POST" action="verify_pin.php">
                                    <div class="form-group">
                                        <input type="text" name="pin" id="pin" placeholder="Enter the PIN" required="">
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


<?php


// Include PHPMailer library
require 'D:/xampp/htdocs/LibMSv1/resources/mail/phpmailer/PHPMailerAutoload.php';

    // Generate random 6-digit token PIN
    $tokenPin = rand(100000, 999999);

    // User's email address (you can retrieve it from the database)
    $userEmail = $FetchEmail;
    $user_uname = $FetchUsername;

    // Save the token PIN and timestamp in the database for verification
    // Here, assume you have columns named 'token_pin' and 'pin_timestamp' in the 'users' table
    $stmt = $conn->prepare("UPDATE users SET token_pin = ?, pin_timestamp = NOW() WHERE email = ?");
    $stmt->bind_param("ss", $tokenPin, $userEmail);
    $stmt->execute();

    // Configure PHPMailer
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.office365.com';  // Set your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'mylibrolibrarymanagementsystem@outlook.com';
    $mail->Password = 'mylibro01';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('mylibrolibrarymanagementsystem@outlook.com', 'MyLibro - Virtual LMS');  // Set the sender's email address and name
    $mail->addAddress($userEmail);  // Add recipient email address

    $mail->isHTML(true);
    $mail->Subject = 'Token PIN Verification';  // Set the email subject
    $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>PIN Verification Email</title>
        </head>
        <body style="font-family: Roboto, Arial;">

            <table align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
                <tr>
                    <td align="center" bgcolor="#4ca847" style="padding: 40px 0 30px 0;">
                        <img src="https://ibb.co/JjVXDFs" alt="MyLibro - Virtual LMS" width="200" style="display: block;">
                        <h2 style="font-size: 24px; color: #333333; margin-top: 10px;">MyLibro - Library Management System</h2>
                        <h2 style="font-size: 32px; color: #333333; margin-top: 30px;">Password PIN Verification</h2>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <p style="font-size: 16px; color: #333333;">Dear ' . $user_uname . ',</p>
                        <p style="font-size: 16px; color: #333333;">Your verification PIN is: <strong>' . $tokenPin . '</strong></p>
                        <p style="font-size: 16px; color: #333333;">Please enter this PIN to proceed with the verification process. This PIN is 
                        only available for 5 minutes.</p>
                        <p style="font-size: 10px; color: #333333;">Note: If you do not recognize this activity, disregard this email.</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#4ca847" style="padding: 10px 30px; color: #ffffff; font-size: 12px; text-align: center;">
                        <b>MyLibro - Virtual Library Management System &copy; 2023</b>
                    </td>
                </tr>
            </table>

        </body>
        </html>
    ';  // Set the email body

    // Send the email
    if ($mail->send()) {
        echo "<script>alert('Email sent successfully!');</script>";
        
    } else {
        echo "<script>alert('Error Sending Email. " . $mail->ErrorInfo . "');</script>";
    }

?>
