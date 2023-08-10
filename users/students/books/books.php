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
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/students/books/css/books.css">
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
                <a class="nav-link" aria-current="page" href="/LibMSv1/users/students/index.php"><i class="fa-solid fa-user fa-xs"></i> Profile Card</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="/LibMSv1/users/students/books/books.php"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
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


<!--TABLE START-->
    <div class="container">
        <hr>
            <div class="search-bar">
                <form method ="GET">
                    <input type="text" class="search" placeholder ="Enter Book Section, Book Name, or Book's Status..">
                    <button type="submit" name="search" class="btn btn-primary btn-sm"><i class="fa-solid fa-search fa-sm"></i> Search</button>
                </form>
            </div>
            

            
                <div class="dropdown1">
                    <label for="booksection">Select Section: </label>
                        <select name="section" id="bsection">
                            <option></option>
                            <option value="fiction">Fiction</option>
                            <option value="mysthril">Mystery/Thriller</option>
                            <option value="rom">Romance</option>
                            <option value="scififan">Science Fiction/Fantasy</option>
                            <option value="horror">Horror</option>
                            <option value="hisfic">Historical Fiction</option>
                            <option value="bioauto">Biography/Autobiography</option>
                            <option value="mem">Memoir</option>
                            <option value="his">History</option>
                            <option value="politics">Politics and Current Events</option>
                            <option value="scitech">Science and Technology</option>
                            <option value="busifin">Business and Finance</option>
                            <option value="perdev">Self-Help and Personal Development</option>
                            <option value="artarchi">Art and Architecture</option>
                            <option value="traveladv">Travel and Adventure</option>
                            <option value="cookbooks">Cookbooks and Food Writing</option>
                            <option value="yngadultfic">Young Adult Fiction</option>
                            <option value="grapnovcomics">Graphic Novels and Comics</option>
                            <option value="poetry">Poetry</option>
                            <option value="religion">Religion and Spiritually</option>
                            <option value="philo">Philosophy</option>
                            <option value="refdic">Reference and Dictionary</option>
                            <option value="forlang">Foreign Languages</option>
                            <option value="others">Others</option>
                        </select>

                    <label for="bookstatus" id="dropdown2">Select Book Status: </label>
                        <select name="status" id="bstatus">
                            <option></option>
                            <option value="GOOD">GOOD</option>
                            <option value="DAMAGED">DAMAGED</option>
                            <option value="DILAPITATED">DILAPITATED</option>
                            <option value="LOST">LOST</option>
                        </select>
            
            <?php

            if (isset($_GET['search'])) {
                // Get the search query from the input field
                $searchQuery = $_GET['search'];

                // Modify the query to include the search condition
                $query = "SELECT * FROM books WHERE
                        isbn LIKE '%$searchQuery%'
                        OR book_title LIKE '%$searchQuery%'
                        OR author LIKE '%$searchQuery%'
                        OR year LIKE '%$searchQuery%'
                        OR subject LIKE '%$searchQuery%'
                        OR section LIKE '%$searchQuery%'
                        OR stocks LIKE '%$searchQuery%'
                        OR author LIKE '%$searchQuery%'
                        OR volume LIKE '%$searchQuery%'
                        ";
            } else {
                // Default query to fetch all books
                $query = "SELECT * FROM books ORDER BY book_id DESC";
            }

            function getBooksByPagination($conn, $query, $offset, $limit) {
                $query .= " LIMIT $limit OFFSET $offset"; // Append the LIMIT and OFFSET to the query for pagination
                $result = mysqli_query($conn, $query);

                return $result;
            }

            $totalBooksQuery = "SELECT COUNT(*) as total FROM books";
            $totalBooksResult = mysqli_query($conn, $totalBooksQuery);
            $totalBooks = mysqli_fetch_assoc($totalBooksResult)['total'];

             // Check if the account type is selected for filtering
             if (isset($_GET['section']) && !empty($_GET['section'])) {
                $acctype = $_GET['section'];
                $query .= " AND section = '$section'"; // Add the account type filter condition to the query
            }

            // Check if the status is selected for filtering
            if (isset($_GET['status']) && !empty($_GET['status'])) {
                $status = $_GET['status'];
                $query .= " AND status = '$status'"; // Add the status filter condition to the query
            }

            // Number of books to display per page
            $limit = 4;

            // Get the current page number from the query parameter
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

            // Calculate the offset for the current page
            $offset = ($page - 1) * $limit;

            // Get the books for the current page
            $result = getBooksByPagination($conn, $query, $offset, $limit);

            // Check if the query executed successfully
            if ($result && mysqli_num_rows($result) > 0) {
                echo '<div class="container">';
                echo '<hr>';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ISBN</th>';
                echo '<th>Book Name</th>';
                echo '<th>Author</th>';
                echo '<th>Year</th>';
                echo '<th>Section</th>';
                echo '<th>Stocks</th>';
                echo '<th>Status</th>';
                echo '<th>Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($book = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $book['isbn'] . '</td>';
                    echo '<td>' . $book['book_title'] . '</td>';
                    echo '<td>' . $book['author'] . '</td>';
                    echo '<td>' . $book['year'] . '</td>';
                    echo '<td>' . $book['section'] . '</td>';
                    echo '<td>' . $book['stocks'] . '</td>';
                    if ($book['status'] == 'GOOD') {
                        echo '<td style="color: green;"><b><i>' . $book['status'] . '</i></b></td>';
                    } else if ($book['status'] == 'DAMAGED') {
                        echo '<td style="color: orange;"><b><i>' . $book['status'] . '</i></b></td>';
                    } else if ($book['status'] == 'DILAPITATED') {
                        echo '<td style="color: red;"><b><i>' . $book['status'] . '</i></b></td>';
                    } else {
                        echo '<td style="color: grey;"><b><i>' . $book['status'] . '</i></b></td>';
                    }
                    echo '<td>';
                    echo '<button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-circle-info fa-sm"></i> Details</button>';
                    echo '<button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-book fa-sm"></i> Borrow</button>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';


                // Calculate the total number of pages
                $totalPages = ceil($totalBooks / $limit);

                if ($totalPages > 1) {
                    // Display previous and next buttons
                    echo '<div class="pagination-buttons">';
                    if ($page > 1) {
                        echo '<a href="?page=' . ($page - 1) . '" class="btn btn-primary btn-sm" id="previous"><i class="fa-solid fa-angle-left"></i> Previous</a>';
                    }
                    if ($page < $totalPages) {
                        echo '<a href="?page=' . ($page + 1) . '" class="btn btn-primary btn-sm" id="next">Next <i class="fa-solid fa-angle-right"></i></a>';
                    }
                    echo '</div>';
                }

                echo '</div>';
            } else {
                echo "<p><b>No books found.</b></p>";
            }

            // Close the database connection
            mysqli_close($conn);

            ?>

        </div>
<!--TABLE END-->

</body>
</html>