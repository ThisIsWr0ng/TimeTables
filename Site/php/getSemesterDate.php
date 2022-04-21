<?php 
include'conn.php';
$id = mysqli_real_escape_string($conn, $_REQUEST['q']);

$sql="SELECT Semesters.Start_Date FROM Semesters LEFT JOIN Module_Assignment ON Semesters.Id = Module_Assignment.Semester WHERE Module_Assignment.Module = \"$id\"";

$result = $conn->query($sql);
if($result){
$date = $result->fetch_assoc();
$date = $date['Start_Date'];
echo $date;
}
?>