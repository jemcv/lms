<?php
session_start();
/*
include '../config.php';
$eid = $_SESSION['id'];  
$readsql = "SELECT * FROM employer where employer_id = '$eid' ";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    $user  = $res['username'];
    $email = $res['employer_email'];
}
*/
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <title>School Sphere</title>
</head>
<body>

    <header>
        <h2> School Sphere <i class="fa-solid fa-globe"></i></h2>

        <nav>
            <a class="nav-link" href="employerindex.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="employerinfo.php"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="employertask.php"><i class="fa-solid fa-list-check"></i> Add Task &nbsp;</a>
            <a class="nav-link" href="employertasklist.php"><i class="fa-solid fa-clipboard-check"></i> Manage Task &nbsp;</a>
            <a class="nav-link" href="employertaskoutput.php"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>

            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6> Guide for using School Sphere </h6>
    <section>
    <ul>
        <li>Home</li>
        <ul>
            <li>This page provides information on how to use the website.</li>
        </ul>
        <li>My Profile</li>
        <ul>
            <li>This page displays information about staff members.</li>
        </ul>
        <li>Add Task</li>
        <ul>
            <li>This page allows users to add new tasks.</li>
        </ul>
        <li>View Tasks</li>
            <ul>
                <li>This page displays a list of all added tasks.</li>
            </ul>
    </ul>
    </section>
    
</body>
</html>
