<?php //Adding User Events 
include 'conn.php';
$name = mysqli_real_escape_string($conn, $_REQUEST['eName']);
$desc = mysqli_real_escape_string($conn, $_REQUEST['details']);
$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$timeF = mysqli_real_escape_string($conn, $_REQUEST['timeFrom']);
$timeT = mysqli_real_escape_string($conn, $_REQUEST['timeTo']);
$user = mysqli_real_escape_string($conn, $_REQUEST['user']);

$sql="INSERT INTO User_Events VALUES (
    NULL,
    \"$user\",
    \"$name\",
    \"$date\",
    \"$timeF\",
    \"$timeT\",
    \"$desc\"
)";
$conn->query($sql);
$conn->close();


if(strlen($user) <= 9){
    header("location: ../personal_timetable.php");
}else{
    header("location: ../lecturer_personal_timetable.php");
}
?>