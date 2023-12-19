<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js" integrity="sha512-Z4QYNSc2DFv8LrhMEyarEP3rBkODBZT90RwUC7dYQYF29V4dfkh+8oYZHt0R6T3/KNv32/u0W6icGWUUk9V0jA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>School Sphere</title>

</head>
<body>
    <header>
        <h1>School Sphere <i class="fa-solid fa-globe"> </i> </h1>
        <nav>
            <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="about.php"><i class="fa-solid fa-circle-info"></i> About &nbsp;</a>
            <a style="float:right; border-bottom: 2px solid #4a4a4a;" class="nav-link" href="loginform.php"><i class="fa-solid fa-right-to-bracket"></i> Login &nbsp;</a>
        </nav>
    </header>
    <h6>Login Account</h6>

    <form action="loginform.php" method="post">
        <label for="username"><i class="fa-solid fa-user"></i> Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        <label for="password"><i class="fa-solid fa-lock"></i> Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <br>
        <!-- <b><a style="float: right;"href="#">Forgot Password</a></b> --> 
        <input type="submit" value="Login" name="login">
        <br>
        <p style="text-align: center">Don't have an account yet? <b><a href="signup.php">Signup</a></b></p>
    </form>
    <img src="assets/img/login.png">

    
</body>
</html>
<?php
include_once 'config.php';
    
if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // $_SESSION['username'] = $username;

    $checkstudent = mysqli_query($conn, " SELECT * FROM student WHERE username = '$username' and password = '$password' and usertype = 'student' ");
    $row = mysqli_fetch_array($checkstudent);
   
   
    $checkemployer = mysqli_query($conn, " SELECT * FROM staff WHERE username = '$username' and password = '$password' and usertype = 'staff' ");
    $row1 = mysqli_fetch_array($checkemployer);
    
     /*
    $checkadmin = mysqli_query($conn, " SELECT * FROM admin WHERE username = '$username' and password = '$password' and usertype = 'admin' ");
    $row2 = mysqli_fetch_array($checkadmin);
    */
    
    if (is_array($row) and is_array($row) == 'student') {
        header("location: ./student/studentindex.php");

        // SESSION ID
        $sid = $row['student_id'];
        $_SESSION['id'] = $sid;

    } else if (is_array($row1) and is_array($row1) == 'staff') {
        header("location: ./employer/employerindex.php");
      
      // EMPLOYER SESSION ID
        $eid = $row1['staff_id'];
        $_SESSION['id'] = $eid;

    } 
    /*else if (is_array($row2) and is_array($row2) == 'admin'){
        header("location: ./admin/adminindex.php");
        
        // ADMIN SESSION ID
        $aid = $row2['admin_id'];
        $_SESSION['id'] = $aid;
    }
 */
    else {
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Wrong Credentials',
            text: 'Please re enter username and password',
            })
        </script>
        <?php
    }
}
?>
