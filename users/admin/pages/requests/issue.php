<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Issue Request</title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMS/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMS/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMS/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMS/users/admin/pages/requests/css/issue.css">
    <!--Link for NAVBAR and Sidebar CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMS/users/admin/css/navbar-sidebar.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMS/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMS/resources/fonts/fonts.css"/>

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
                <a class="nav-link" aria-current="page" href="/LibMS/users/admin/index.php"><i class="fa-solid fa-user fa-xs"></i> Profile Card</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMS/users/admin/pages/profile/manageusers.php"></i><i class="fa-solid fa-users fa-xs"></i> Accounts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMS/users/admin/pages/books/books.php"><i class="fa-solid fa-book-open fa-sm"></i> Books</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-database fa-sm"></i> Database</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/LibMS/users/admin/pages/requests/requests.php"><i class="fa-solid fa-arrow-left fa-sm"></i> Go Back</a>
              </li>
            </ul>

            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket fa-xs"></i> Logout</a>
              </li>
            </ul>

            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/LibMS/users/admin/index.php">
                    <img src="/LibMS/resources/images/user.png" 
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
                <a href="/LibMS/users/admin/pages/books/addbook.php">
                    <i class="fa fa-plus fa-md"></i>
                    <span class="nav-text">
                       Add Books
                    </span>
                </a>
            </li>
            <li>
              <a href="/LibMS/users/admin/pages/requests/requests.php">
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

<!--MAIN BOX START-->
<div class="main">
    <div class="container">
        <div class="search-bar">
            <input type="text" class="search" placeholder ="Enter ID Number, Name, Book Name...here">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-search fa-sm"></i> Search</button>
        </div>

        <table>
        <thead>
             <tr>
                <th>Issue ID</th>
                <th>Book ID</th>
                <th>ISBN</th>
                <th>Book Name</th>
                <th>Section</th>
                <th>Availability</th>
                <th>Borrower's ID Number</th>
                <th>Borrower's Username</th>
                <th>Date of Request</th>
                <th>Due Date</th>
                <th>Date of Return</th>
                <th>Action</th>
                </tr>
        </thead>

        <tbody>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
            <button type="button" class="btn btn-success btn-sm"><i class="fa-solid fa-check fa-sm"></i> Grant Borrow Request</button>
            <button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash fa-sm"></i> Delete</button>
            </td>
        </tbody>
        </table>

    </div>
</div>

<!--MAIN BOX END-->
</body>
</html>
