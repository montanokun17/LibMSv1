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
// Include PHPMailer library
require 'D:/xampp/htdocs/LibMSv1/resources/mail/phpmailer/PHPMailerAutoload.php';

// Check if the logout parameter is set
if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: /LibMSv1/main/login.php');
    exit();
}
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
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/func/css/a_email_pin.css">
    <!--Link for NAVBAR and Sidebar CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/css/navbar-sidebar.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMSv1/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMSv1/resources/fonts/fonts.css"/>

</head>

<body>

<!--NAVBAR START-->
<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="#" width="40px" height="40px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/LibMSv1/users/admin/index.php"><i class="fa-solid fa-user fa-xs"></i> Profile Card</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMSv1/users/admin/pages/profile/manageusers.php"></i><i class="fa-solid fa-users fa-xs"></i> Accounts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMSv1/users/admin/pages/books/books.php"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMSv1/users/admin/pages/database/database.php"><i class="fa-solid fa-database fa-sm"></i> Database</a>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="?logout=true"><i class="fa-solid fa-right-from-bracket fa-xs"></i> Logout</a>
              </li>
            </ul>

            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/LibMSv1/users/admin/index.php">
                    <img src="/LibMSv1/resources/images/user.png" 
                    width="40" height="40" style="border:1px solid #000000;" class="rounded-circle">
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
<!--NAVBAR END-->

<!--SIDEBAR START-->
<div class="area"></div><nav class="main-menu">
        <ul>
            <li>
                <a href="/LibMSv1/users/admin/index.php">
                    <i class="fa fa-user fa-md"></i>
                    <span class="nav-text">
                       Profile Card
                    </span>
                </a>
              
            </li>
            <li>
              <a href="/LibMSv1/users/admin/pages/profile/profilesetting.php">
                  <i class="fa fa-cogs fa-md"></i>
                   <span class="nav-text">
                       Profile Settings
                   </span>
               </a>
           </li>
           <li>
            <a href="/LibMSv1/users/admin/pages/profile/manageusers.php">
                <i class="fa fa-users fa-md"></i>
                 <span class="nav-text">
                     Manage Accounts
                 </span>
             </a>
         </li>
         <li>
          <li class="has-subnav">
              <a href="/LibMSv1/users/admin/pages/qrpages/qrpage.php">
                 <i class="fa fa-solid fa-qrcode fa-md"></i>
                  <span class="nav-text">
                      QR Code
                  </span>
              </a>
             
          </li>
            <li class="has-subnav">
                <a href="/LibMSv1/users/admin/pages/messages/messages.php">
                   <i class="fa fa-comments fa-md"></i>
                    <span class="nav-text">
                        Messages
                    </span>
                </a>
                
            </li>
            <li>
              <a href="/LibMSv1/users/admin/pages/messages/sendmessage.php">
                  <i class="fa fa-message fa-md"></i>
                  <span class="nav-text">
                     Send Message
                  </span>
              </a>
          </li>
            <li>
                <a href="/LibMSv1/users/admin/pages/books/books.php">
                    <i class="fa fa-book fa-md"></i>
                    <span class="nav-text">
                       All Books
                    </span>
                </a>
            </li>
            <li>
              <li>
                <a href="/LibMSv1/users/admin/pages/books/addbook.php">
                    <i class="fa fa-plus fa-md"></i>
                    <span class="nav-text">
                       Add Books
                    </span>
                </a>
            </li>
            <li>
              <a href="/LibMSv1/users/admin/pages/requests/requests.php">
                  <i class="fa fa-bars fa-md"></i>
                  <span class="nav-text">
                     Issue/Return Requests
                  </span>
              </a>
          </li>
          <li>
            <a href="/LibMSv1/users/admin/pages/recents/current_issue.php">
                <i class="fa fa-book fa-md"></i>
                <span class="nav-text">
                   Currently Issued Books
                </span>
            </a>
        </li>
        <li>
          <a href="/LibMSv1/users/admin/pages/recents/prev_borrowed.php">
              <i class="fa fa-book fa-md"></i>
              <span class="nav-text">
                 Previously Borrowed Books
              </span>
          </a>
      </li>
      <li>
        <a href="/LibMSv1/users/admin/pages/recents/recent_deletion.php">
            <i class="fa fa-trash fa-md"></i>
            <span class="nav-text">
               Recent Deletion Books
            </span>
        </a>
    </li>
  </ul>
</ul>

        <ul class="logout">
            <li>
               <a href="?logout=true">
                     <i class="fa fa-right-from-bracket fa-md"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>  
        </ul>
    </nav>
<!--SIDEBAR END-->

    <!--MAIN CARD START-->
    <div class="formcard">
        <div class="container">
            <h3 class="title"><i class="fa-solid fa-key fa-md"></i> Enter Email-Sent PIN to Proceed...</h3>
            <hr>
            <div class="col-md-6">
                <form method="POST" action="a_verify_pin.php">
                    <label for="pin">Enter the E-mail sent Pin:</label>
                    <div class="form-group"><input type="text" name="pin" placeholder="Enter Pin Here.." required=""></div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!--MAIN CARD END-->

</body>
</html>

<?php

// Check if the button is clicked
    // Generate random 6-digit token PIN
    $tokenPin = rand(100000, 999999);

    // User's email address (you can retrieve it from the database)
    $userEmail = $email;
    $userFirstName = $firstname;
    $userLastName = $lastname;

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
                        <img src="https://ibb.co/JjVXDFs" alt="MyLibro" width="200" style="display: block;">
                        <h2 style="font-size: 24px; color: #333333; margin-top: 10px;">MyLibro - Library Management System</h2>
                        <h2 style="font-size: 32px; color: #333333; margin-top: 30px;">Password PIN Verification</h2>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
                        <p style="font-size: 16px; color: #333333;">Dear ' . $userFirstName . ' ' . $userLastName . ',</p>
                        <p style="font-size: 16px; color: #333333;">Your verification PIN is: <strong>' . $tokenPin . '</strong></p>
                        <p style="font-size: 16px; color: #333333;">Please enter this PIN to proceed with the verification process. This PIN is 
                        only available for 5 minutes.</p>
                        <p style="font-size: 10px; color: #333333;">Note: If you do not recognize this activity, disregard this email.</p>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#4ca847" style="padding: 10px 30px; color: #ffffff; font-size: 12px; text-align: center;">
                        Montano, Niel Carl C. | <b>MyLibro - Virtual Library Management System &copy; 2023</b>
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