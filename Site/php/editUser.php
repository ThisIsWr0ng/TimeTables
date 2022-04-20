<?php
require_once "conn.php";

$id = mysqli_real_escape_string($conn, $_REQUEST['userid']);
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
$uniemail = mysqli_real_escape_string($conn, $_REQUEST['uniemail']);
$programme = mysqli_real_escape_string($conn, $_REQUEST['programme']);

$sqluser = "UPDATE users SET First_Name='$firstname', Surname='$surname', Title='$title', Gender='$gender', Birth_Date='$dob', Priv_Email='$privatemeail', Uni_Email='$uniemail', Telephone='$tel', Next_Of_Kin='$nextofkin', Street_Number='$housenumber', Street_Name='$street', Postcode='$postcode' WHERE Id='$id'";
$conn->query($sqluser);

$sqlenrolment = "UPDATE student_enrolment SET Programme='$programme', Date_Enrolled=NOW() WHERE Student='$id'";
$conn->query($sqlenrolment);

header("location: ../admin_user.php");
?>