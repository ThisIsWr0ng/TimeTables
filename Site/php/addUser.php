<?php

require_once "conn.php";
$firstname = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
$title = mysqli_real_escape_string($conn, $_REQUEST['title']);
$gender = mysqli_real_escape_string($conn, $_REQUEST['gender']);
$dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);
$nextofkin = mysqli_real_escape_string($conn, $_REQUEST['nextofkin']);
$privatemeail = mysqli_real_escape_string($conn, $_REQUEST['privateemail']);
$tel = mysqli_real_escape_string($conn, $_REQUEST['tel']);

$housenumber = mysqli_real_escape_string($conn, $_REQUEST['housenumber']);
$street = mysqli_real_escape_string($conn, $_REQUEST['street']);
$postcode = mysqli_real_escape_string($conn, $_REQUEST['postcode']);

$userid = mysqli_real_escape_string($conn, $_REQUEST['userid']);
$role = mysqli_real_escape_string($conn, $_REQUEST['role']);
$level = mysqli_real_escape_string($conn, $_REQUEST['level']);
$uniemail = mysqli_real_escape_string($conn, $_REQUEST['uniemail']);

$sqlusers = "INSERT INTO users (Id, First_Name, Surname, Title, Gender, Birth_Date, Priv_Email, Uni_Email, Telephone, Next_Of_Kin, Street_Number, Street_Name, Postcode) VALUES (NULL, '$firstname', '$surname', '$title', '$gender', '$dob', '$privatemeail', '$uniemail', '$tel', '$nextofkin', '$housenumber', '$street', '$postcode')";
mysqli_query($conn, $sqlusers);



header("location: ../admin_users.php");
?>