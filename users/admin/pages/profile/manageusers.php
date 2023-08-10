<?php
session_start();

$servername = "localhost"; // Replace with your server name if different
$user_name = "root"; // Replace with your database username
$Password = ""; // Replace with your database password
$database = "libsys"; // Replace with your database name

// Create a connection
$conn = new mysqli($servername, $user_name, $Password, $database);

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

// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Get the submitted login credentials (username and password)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user details from the database based on the provided username
    $stmt = $conn->prepare("SELECT id_no, password, status FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword, $status);

    if ($stmt->fetch()) {
        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Check if the user's account is disabled
            if ($status === 'Disabled') {
                echo "<script>alert('Your account is disabled. Please contact the administrator.');</script>";
            } else {
                // Login successful
                // Set session variables or any other login actions here
                // Redirect to the appropriate page after login
            }
        } else {
            // Incorrect password
            echo "<script>alert('Incorrect username or password.');</script>";
        }
    } else {
        // User not found in the database
        echo "<script>alert('Incorrect username or password.');</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['disable'])) {
    $userId = $_POST['user_id'];
    
    // Update the user's status to "Disabled"
    $stmt = $conn->prepare("UPDATE users SET status = 'Disabled' WHERE id_no = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Disable action successful
        echo "<script>alert('Account enabled successfully.');</script>";
        header ("Location: /LibMSv1/users/admin/pages/profile/manageusers.php");
    } else {
        // Error occurred while disabling the account
        echo "<script>alert('Error: Unable to enable account.');</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enable'])) {
    $userId = $_POST['user_id'];
    
    // Update the user's status to "Disabled"
    $stmt = $conn->prepare("UPDATE users SET status = 'Active' WHERE id_no = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Disable action successful
        echo "<script>alert('Account enabled successfully.');</script>";
        header ("Location: /LibMSv1/users/admin/pages/profile/manageusers.php");
    } else {
        // Error occurred while disabling the account
        echo "<script>alert('Error: Unable to enable account.');</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Check if the delete button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userId = $_POST['user_id'];

    // Delete the user's account
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        // Account deletion successful
        echo "<script>alert('Account deleted successfully.');</script>";
    } else {
        // Error occurred while deleting the account
        echo "<script>alert('Error: Unable to delete account.');</script>";
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
    <title>Admin - Accounts</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/pages/profile/css/manageusers.css">
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
                <a class="nav-link active" href="/LibMSv1/users/admin/pages/profile/manageusers.php"></i><i class="fa-solid fa-users fa-xs"></i> Accounts</a>
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
        <!--Table start-->
            <div class="container">
                <div class="search-bar">
                    <form method="GET" action="">
                        <input type="text" name="search_query" class="search" placeholder ="Search for ID Number, Name, Username, email..">
                        <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa-solid fa-search fa-sm"></i> Search</button>
                        &nbsp;
                    </form>

                <label for="account_type" id="dropdown1"><i class="fa-solid fa-filter"></i> <b>Filter Account Types: </b></label>
                    <select name="acctype" id="acctype">
                        <option selected disabled>Select a Account Type</option>
                        <option value="admin">Admin</option>
                        <option value="librarian">Librarian</option>
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                    </select>
                    &nbsp;
                

                <label for="status" id="dropdown2"><i class="fa-solid fa-filter fa-sm"></i> <b>Filter Status: </b></label>
                    <select name="status" id="status">
                        <option selected disabled>Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Disabled">Disabled</option>
                    </select>
                </div>

                <?php
                
                // Check if the search query is submitted
                if (isset($_GET['search'])) {
                    // Get the search query from the input field
                    $searchQuery = $_GET['search_query'];

                    // Modify the query to include the search condition
                    $query = "SELECT * FROM users WHERE id_no LIKE '%$searchQuery%'
                            OR firstname LIKE '%$searchQuery%'
                            OR lastname LIKE '%$searchQuery%'
                            OR username LIKE '%$searchQuery%'
                            OR brgy LIKE '%$searchQuery%'
                            OR con_num LIKE '%$searchQuery%'
                            OR acctype LIKE '%$searchQuery%'
                            OR status LIKE '%$searchQuery%'
                            ";
                } else {
                    // Default query to fetch all users
                    $query = "SELECT * FROM users";
                }

                function getUsersByPagination($conn, $query, $offset, $limit) {
                    $query .= " LIMIT $limit OFFSET $offset"; // Append the LIMIT and OFFSET to the query for pagination
                    $result = mysqli_query($conn, $query);
                
                    return $result;
                }

                $totalUsersQuery = "SELECT COUNT(*) as total FROM users";
                $totalUsersResult = mysqli_query($conn, $totalUsersQuery);
                $totalUsers = mysqli_fetch_assoc($totalUsersResult)['total'];

                // Number of users to display per page
                $limit = 4;

                // Get the current page number from the query parameter
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                // Calculate the offset for the current page
                $offset = ($page - 1) * $limit;

                // Get the users for the current page
                $result = getUsersByPagination($conn, $query, $offset, $limit);


                // Check if the account type is selected for filtering
                if (isset($_GET['acctype']) && !empty($_GET['acctype'])) {
                    $acctype = $_GET['acctype'];
                    $query .= " AND acctype = '$acctype'"; // Add the account type filter condition to the query
                }

                // Check if the status is selected for filtering
                if (isset($_GET['status']) && !empty($_GET['status'])) {
                    $status = $_GET['status'];
                    $query .= " AND status = '$status'"; // Add the status filter condition to the query
                }

                $result = mysqli_query($conn, $query);

                // Check if the query executed successfully
                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>ID No</th><th>First Name</th><th>Barangay</th><th>Account Type</th><th>Contact Number</th><th>Email</th><th>Username</th><th>Status</th><th>Action</th></tr>";

                    $count = 0; // Counter for the number of rows

                    while ($user = mysqli_fetch_assoc($result)) {
                        $count++;
                        echo "<tr>";
                        echo "<td>".$user['id_no']."</td>";
                        echo "<td>".$user['firstname']." ".$user['lastname']."</td>";
                        echo "<td>".$user['brgy']."</td>";
                        echo "<td>".$user['acctype']."</td>";
                        echo "<td>".$user['con_num']."</td>";
                        echo "<td>".$user['email']."</td>";
                        echo "<td>".$user['username']."</td>";

                        if ($user['status'] === 'Disabled') {
                            // Account is disabled, display disabled status in red
                            echo "<td style='color: red;'>Disabled</td>";
                        } else {
                            echo "<td>".$user['status']."</td>";
                        }

                        echo "<td>";

                        if ($user['status'] === 'Disabled') {
                            // Account is disabled, display enable button
                            echo '
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="'.$user['id_no'].'">
                                <button type="submit" name="enable" style="padding: 3px; background-color: blue;"><i class="fa-solid fa-shield"></i> Enable</button>
                            </form>
                            ';
                        } else {
                            // Account is not disabled, display disable button
                            echo '
                            <form method="POST" action="">
                                <input type="hidden" name="user_id" value="'.$user['id_no'].'">
                                <button type="submit" name="disable" style="padding: 3px; background-color: grey; color: white;"><i class="fa-solid fa-shield"></i> Disable</button>
                            </form>
                            ';
                        }

                        echo '
                        <form method="POST" action="">
                            <input type="hidden" name="user_id" value="'.$user['id_no'].'">
                            <button type="submit" name="delete" style="padding: 3px; background-color: red;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                        ';

                        echo "</td>";
                        echo "</tr>";

                        // Check if the row count is 5
                        if ($count === 4) {
                            break;
                        }
                    }

                    echo "</table>";

                    // Calculate the total number of pages
                    $totalPages = ceil($totalUsers / $limit);

                    if ($totalPages > 1) {
                        echo '
                        <div class="pagination-buttons">
                            ';
                
                        if ($page > 1) {
                            echo '<a href="?page='.($page - 1).'" class="btn btn-primary btn-sm" id="previous"><i class="fa-solid fa-angle-left"></i> Previous</a>';
                        }
                
                        if ($page < $totalPages) {
                            echo '<a href="?page='.($page + 1).'" class="btn btn-primary btn-sm" id="next">Next <i class="fa-solid fa-angle-right"></i></a>';
                        }
                
                        echo '
                        </div>
                        ';
                    }
                } else {
                    echo "No users found.";
                }
                ?>

                
                <script>
                    // JavaScript function for handling pagination buttons
                    document.addEventListener("DOMContentLoaded", function () {
                        const previousBtn = document.getElementById("previous");
                        const nextBtn = document.getElementById("next");

                        if (previousBtn) {
                            previousBtn.addEventListener("click", function () {
                                // Go to the previous page by decrementing the current page number
                                let currentPage = parseInt("<?php echo $page; ?>");
                                if (currentPage > 1) {
                                    currentPage--;
                                    window.location.href = "?page=" + currentPage;
                                }
                            });
                        }

                        if (nextBtn) {
                            nextBtn.addEventListener("click", function () {
                                // Go to the next page by incrementing the current page number
                                let currentPage = parseInt("<?php echo $page; ?>");
                                let totalPages = parseInt("<?php echo $totalPages; ?>");
                                if (currentPage < totalPages) {
                                    currentPage++;
                                    window.location.href = "?page=" + currentPage;
                                }
                            });
                        }
                    });
                </script>


    <!--Table end-->
    

    <!--MAIN CARD END-->

</body>
</html>