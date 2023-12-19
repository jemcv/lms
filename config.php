<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "scms";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$database=new mysqli($servername, $username, $password, $dbname);
$database->select_db("$dbname");

?>