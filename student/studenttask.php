<?php
session_start();

include '../config.php';
$sid = $_SESSION['id'];  

$readsql = "SELECT * FROM student where student_id = '$sid' ";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    // Student Info
    $user  = $res['username'];
    $fname = $res['student_fname'];
    $mname = $res['student_mname'];
    $lname = $res['student_lname'];
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
            <a class="nav-link" href="studentindex.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="studentinfo.php"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="studenttask.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-list-check"></i> View Task &nbsp;</a>
            <a class="nav-link" href="studenttaskoutput.php"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>
    <h6>My Assigned Task</h6>
    <section>
    <?php 
    $readsql = "SELECT * FROM task";
    $query = mysqli_query($conn, $readsql);

    $hasTask = false;

    if(mysqli_num_rows($query) > 0) {
        while($res = mysqli_fetch_array($query)) {
            $taskid = $res['task_id'];
            $staffid = $res['staff_id'];
            $taskname = $res['task_name'];
            $taskdesc  =  $res['task_desc'];
            $taskreq = $res['task_req'];
            $taskdate = $res['task_date'];
            $filedata = $res['file_data'];
            
            $checkstatus = mysqli_query($conn, "SELECT * FROM status WHERE task_id = '$taskid' AND student_id = '$sid'");
            if(mysqli_num_rows($checkstatus) == 0) {
                // The student hasn't completed this task yet
                $hasTask = true;
                
                echo '<blockquote><label>Topic <span style="float: right; color: red">Assigned</span></label>' . $taskname;
                // Get ID;
                echo '<label> Description </label> ';
                echo '<p>' . $taskdesc . '</p>';
                echo '<label> Requirements </label>';
                echo '<p>' . $taskreq . '</p>'; 
                echo '<label> File Attachment </label>';
                echo "<p><a href='../uploads/$filedata' target='_blank'>View Attachment</a></p>";
                echo "<br>";
                echo "<form action=\"studenttask.php\" method=\"post\" enctype=\"multipart/form-data\">";
                echo "<input type='hidden' name='task_id' value='$taskid'>";
                echo "<input type='hidden' name='status_text' value='done'>";
                echo "<input type='hidden' name='file_data' value='$filedata'>";
                echo "<input type='hidden' name='staff_id' value='$staffid'>";
                echo "<input type='hidden' name='sid' value='$sid'>";
                echo "<input type='hidden' name='fname' value='$fname'>";
                echo "<input type='hidden' name='lname' value='$lname'>";
                echo "<input type='hidden' name='task_desc' value='$taskdesc'>";
                echo "<input type='hidden' name='task_req' value='$taskreq'>";
                echo "<label> Upload your file here </label>";
                echo '<input type="file" name="file_data">';
                echo "<br>";
                echo '<input style="float: right;" type="submit" value="Submit Task" name="submittask">';
                echo "</form>";
                echo "<br>";
                echo '</blockquote>'; 

            }
        }
    } 
    if (!$hasTask) {
        echo '<blockquote>No Assigned Task</blockquote>';
    }
?>
    </section>     
    
</body>
<script>
</script>
</html>
<?php 




if (isset($_POST['submittask'])) {
    $taskid = $_POST['task_id'];
    $staffid = $_POST['staff_id'];
    $filedata = $_POST['file_data'];
    $sid = $_POST['sid']; // Student ID
    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    $taskdesc = $_POST['task_desc'];
    $taskreq = $_POST['task_req']; 
    $statustext = $_POST['status_text'];

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
    
                $sql = "INSERT INTO `status` (status_text, file_data, student_fname, student_lname, task_output, task_name, task_desc, task_req, task_id, student_id, staff_id)
                VALUES ('$statustext', '$filedata', '$fname', '$lname', '$fileNameNew', '$taskname', '$taskdesc', '$taskreq', $taskid, $sid, $staffid)";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    ?>
                    <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Submitted Successfully',
                    }).then((result) => {
                        if(result){
                            window.location.href = "studenttask.php";
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