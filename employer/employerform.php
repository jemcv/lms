<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js" integrity="sha512-Z4QYNSc2DFv8LrhMEyarEP3rBkODBZT90RwUC7dYQYF29V4dfkh+8oYZHt0R6T3/KNv32/u0W6icGWUUk9V0jA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>School Sphere</title>

</head>
<body>
    <header>
        <h1>School Sphere <i class="fa-solid fa-globe"> </i>  </h1>
        <nav>
            <a class="nav-link" href="../index.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="../about.php"><i class="fa-solid fa-circle-info"></i> About &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../loginform.php"><i class="fa-solid fa-right-to-bracket"></i> Login &nbsp;</a>
        </nav>
    </header>
    <section>
        <h6>Staff Account Creation </h6>
        <form action="employerform.php" method="post">
            <label for="username"><i class="fa-solid fa-user"></i> Username*</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
            <label for="email"><i class="fa-solid fa-envelope"></i> Email*</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <label for="password"><i class="fa-solid fa-lock"></i> Password*</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <label for="password"><i class="fa-solid fa-lock"></i> Confirm Password*</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Re enter your password" required>
            <br>
            <input type="submit" value="Signup" name="employerregister">
        </form>
        <img src="../assets/img/signup.png" alt="">
    </section>
</body>
</html>
<?php
include '../config.php';
session_start();


if(isset($_POST['employerregister'])) {
    $username      = $_POST['username'];
    $email         = $_POST['email'];
    $password      = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    $account_no = "STAFF" . uniqid(); // For generating staff no
    $readsql = "SELECT * FROM staff where username = '$username' ";
    $query = mysqli_query($conn, $readsql);

    // Check Password
    if($password == $confirm_password) {
        // Check User Existence
        if(mysqli_num_rows($query) === 0) {
            $sql = "INSERT INTO `staff` (username, staff_no, email, password)
            VALUES ('$username', '$account_no', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                
                ?>
                 <script>
                    Swal.fire({
                    icon: 'success',
                    title: 'Signup Successful',
                    text: 'You can now login ',
                }).then((result) => {
                    if(result){
                        window.location.href = "../loginform.php";
                    } else {
                        header("URL=../loginform.php");
                    }
                })
            </script>
                <?php
            }
        } else {
            ?>
            <script>
                Swal.fire({
                icon: 'error',
                title: 'Username already exist',
                text: 'Please use another username :)',
                })
            </script>
            <?php
        }

    } else {
        ?>
        <script>
            Swal.fire({
            icon: 'error',
            title: 'Password do not match',
            text: 'Please re enter password :)',
            })
        </script>
        <?php
    }
}
?>