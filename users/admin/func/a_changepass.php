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

 // Retrieve the current user's ID from the session
 $idNo = $_SESSION['id_no'];

 // Check if the new password and confirm password match
 if ($newPassword !== $confPassword) {
     echo "<script>alert('New password and confirm password do not match.');</script>";
 } else {
     // Prepare and bind the SQL query to check the current password
     $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? AND password = ?");
     $stmt->bind_param("is", $idNo, $currentPassword);
     $stmt->execute();
     $result = $stmt->get_result();

     if ($result->num_rows === 1) {
         // Current password is correct, update the password

         // Prepare and bind the SQL query to update the password
         $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
         $stmt->bind_param("si", $newPassword, $idNo);

         if ($stmt->execute()) {
             echo "<script>alert('Password changed successfully.');</script>";
         } else {
             echo "<script>alert('Error: Unable to update password.');</script>";
         }
     } else {
         echo "<script>alert('Current password is incorrect.');</script>";
     }

     // Close the prepared statement
     $stmt->close();
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Change Password</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/func/css/a_changepass.css">
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
            <h3 class="title"><i class="fa fa-solid fa-shield fa-md"></i>Change Password</h3>
            <hr>
            <div class="col-md-6">
                <form method="POST" action="#">
                    <label for="password">Current Password:</label>
                    <div class="form-group"><input type="password" name="password" value="" required=""></div>

                    <label for="newPassword">New Password:</label>
                    <div class="form-group"><input type="password" name="newPassword" value="" required=""></div>

                    <label for="ConfPassword">Confirm Password:</label>
                    <div class="form-group"><input type="password" name="ConfPassword" value="" required=""></div>

                    <button type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Password</button>
                </form>
    <!--MAIN CARD END-->

</body>
</html> 