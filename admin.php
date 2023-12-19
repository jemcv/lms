<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>School Sphere</title>
</head>
<body>
    <header>
        <h1>School Sphere <i class="fa-solid fa-globe"> </i> </h1>
     
    </header>
    <h6>Admin Login</h6>

    <form action="loginform.php" method="post">
        <label for="username"><i class="fa-solid fa-user"></i> Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <br>
        <!-- <b><a style="float: right;"href="#">Forgot Password</a></b> --> 
        <input type="submit" value="Login" name="login">
        <br>
    </form>
    <img src="assets/img/login.png"

    
</body>
</html>
<?php
session_start();

include_once 'config.php';
    
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // $_SESSION['username'] = $username;

    $checkstudent = mysqli_query($conn, " SELECT * FROM student WHERE username = '$username' and password = '$password' and usertype = 'student' ");
    $row = mysqli_fetch_array($checkstudent);
   
    /*
    $checkemployer = mysqli_query($conn, " SELECT * FROM employer WHERE username = '$username' and password = '$password' and usertype = 'employer' ");
    $row1 = mysqli_fetch_array($checkemployer);
    $checkadmin = mysqli_query($conn, " SELECT * FROM admin WHERE username = '$username' and password = '$password' and usertype = 'admin' ");
    $row2 = mysqli_fetch_array($checkadmin);
   */
    
    if (is_array($row) and is_array($row) == 'student') {
        header("location: ./student/studentindex.php");
        $jobemp = mysqli_query($conn, " SELECT * FROM employer ");
        $row3 = mysqli_fetch_array($jobemp);

        // SESSION ID
        $sid = $row['student_id'];
        $_SESSION['id'] = $sid;
        $eid = $row3['employer_id'];
        $_SESSION['eid'] = $eid;

        /*
    } else if (is_array($row1) and is_array($row1) == 'employer') {
        header("location: ./employer/employerindex.php");
      
      // EMPLOYER SESSION ID
        $eid = $row1['employer_id'];
        $_SESSION['id'] = $eid;

    } else if (is_array($row2) and is_array($row2) == 'admin'){
        header("location: ./admin/adminindex.php");
        
        // ADMIN SESSION ID
        $aid = $row2['admin_id'];
        $_SESSION['id'] = $aid;
 */
    } else {
        echo '<p style="text-align: center; background-color: #BF616A"; padding: 20px;>Wrong Credentials</p>';
    }
}
?>
