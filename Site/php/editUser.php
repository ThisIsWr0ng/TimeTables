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

$role = mysqli_real_escape_string($conn, $_REQUEST['role']);
$progamme = mysqli_real_escape_string($conn, $_REQUEST['programme']);
$level = mysqli_real_escape_string($conn, $_REQUEST['level']);
$uniemail = mysqli_real_escape_string($conn, $_REQUEST['uniemail']);

$sql = "SELECT * FROM users WHERE "


?>