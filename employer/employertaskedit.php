<?php
session_start();

include '../config.php';

$eid = $_SESSION['id'];    
$id = $_GET['taskid'];
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
        <a class="nav-link" href="employertasklist.php"><i class="fa-solid fa-clipboard-check"></i> Manage Task &nbsp;</a>
            <a class="nav-link" href="employertasklist.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-pen-to-square"></i> Update Task &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6> Edit task </h6>
    <section>
    <?php 
    $readsql = "SELECT * FROM task where task_id = '$id' ";
    $query = mysqli_query($conn, $readsql);

    while($res = mysqli_fetch_array($query)) {
        $taskid = $res['task_id'];
        $taskname = $res['task_name'];
        $taskdesc  =  $res['task_desc'];
        $taskreq = $res['task_req'];
        $taskdate = $res['task_date'];
        $filedata = $res['file_data'];
    ?>
        <form action="../update.php" method="post" enctype="multipart/form-data">
            <label for="topic">Topic</label>
            <input type="text" id="task_name" name="task_name" value="<?php echo $taskname; ?>">
            <label for="description">Description</label>
            <input type="text" id="task_desk" name="task_desc" value="<?php echo $taskdesc; ?>">
            <label for="requirement">Requirement</label>
            <input type="text" id="requirment" name="task_req" value="<?php echo $taskreq; ?>">
            <label for="username">Attachment</label>
            <input type="file" id="file_data" name="file_data" value="<?php echo $filedata; ?>">
            <label for="password">Date</label>
            <input type="date" id="date" name="task_date" value="<?php echo $taskdate; ?>" onfocus="this.value='<?php echo date('Y-m-d'); ?>';">
            <br>
            <input type="hidden" name="id" value="<?php echo $taskid; ?>">
            <input type="submit" value="Update Task" name="updatetask">
        </form>
    <?php } ?>
</section>
</body>
</html>

