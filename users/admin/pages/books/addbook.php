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

<!--MAIN BOX START-->
        <div class="container">
        <hr>
        
        <form action="POST">   
                <div class="container">
                    <div class="dropdown1">
                        <label for="booksection">Select Section: </label>
                        &nbsp;&nbsp;
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