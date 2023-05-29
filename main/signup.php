<?php
// Assuming you have established a database connection

require ('../dbconn.php');

$command = 'python3 id_number.py';
$id_number = exec($command);


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id_no = $_POST['id_number'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $acctype = $_POST['acctype'];
    $schlvl = $_POST['schlvl'];

    // Prepare and execute the SQL query to insert the data into the table
    $sql = "INSERT INTO users (username, firstname, lastname, password, acctype, schlvl, status) 
            VALUES ('$username', '$firstname', '$lastname', '$password', '$acctype', '$schlvl', 'Active')";

if (mysqli_query($connection, $sql)) {
    // Data insertion successful
    echo "<script>alert('Account created successfully.');</script>";
} else {
    // Error occurred while inserting data
    echo "<script>alert('Error: " . $sql . "\\n" . mysqli_error($connection) . "');</script>";
}


    // Close the database connection
    mysqli_close($connection);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - LMS </title>
    <!--Link for Tab ICON-->
    <link rel="icon" type="image/x-icon" href="/LibMSv1/resources/images/logov1.png">
    <!--Link for Bootstrap-->
    <link rel="stylesheet" type="text/css" href="/LibMS/resources/bootstrap/css/bootstrap.min.css"/>
    <script type="text/javascript" src="/LibMSv1/resources/bootstrap/js/bootstrap.min.js"></script>
    <!--Link for CSS File-->
    <link rel="stylesheet" type="text/css" href="/LibMSv1/main/css/signup.css">
    <!--Link for Font Awesome Icons-->
    <link rel="stylesheet" href="/LibMSv1/resources/icons/fontawesome-free-6.4.0-web/css/all.css">
    <!--Link for Google Font-->
    <link rel="stylesheet" href="/LibMSv1/resources/fonts/fonts.css"/>

</head>

<body>
    <div class="createform">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title"><b>Sign up:</b></div>
                                    <div class="createacc">
                                        <form action="#" method="post">
                                            <div class="form-group"><input type="text" Name="firstname" id="firstname" placeholder="First Name" required=""></div>
                                            <div class="form-group"><input type="text" Name="lastname" id="lastname" placeholder="Last Name" required=""></div>
                                            <div class="form-group"><input type="text" Name="username" id="username" placeholder="Username" required=""></div>
                                            <div class="form-group"><input type="text" Name="email" id="email" placeholder="Email" required=""></div>
                                            <div class="form-group"><input type="password" Name="password" id="password" placeholder="Password" required=""></div>
                                            <label for="acctype">Account Type: </label>
                                                <select name="acctype" class="form-select" id="acctype">
                                                    <option selected></option>
                                                    <option value="student">Student</option>
                                                    <option value="librarian">Librarian</option>
                                                    <option value="staff">Staff</option>
                                                </select>

                                            
                                              <label for="schlvl">School Level: </label>
                                                <select name="schlvl" class="form-select" id="schlvl">
                                                    <option selected></option>
                                                    <option value="Elementary">Elementary</option>
                                                    <option value="Junior High School">Jr. High School</option>
                                                    <option value="Senior High School">Sr. High School</option>
                                                    <option value="Graduate">Graduate</option>
                                                </select>

                                              <script>
                                                var acctype = document.getElementById("acctype");
                                                var schlvl = document.getElementById("schlvl");

                                                acctype.addEventListener("change", function() {
                                                if (acctype.value === "librarian" || acctype.value === "staff") {
                                                    schlvl.disabled = true;
                                                    schlvl.selectedIndex = 0; // clears the selection of the schlvl dropdown
                                                } else {
                                                    schlvl.disabled = false;
                                                }
                                                });

                                                </script>

                                            <div class="send-button">
                                                <button type="submit" class="btn btn-primary col-md-12"><i class="fa-solid fa-user-plus"></i> Create Account</button>
                                            </div>
                                            <hr>
                                            <a href="/LibMSv1/index.php">
                                                <button type="button" class="btn btn-primary col-md-12">
                                                    <i class="fa-solid fa-rotate-left fa-sm"></i> Go Back</button>
                                            </a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>