<?php
session_start();

include '../config.php';

$eid = $_SESSION['id'];  
$readsql = "SELECT * FROM staff where staff_id = '$eid' ";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    $user  = $res['username'];
    $usertype = $res['usertype'];
    $staff_no = $res['staff_no'];
    $email = $res['email'];
    $passw = $res['password'];
   
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/index.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.js" integrity="sha512-Z4QYNSc2DFv8LrhMEyarEP3rBkODBZT90RwUC7dYQYF29V4dfkh+8oYZHt0R6T3/KNv32/u0W6icGWUUk9V0jA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.15/sweetalert2.min.css" integrity="sha512-NvuRGlPf6cHpxQqBGnPe7fPoACpyrjhlSNeXVUY7BZAj1nNhuNpRBq3osC4yr2vswUEuHq2HtCsY2vfLNCndYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>School Sphere</title>
  
</head>
<body>
    
    <header>
        <h2> School Sphere <i class="fa-solid fa-globe"></i></h2>

        <nav>
            <a class="nav-link" href="employerindex.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="employerinfo.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="employertask.php"><i class="fa-solid fa-list-check"></i> Add Task &nbsp;</a>
            <a class="nav-link" href="employertasklist.php"><i class="fa-solid fa-clipboard-check"></i> Manage Task &nbsp;</a>
            <a class="nav-link" href="employertaskoutput.php"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6> Edit profile information</h6>
    <section>
        <form action="employerinfo.php" method="post">
            <div class="panel" id="info">
                <img src="../assets/img/staff.jpg" style="border-radius: 50%" width="30%" height="50%">
                <label for="username">Account No. / Position</label>
                <input type="text" id="username" name="username"value="<?php echo $staff_no ?>" readonly required>
                <input type="text" id="usertype" name="usertype"value="<?php echo $usertype ?>" readonly required>
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php echo $email?>" required>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $user?>" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $passw?>" required>
                <input type="checkbox" onclick="viewPassword()">View Password
                <br>
                <input type="submit" value="Update Profile" name="updateprofile">
            </div>
        </form>
    </section>
</body>
<script>
    function viewPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
}
</script>
</html>

<?php

if(isset($_POST['updateprofile'])) {

    $user  = $_POST['username'];
    $email = $_POST['email'];
    $passw = $_POST['password'];

    if(mysqli_num_rows($query) > 0) {
        $sql = "UPDATE `staff`
        SET `username` = '$user', `email` = '$email', `password` = '$passw' 
        WHERE `staff_id` = $eid";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            ?>
            <script>
               Swal.fire({
               icon: 'success',
               title: 'Profile Updated Successfully!',

           }).then((result) => {
                    if(result){
                        window.location.href = "employerinfo.php";
                    } 
                })
            </script>
           <?php
        } else {
            echo '<script>alert("Error updating profile ")</script>'; 
        }
    } else {
        echo '<script>alert("Query Error")</script>'; 
    }
}
?>
