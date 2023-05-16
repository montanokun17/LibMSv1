<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - All Books</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/users/admin/pages/books/css/books.css">
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
                <a class="nav-link active" href="/LibMSv1/users/admin/pages/books/books.php"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
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
                <a href="/LibMS/users/admin/index.php">
                    <i class="fa fa-user fa-md"></i>
                    <span class="nav-text">
                       Profile Card
                    </span>
                </a>
              
            </li>
            <li>
              <a href="/LibMS/users/admin/pages/profile/profilesetting.php">
                  <i class="fa fa-cogs fa-md"></i>
                   <span class="nav-text">
                       Profile Settings
                   </span>
               </a>
           </li>
           <li>
            <a href="/LibMS/users/admin/pages/profile/manageusers.php">
                <i class="fa fa-users fa-md"></i>
                 <span class="nav-text">
                     Manage Accounts
                 </span>
             </a>
         </li>
         <li>
          <li class="has-subnav">
              <a href="/LibMS/users/admin/pages/qrpages/qrpage.php">
                 <i class="fa fa-solid fa-qrcode fa-md"></i>
                  <span class="nav-text">
                      QR Code
                  </span>
              </a>
             
          </li>
            <li class="has-subnav">
                <a href="/LibMS/users/admin/pages/messages/messages.php">
                   <i class="fa fa-comments fa-md"></i>
                    <span class="nav-text">
                        Messages
                    </span>
                </a>
                
            </li>
            <li>
              <a href="/LibMS/users/admin/pages/messages/sendmessage.php">
                  <i class="fa fa-message fa-md"></i>
                  <span class="nav-text">
                     Send Message
                  </span>
              </a>
          </li>
            <li>
                <a href="/LibMS/users/admin/pages/books/books.php">
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
            <a href="#">
                <i class="fa fa-book fa-md"></i>
                <span class="nav-text">
                   Currently Issued Books
                </span>
            </a>
        </li>
        <li>
          <a href="#">
              <i class="fa fa-book fa-md"></i>
              <span class="nav-text">
                 Previously Borrowed Books
              </span>
          </a>
      </li>
      <li>
        <a href="#">
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

<!--TABLE START-->
    <div class="container">
        <hr>
            <div class="search-bar">
                <input type="text" class="search" placeholder ="Enter Book Section, Book Name, or Book's Status..">
                <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-search fa-sm"></i> Search</button>
            </div>
            

            
                <div class="dropdown1">
                    <label for="booksection">Select Section: </label>
                        <select name="Section" id="bsection">
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
                        <select name="Status" id="bstatus">
                            <option></option>
                            <option value="GOOD">GOOD</option>
                            <option value="DAMAGED">DAMAGED</option>
                            <option value="DILAPITATED">DILAPITATED</option>
                            <option value="LOST">LOST</option>
                        </select>

               
            
                <div class="rep-btn">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-file fa-sm"></i> Generate Report</button>
                    <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-file-export fa-sm"></i> <i class="fa-solid fa-file-excel fa-sm"></i> Export Books Data to Excel</button>
                </div>
            


            <table>
                <thead>
                    <tr>
                        <th>Book Identification Number (BID)</th>
                        <th>Book Name</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>Section</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <td>1</td>
                    <td>The Handmaid's Tale</td>
                    <td>Margaret Atwood</td>
                    <td>1981</td>
                    <td>Dystopian Fiction</td>
                    <td>1</td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-circle-info fa-sm"></i> Details</button>
                    </td>
                </tbody>
            </table>
        </div>
<!--TABLE END-->

</body>
</html>