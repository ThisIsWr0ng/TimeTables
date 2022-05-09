<?php
require_once "conn.php";

$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
$degree = mysqli_real_escape_string($conn, $_REQUEST['degree']);
$department = mysqli_real_escape_string($conn, $_REQUEST['department']);
$level = mysqli_real_escape_string($conn, $_REQUEST['level']);
$type = mysqli_real_escape_string($conn, $_REQUEST['type']);
$year = mysqli_real_escape_string($conn, $_REQUEST['year']);
$start = mysqli_real_escape_string($conn, $_REQUEST['start']);
$end = mysqli_real_escape_string($conn, $_REQUEST['end']);
$desc = mysqli_real_escape_string($conn, $_REQUEST['desc']);
$requestType = $_POST['btSubmit'];

if ($requestType == "Add"){
if ($start == '') {
    $start = "2000-01-01";
}
if ($end == '') {
    $end = "2000-01-01";
}
$sqladd = "INSERT INTO programmes (Id, Name, Degree, Department, Level, Type, Start_Date, End_Date, Description) VALUES (NULL, '$name', '$degree', '$department', '$level', '$type', '$start', '$end', '$desc')";
mysqli_query($conn, $sqladd);

header("location: ../admin_programmes.php");
}
else if ($requestType == "Delete") {
$id = mysqli_real_escape_string($conn, $_REQUEST['id']);

$sqldel = "DELETE FROM programmes WHERE Id='$id'";
echo $sqldel;
mysqli_query($conn, $sqldel);

header("location: ../admin_programmes.php");
}
else if ($requestType == "Update") {

}
?>