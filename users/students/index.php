<?php
session_start(); // Start the session

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
 

// Initialize variables with default values
$firstname = "";
$lastname = "";
$acctype = "";
$email = "";
$idNo = "";
$username = "";

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
        $acctype = $row['acctype'];
        $username = $row['username'];
        $email = $row['email'];
        
    } else {
        // Handle case when user is not found
        // For example, redirect to an error page or display an error message
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student - Profile Card</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS of Navbar and Sidebar-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/students/css/navbar-sidebar.css"/>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/css/index.css">
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
                <a class="nav-link active" aria-current="page" href="/LibMSv1/users/students/index.php"><i class="fa-solid fa-user fa-xs"></i> Profile Card</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMSv1/users/"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket fa-xs"></i> Logout</a>
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
                <a href="/LibMSv1/users/students/index.php">
                    <i class="fa fa-user fa-md"></i>
                    <span class="nav-text">
                       Profile Card
                    </span>
                </a>
            </li>
            <li>
              <a href="">
                <i class="fa fa-solid fa-gear fa-md"></i>
                  <span class="nav-text">
                     Profile Settings
                  </span>
              </a>
          </li>
            <li>
              <a href="">
                <i class=" fa fa-regular fa-envelope fa-md"></i>
                   <span class="nav-text">
                       Messages
                   </span>
               </a>
           </li>
           <li>
            <a href="">
                <i class=" fa fa-solid fa-book fa-md"></i>
                 <span class="nav-text">
                     Books
                 </span>
             </a>
         </li>
         <li>
          <li class="has-subnav">
              <a href="">
                 <i class="fa fa-solid fa-qrcode fa-md"></i>
                  <span class="nav-text">
                      My QR Code
                  </span>
              </a>
             
          </li>
            <li class="has-subnav">
                <a href="">
                    <i class="fa fa-solid fa-id-card fa-md"></i>
                    <span class="nav-text">
                        My ID Card
                    </span>
                </a>
            </li>
          <li>
              <a href="">
                <i class="fa fa-solid fa-clock-rotate-left fa-md"></i>
                  <span class="nav-text">
                     Interaction History
                  </span>
              </a>
          </li>
  </ul>
</ul>

        <ul class="logout">
            <li>
               <a href="#">
                     <i class="fa fa-right-from-bracket fa-md"></i>
                    <span class="nav-text">
                        Logout
                    </span>
                </a>
            </li>  
        </ul>
    </nav>
<!--SIDEBAR END-->

    <!--PROFILE CARD START-->
    <div class="profcard">
      <div class="card">
        <img src="/LibMSv1/resources/images/user.png" style="width:100%">
        <h3><?php echo $firstname. ' '. $lastname; ?></h3>
        <p class="title">ID Number: <?php echo $idNo; ?></p>
        <p><b><em>Account Role Type: <?php echo $acctype?></em></b></p>
        <p class="profinfo">Username: </p>
        <p><em><?php echo $username?></em></p>
        <p class="profinfo">Email: </p>
        <p><em> <?php echo $email?></em></p>
        <p><a href=""><button>Account Info</button></a></p>
      </div>  
    </div>
    <!--PROFILE CARD END-->

    <!--MAIN CARD START-->
      
    <!--MAIN CARD END-->

</body>
</html>