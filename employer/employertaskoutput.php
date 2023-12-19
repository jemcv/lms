<?php
session_start();

include '../config.php';

$eid = $_SESSION['id'];  
$readsql = "SELECT * FROM status WHERE staff_id=$eid";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    $grade = $res['grade']; // Fetch Grade
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
            <a class="nav-link" href="employerinfo.php"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="employertask.php"><i class="fa-solid fa-list-check"></i> Add Task &nbsp;</a>
            <a class="nav-link" href="employertasklist.php"><i class="fa-solid fa-clipboard-check"></i> Manage Task &nbsp;</a>
            <a class="nav-link" href="employertaskoutput.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6>Evaluate student output</h6>
    <table>
    <?php 
            $readsql = "SELECT * FROM status WHERE staff_id=$eid";
            $query = mysqli_query($conn, $readsql);
            if(mysqli_num_rows($query) > 0) {
                echo "<tr>";
                echo "<th scope=\"col\">Student Name.</th>";
                echo "<th scope=\"col\">Topic</th>" ;
                echo "<th scope=\"col\">Output</th>" ;
                echo "<th scope=\"col\">Grade</th>" ;
                echo "<th scope=\"col\">Action</th>" ;
                echo "</tr>";
                
                while($res = mysqli_fetch_array($query)) {
                    echo"<tr>";
                        echo"<td>".$res['student_fname']. " " .$res['student_lname']."</td>";
                        echo"<td>".$res['task_name']."</td>";
                        echo"<td><a href=\"../uploads/$res[file_data]\" target=\"blank\"> File Output</a></td>";
                        
                        echo'<form action="employertaskoutput.php" method="post">';
                        if($res['grade']) {
                            echo'<td><input type="text" name="grade" value="'.$res['grade'].'"></td>';
                        } else {
                            echo'<td><input type="text" name="grade" placeholder="No Grade Yet"></td>';
                        }
                            echo'<td><input type="submit" name="addgrade" value="Check"></td>';
                        echo'</form>';
                        
                    echo"</tr>";
                }
                
            } else {
                echo "<label> Currently, there are no student outputs to check</label>";
            }
        ?>

    </table>
<?php 
if(isset($_POST['addgrade'])) {
    $grade = $_POST['grade'];

    if(mysqli_num_rows($query) > 0) {
        $sql = "UPDATE `status` SET grade = '$grade' WHERE `staff_id` = $eid";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            ?>
            <script>
                Swal.fire({
                icon: 'success',
                title: 'Grade Updated Successfuly!',
                text: 'Niceeeeeeeeeeeeeeee',

            }).then((result) => {
                    if(result){
                        window.location.href = "employertaskoutput.php";
                    } 
                })
            </script>
            <?php
        } else {
            echo '<script>Error Updating Grade</script>'; 
        }
    } else {
        echo '<script>Error Updating Grade</script>'; 
    }
}
?>
