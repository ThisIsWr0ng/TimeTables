<?php //Get deadlines by module Id
include 'conn.php';
$moduleId = mysqli_real_escape_string($conn,  $_REQUEST['module']);
$name = mysqli_real_escape_string($conn,  $_REQUEST['name']);
$weight = mysqli_real_escape_string($conn,  $_REQUEST['weight']);
$date = mysqli_real_escape_string($conn,  $_REQUEST['date']);
$moodle = mysqli_real_escape_string($conn,  $_REQUEST['moodle']);

$sql = "INSERT INTO Deadlines VALUES (
    NULL,
    '$moduleId',
    '$name',
    '$date',
    '$weight',
    '$moodle'

);";
echo $sql;
$result = $conn->query($sql);


return $result;
?>