<?php
session_start();

include '../config.php';
$sid = $_SESSION['id'];  

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
            <a class="nav-link" href="studentindex.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="studentinfo.php"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="studenttask.php"><i class="fa-solid fa-list-check"></i> View Task &nbsp;</a>
            <a class="nav-link" href="studenttaskoutput.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6>My Outputs</h6>
    <section>
<?php 
    $readsql = "SELECT * FROM status WHERE student_id=$sid";
    $query = mysqli_query($conn, $readsql);
    if(mysqli_num_rows($query) > 0) {
        while($res = mysqli_fetch_array($query)) {
            $taskname = $res['task_name'];
            $taskdesc  =  $res['task_desc'];
            $taskreq = $res['task_req'];
            $filedata = $res['file_data'];
            $taskoutput = $res['task_output'];
            $grade = $res['grade'];

            echo '<blockquote><label>Topic <span style="float: right; color: green">Done</span></label>' . $taskname;
            echo '<label> Description </label> ';
            echo '<p>' . $taskdesc . '</p>';
            echo '<label> Requirements </label>';
            echo '<p>' . $taskreq . '</p>'; 
            echo '<label> File Attachment </label>';
            echo "<p><a href='../uploads/$filedata' target='_blank'>View Attachment</a></p>";
            echo "<br>";
            echo '<label> Submitted Output </label>';
            echo "<p><a href='../uploads/$taskoutput' target='_blank'>Uploaded Attachment</a></p>";
            echo "<br>";
            echo "<label> Grade </label>";
            if($res['grade']) {
                echo "<p style=\"color: green;\"> $grade </p>";
            } else {
                echo '<p style="color: red;"> No grade yet </p>';
            }
            echo '</blockquote>';
        }
    } else {
        echo "<label> No Submitted Outputs </label>";
    }
?>
    </section>     
</body>
<script>
</script>
</html>
