<?php 
include 'conn.php';
$user = mysqli_real_escape_string($conn, $_REQUEST['user']);
$type = mysqli_real_escape_string($conn, $_REQUEST['type']);
$message = mysqli_real_escape_string($conn, $_REQUEST['description']);

$sql = "INSERT INTO Requests VALUES(
    NULL,
    '$user',
    '$type',
    '$message',
    0
);";
$result = $conn->query($sql);




header("location: ../lecturer_personal_timetable.php");
?>