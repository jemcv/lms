<?php
session_start();
include '../config.php';

$sid = $_SESSION['id'];  
$readsql = "SELECT * FROM student where student_id = '$sid' ";
$query = mysqli_query($conn, $readsql);

while($res = mysqli_fetch_array($query)) {
    // Student Info
    $id    = $res['student_id'];
    $user  = $res['username'];
    $fname = $res['student_fname'];
    $mname = $res['student_mname'];
    $lname = $res['student_lname'];
    $email = $res['email'];
    $addrs = $res['student_addrs'];
    $gendr = $res['student_gendr'];
    $age =   $res['student_age'];
    $birth = $res['student_birth'];
    $contn = $res['student_contn'];
    $passw = $res['password'];
    //Student Education
    $elem = $res['student_elem'];
    $sec = $res['student_sec'];
    $ter = $res['student_ter'];
    // Student Awards
    $honor = $res['student_honor'];
    $cert = $res['student_cert'];
    // Student Guardian
    $guard = $res['student_guard'];
    $guardno = $res['student_guardno'];
    $guardaddr = $res['student_guardaddr'];
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
    <style>
        .panel { display: none; }
        .show { display: block; }
    </style>
</head>
<body>
    
    <header>
      <h2> School Sphere <i class="fa-solid fa-globe"></i></h2>
        <nav>
            <a class="nav-link" href="studentindex.php"><i class="fa-solid fa-house"></i> Home &nbsp;</a>
            <a class="nav-link" href="studentinfo.php" style="border-bottom: 2px solid #4a4a4a;"><i class="fa-solid fa-address-card"></i> My Profile &nbsp;</a>
            <a class="nav-link" href="studenttask.php"><i class="fa-solid fa-list-check"></i> View Task &nbsp;</a>
            <a class="nav-link" href="studenttaskoutput.php"><i class="fa-solid fa-folder-open"></i> Outputs &nbsp;</a>
            <a style="float:right;" class="nav-link" href="../index.php"><i class="fa-solid fa-right-to-bracket"></i> Logout &nbsp;</a>
        </nav>
    <header>

    <br>
    <section class="buttons">
        <button  type="button" data-id="info">Personal Details</button>
        <button  type="button" data-id="education">Education</button>
        <button  type="button" data-id="awards">Awards</button>
        <button  type="button" data-id="guardian">Guardian</button>
        <button  type="button" data-id="useraccount">User Account</button>
    </section>
    
    <img src="assets/img/student.jpg" alt="">
    
    <section>
        <form action="studentinfo.php" method="post">
            <div class="panel" id="info">
                <label>Profile Image</label>
                <img src="../assets/img/student.jpg" style="border-radius: 50%" width="20%" height="50%">
                <label for="username">Full Name (FN, MN, LN)</label>
                <input type="text" id="fname" name="fname" value="<?php echo $fname?>" >
                <input type="text" id="mname" name="mname" value="<?php echo $mname?>" >
                <input type="text" id="lname" name="lname" value="<?php echo $lname?>">
                <label for="username">Birthdate &nbsp; &nbsp; Age &nbsp; &nbsp; Gender</label>
                <input type="date" id="birth" name="birth" value="<?php echo $birth?>" >
                <input type="text" id="age" name="age" value="<?php echo $age?>" >
                <input type="text" id="gendr" name="gendr" value="<?php echo $gendr?>" >
                <label for="username">Email &nbsp; &nbsp; Contact No</label>
                <input type="text" id="email" name="email" value="<?php echo $email?>" >
                <input type="text" id="contn" name="contn" value="<?php echo $contn?>" >
                <label for="username">Address</label>
                <input type="text" id="addrs" name="addrs" value="<?php echo $addrs?>" >
            </div>

            <div class="panel" id="education">
                <label for="username">Elementary</label>
                <input type="text" id="elem" name="elem" value="<?php echo $elem ?>" >
                <label for="username">Secondary</label>
                <input type="text" id="sec" name="sec" value="<?php echo $sec ?>">
                <label for="username">Tertiary</label>
                <input type="text" id="ter" name="ter" value="<?php echo $ter ?>" >
                
            </div>

            <div class="panel" id="awards">
                <label for="username">Honors</label>
                <input type="text" id="honor" name="honor" value="<?php echo $honor ?>">
                <label for="username">Certificates</label>
                <input type="text" id="cert" name="cert" value="<?php echo $cert ?>" >
            </div>

            <div class="panel" id="guardian">
                <label for="username">Guardian's Name</label>
                <input type="text" id="guard" name="guard" value="<?php echo $guard ?>" >
                <label for="username">Tel No.</label>
                <input type="text" id="guardno" name="guardno" value="<?php echo $guardno ?>" >
                <label for="username">Address</label>
                <input type="text" id="guardaddr" name="guardaddr" value="<?php echo $guardaddr ?>" >
                <br>
                <input type="hidden" name="id" value="<?php echo $sid;?>">
                <input type="submit" value="Update Profile" name="updateprofile">
            </div>

            <div class="panel" id="useraccount">
                <label for="username">Username</label>
                <input type="text" id="guard" name="username" value="<?php echo $user ?>" >
                <label for="username">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $passw ?>" >
                <input type="checkbox" onclick="viewPassword()">View Password
                <input type="hidden" name="id" value="<?php echo $sid;?>">
                <br>
                <input type="submit" value="Update Profile" name="updateprofile">
            </div>
        </form>
    </section>
    
</body>
<script>
    
const buttons = document.querySelector('.buttons');
const panels = document.querySelectorAll('.panel');

const infoFields = document.querySelectorAll('#info input');
const educationFields = document.querySelectorAll('#education input');
const awardsFields = document.querySelectorAll('#awards input');
const guardianFields = document.querySelectorAll('#guardian input');
const userFields = document.querySelectorAll('#useraccount input');

const educationButton = document.querySelector('button[data-id="education"]');
const awardsButton = document.querySelector('button[data-id="awards"]');
const guardianButton = document.querySelector('button[data-id="guardian"]');
const userButton = document.querySelector('button[data-id="useraccount"]');

panels[0].classList.add('show');

if (infoFields[0].value.trim() === '') {
  educationButton.disabled = true;
} else {
  educationButton.disabled = false;
}

if (educationFields[0].value.trim() === '') {
  awardsButton.disabled = true;
} else {
  awardsButton.disabled = false;
}

if (awardsFields[0].value.trim() === '') {
  guardianButton.disabled = true;
} else {
  guardianButton.disabled = false;
}

if (guardianFields[0].value.trim() === '') {
  userButton.disabled = true;
} else {
  userButton.disabled = false;
}

infoFields.forEach(field => {
  field.addEventListener('input', () => {
    const allFieldsFilled = Array.from(infoFields).every(field => field.value.trim() !== '');
    educationButton.disabled = !allFieldsFilled;
  });
});

educationFields.forEach(field => {
  field.addEventListener('input', () => {
    const allFieldsFilled = Array.from(educationFields).every(field => field.value.trim() !== '');
    awardsButton.disabled = !allFieldsFilled;
  });
});

awardsFields.forEach(field => {
  field.addEventListener('input', () => {
    const allFieldsFilled = Array.from(awardsFields).every(field => field.value.trim() !== '');
    guardianButton.disabled = !allFieldsFilled;
  });
});

guardianFields.forEach(field => {
  field.addEventListener('input', () => {
    const allFieldsFilled = Array.from(guardianFields).every(field => field.value.trim() !== '');
    userButton.disabled = !allFieldsFilled;
  });
});


buttons.addEventListener('click', handleClick);

function handleClick(e) {
  if (e.target.matches('button')) {
    panels.forEach(panel => panel.classList.remove('show'));

    const { id } = e.target.dataset;
    const selector = `.panel[id="${id}"]`;
    document.querySelector(selector).classList.add('show');
  }
}

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
    $passw = $_POST['password'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $addrs = $_POST['addrs'];
    $gendr = $_POST['gendr'];
    $age =   $_POST['age'];
    $birth = $_POST['birth'];
    $contn = $_POST['contn'];
    //$passw = $_POST['password'];
    //Student Education
    $elem = $_POST['elem'];
    $sec = $_POST['sec'];
    $ter = $_POST['ter'];
    // Student Awards
    $honor = $_POST['honor'];
    $cert = $_POST['cert'];
    // Student Guardian
    $guard = $_POST['guard'];
    $guardno = $_POST['guardno'];
    $guardaddr = $_POST['guardaddr'];

    //Email

    // Email subject and recipient
    $subject = 'New Student Registration';
    $to = $email;

    // Email body
    $body = "Hi,\n\nA new student has registered on your website with the following details:\n\n";
    $body .= "Username: $user\n";
    $body .= "First Name: $fname\n";
    $body .= "Middle Name: $mname\n";
    $body .= "Last Name: $lname\n";
    $body .= "Email: $email\n";
    $body .= "Address: $addrs\n";
    $body .= "Gender: $gendr\n";
    $body .= "Age: $age\n";
    $body .= "Date of Birth: $birth\n";
    $body .= "Contact Number: $contn\n\n";
    $body .= "Education:\n";
    $body .= "Elementary: $elem\n";
    $body .= "Secondary: $sec\n";
    $body .= "Tertiary: $ter\n\n";
    $body .= "Awards:\n";
    $body .= "Honors: $honor\n";
    $body .= "Certifications: $cert\n\n";
    $body .= "Guardian:\n";
    $body .= "Name: $guard\n";
    $body .= "Contact Number: $guardno\n";
    $body .= "Address: $guardaddr\n";

    // Email headers
    $headers = "From: example@example.com\r\n";
    $headers .= "Reply-To: example@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Send email
    

    if(mysqli_num_rows($query) > 0) {
        $sql = "UPDATE `student`
        SET `username` = '$user', `email` = '$email', `student_fname` = '$fname', `student_mname` = '$mname', `student_lname` = '$lname', `student_age` = '$age', `student_addrs` = '$addrs', `student_gendr` = '$gendr', `student_birth` = '$birth', `student_contn` = '$contn', `student_elem` = '$elem', `student_sec` = '$sec', `student_ter` = '$ter', `student_honor` = '$honor', `student_cert` = '$cert', `student_guard` = '$guard', `student_guardno` = '$guardno', `student_guardaddr` = '$guardaddr'
        WHERE `student_id` = $sid";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            //mail($email, $subject, $body, $headers);
            ?>
            <script>
               Swal.fire({
               icon: 'success',
               title: 'Profile Updated Successfully!',

           }).then((result) => {
                    if(result){
                        window.location.href = "studentinfo.php";
                    } 
                })
            </script>
           <?php
        } else {
            echo '<script>alert("Error uploading file")</script>'; 
        }
    } else {

    }
}
?>
