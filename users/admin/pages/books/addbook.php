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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if all required fields are filled
    if (isset($_POST["section"]) && isset($_POST["Status"]) && isset($_POST["subject"]) && isset($_POST["book_title"]) && isset($_POST["volumes"]) && isset($_POST["year"]) && isset($_POST["availability"]) && isset($_POST["author"]) && isset($_POST["isbn"])) {
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO books (section, status, subject, book_title, volume, year, stocks, author, isbn) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $_POST["section"], $_POST["Status"], $_POST["subject"], $_POST["book_title"], $_POST["volumes"], $_POST["year"], $_POST["availability"], $_POST["author"], $_POST["isbn"]);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: /LibMSv1/users/admin/pages/books/addbook.php");
            echo '<script>alert("Book added successfully!");</script>';
        } else {
            echo '<script>alert("Error adding book: ' . $stmt->error . '");</script>';
        }

        // Close the statement
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all the required fields.");</script>';
    }
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
    <title>Admin - Add Books</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/pages/books/css/addbook.css">
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

<!--MAIN BOX START-->
        <div class="container">
        <hr>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">   
                <div class="container">
                    <div class="dropdown1">
                        <label for="booksection">Select Section: </label>
                        &nbsp;&nbsp;                       
                        <select name="section" id="bsection">
                            <option></option>
                            <option value="Art and Architecture">Art and Architecture</option>
                            <option value="Biography/Autobiography">Biography/Autobiography</option>
                            <option value="Business and Finance">Business and Finance</option>
                            <option value="Cookbooks and Food Writing">Cookbooks and Food Writing</option>
                            <option value="Fiction">Fiction</option>
                            <option value="Foreign Languages">Foreign Languages</option>
                            <option value="Graphic Novels and Comics">Graphic Novels and Comics</option>
                            <option value="History">History</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Memoir">Memoir</option>
                            <option value="Mystery Thriller">Mystery/Thriller</option>
                            <option value="Others">Others</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Politics and Current Events">Politics and Current Events</option>
                            <option value="Poetry">Poetry</option>
                            <option value="Reference and Dictionary">Reference and Dictionary</option>
                            <option value="Religion and Spiritually">Religion and Spiritually</option>
                            <option value="Romance">Romance</option>
                            <option value="Science and Technology">Science and Technology</option>
                            <option value="Science Fiction/Fantasy">Science Fiction/Fantasy</option>
                            <option value="Self-Help and Personal Development">Self-Help and Personal Development</option>
                            <option value="Travel and Adventure">Travel and Adventure</option>
                            <option value="Young Adult Fiction">Young Adult Fiction</option>
                        </select>

                        <label for="bookstatus" id="dropdown2">Select Book Status: </label>
                        &nbsp;&nbsp;
                        <select name="Status" id="bstatus">
                            <option></option>
                            <option value="GOOD">GOOD</option>
                            <option value="DAMAGED">DAMAGED</option>
                            <option value="DILAPITATED">DILAPITATED</option>
                            <option value="LOST">LOST</option>
                        </select>

                </div>
            </div>

            <div class="form-group">
                <label for="subject">Subject: </label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="ex. Fantasy, Dystopian, Contemporary, Mystery, Adventure...">
            </div>

            <div class="form-group">
                <label for="textbook">Textbook: </label>
                <input type="text" class="form-control" name="book_title" id="book_title" placeholder="Book Name">
            </div>

            <div class="form-group">
                <label for="volumes">Volumes: </label>
                <input type="text" class="form-control" name="volumes" id="volumes" placeholder="Volumes">
            </div>

            <div class="form-group">
                <label for="year">Copyright Year: </label>
                <input type="text" class="form-control" name="year" id="year" placeholder="ex. 1981, 2012..">
            </div>

            <div class="form-group">
                <label for="copynum">Number of Copies: </label>
                <input type="text" class="form-control" name="availability" id="availability" placeholder="Number of Copies">
            </div>

            <div class="form-group">
                <label for="author">Author: </label>
                <input type="text" class="form-control" name="author" id="author" placeholder="Author">
            </div>

            <div class="form-group">
                <label for="isbn">ISBN: </label>
                <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ex. 978-3-16-148410-0 or 9783161484100">
            </div><br>


            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus fa-sm"></i> Add Book</button>

        </form>

	</div>
<!--MAIN BOX END-->
</body>
</html>