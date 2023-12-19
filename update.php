<?php
session_start();

include 'config.php';

$eid = $_SESSION['id'];    

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
</html>
  
<?php
if(isset($_POST['updatetask'])) {
    // Task Info
    $taskid = $_POST['id'];
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
    
                $sql = "UPDATE `task` SET task_name='$taskname', task_desc='$taskdesc', task_req='$taskreq', task_date='$taskdate', file_data='$fileNameNew' WHERE task_id=$taskid";
                $result = mysqli_query($conn, $sql);
    
                if ($result) {
                    ?>
                    <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Task Updated Successfully',
                        text: ':)',
                    }).then((result) => {
                        if(result){
                            window.location.href = "employer/employertasklist.php";
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
    } else {
        $sql = "UPDATE `task` SET task_name='$taskname', task_desc='$taskdesc', task_req='$taskreq', task_date='$taskdate' WHERE task_id=$taskid";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            ?>
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Task Updated Successfully',
            }).then((result) => {
                if(result){
                    window.location.href = "employer/employertasklist.php";
                } 
            })
            </script>
            <?php
        }
    }
}
?>
