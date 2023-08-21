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

if (isset($_SESSION['acctype']) && $_SESSION['acctype'] === 'Student') {
    // User logged in or just registered as a student

    if (isset($_SESSION['id_no']) && isset($_SESSION['username'])) {
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
            $acctype = $row['acctype'];
            $email = $row['email'];
            $brgy = $row['brgy'];
            $con_num = $row['con_num'];

            // Update the session variables with fetched data (optional, in case there are changes in the database)
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['acctype'] = $acctype;
            $_SESSION['email'] = $email;
            $_SESSION['brgy'] = $brgy;
            $_SESSION['con_num'] = $con_num;

        } else {
            // Handle case when user is not found
            // For example, redirect to an error page or display an error message
            echo "User not found!";
        }
    } else {
        // Handle case when session data is missing
        // For example, redirect to a login page or display an error message
        echo "Session data missing or user not logged in!";
    }

} else {
    // User is not a student or not logged in
    // Redirect to a login page or display an error message
    echo "User is not logged in as a student!";
}
?>



<?php

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
    <title>Student - Profile Card</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS of Navbar and Sidebar-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/students/css/navbar-sidebar.css"/>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/students/css/index.css">
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
                <a class="nav-link" href="/LibMSv1/users/students/books/books.php"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
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
            <a href="/LibMSv1/users/students/books/books.php">
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

<!--PROFILE CARD START-->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <!-- PROFILE CARD -->
            <div class="card mb-4">
                <img src="/LibMSv1/resources/images/user.png" style="width:100%" alt="User Profile Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $firstname . ' ' . $lastname; ?></h5>
                    <p class="card-text">ID Number: <i><?php echo $idNo; ?></i></p>
                    <p class="card-text">Account Role Type: <i><?php echo $acctype; ?></i></p>
                    <p class="card-text">Username: <i><?php echo $username; ?></i></p>
                    <p class="card-text">Email: <i><?php echo $email; ?></i></p>
                    <p class="card-text">Contact Number: <i><?php echo $con_num; ?></i></p>
                    <a href="/LibMSv1/users/students/" class="btn btn-primary">Account Info</a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <!-- DASHBOARD STATISTICS CARD -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dashboard Statistics</h5>
                    <p class="card-text">Not Yet Available.</p>
                    <!-- You can add charts, graphs, or any other statistics here -->
                    <!-- For example, using JavaScript libraries like Chart.js -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--DASHBOARD PROFILE CARD END-->

    <!--MAIN CARD START-->
      
    <!--MAIN CARD END-->

</body>
</html>