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
        <h1>School Sphere <i class="fa-solid fa-globe"> </i>   </h1>
        <nav>
            <a class="nav-link" href="index.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="about.php"><i class="fa-solid fa-circle-info"></i> About &nbsp;</a>
            <a style="float:right; border-bottom: 2px solid #4a4a4a;" class="nav-link" href="signup.php"><i class="fa-solid fa-right-to-bracket"></i> Signup &nbsp;</a>
        </nav>
    </header>

    <br>
    <section>
        <b class="select-greet">Register as</b>
                <a href="./student/studentform.php">
                    <button><i class="fa-solid fa-user"></i> Student</button>
                </a>
                <a href="./employer/employerform.php">
                    <button><i class="fa-solid fa-user-tie"></i> Staff</button>
                </a>
                  
        <br>
        <br>
        <p style="text-align: center">Already have an account? <b><a href="loginform.php">Login</a></b></p>
        <img src="assets/img/signup.png" alt="signup">
    </section>

</body>
</html>