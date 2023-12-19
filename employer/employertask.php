<?php
session_start();

include '../config.php';

$eid = $_SESSION['id'];  

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
            <a class="nav-link" href="employertask.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-list-check"></i> Add Task &nbsp;</a>
            <a class="nav-link" href="employertasklist.php"><i class="fa-solid fa-clipboard-check"></i> Manage Task &nbsp;</a>
            <a class="nav-link" href="employertaskoutput.php"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
            
        </nav>
    <header>
    <h6> Create a task for the users </h6>
    <section>
        <form action="employertask.php" method="post" enctype="multipart/form-data">
            <label for="topic">Topic</label>
            <input type="text" id="task_name" name="task_name" placeholder="Topic Name" required>
            <label for="description">Description</label>
            <input type="text" id="task_desk" name="task_desc"  placeholder="Topic Description" required>
            <label for="requirement">Requirement</label>
            <input type="text" id="requirment" name="task_req" placeholder="Topic Requirements" required>
            <label for="username">Attachment</label>
            <input type="file" id="file_data" name="file_data" placeholder="File Attachments">
            <label for="password">Date</label>
            <input type="date" id="date" name="task_date" onfocus="this.value='<?php echo date('Y-m-d'); ?>' ; ">
            <br>
            <input type="submit" value="Add Task" name="addtask">
        </form>
    </section>

</body>
</html>
<?php 
$readsql = "SELECT * FROM staff where staff_id = '$eid' ";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    // Fetch Staff Info
    $user  = $res['username'];
    $usertype = $res['usertype'];
    $staff_no = $res['staff_no'];
    $email = $res['email'];
    $passw = $res['password'];
   
}

if(isset($_POST['addtask'])) {
    // Task Info
    $taskname = $_POST['task_name'];
    $taskdesc  =  $_POST['task_desc'];
    $taskreq = $_POST['task_req'];
    $taskdate = $_POST['task_date'];

    // Adding File Attachment
    $file = $_FILES['file_data'];
    $fileName = $_FILES['file_data']['name'];
    $fileTmpName = $_FILES['file_data']['tmp_name'];
    $fileError = $_FILES['file_data']['error'];
    $fileType = $_FILES['file_data']['type'];
    $fileSize = filesize($fileTmpName);
    
    $fileExt = explode('.', $fileName);
    $fileActExt = strtolower(end($fileExt));
    
    if ($fileActExt) {
        if ($fileError === 0) {
            if ($fileSize < 10000000) {
                $fileNameNew = uniqid('', true).".".$fileActExt;
                $fileDest = '../uploads/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDest);
    
                $sql = "INSERT INTO `task` (staff_id, task_name, task_desc, task_req, task_date, file_data, username, email) 
                        VALUES ($eid, '$taskname','$taskdesc', '$taskreq', '$taskdate', '$fileNameNew', '$user', '$email')";
                $result = mysqli_query($conn, $sql);
    
                if ($result) {
                    ?>
                    <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Task Added Successfully',
                    }).then((result) => {
                        if(result){
                            window.location.href = "employertask.php";
                        } else {
                            header("URL=employertask.php");
                        }
                    })
                    </script>
                    <?php
                }
            } else {
                echo "File size is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
    }
}

?>