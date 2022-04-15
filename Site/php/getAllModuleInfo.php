<?php
include 'conn.php';
$moduleId = $_REQUEST['q'];
$sql = "SELECT * FROM `Modules` WHERE `Id` = \"$moduleId\"";
$result = $conn->query($sql);


$modules =null;
while ($row = mysqli_fetch_array($result)) {
    $modules[0] = array(
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'Description' => $row["Description"],
        'Moodle_Link' => $row["Moodle_Link"]);
        break;
}
echo print_r($modules);
$sql ="SELECT * FROM Users LEFT JOIN Lecturers_Assignment ON Lecturers_Assignment.Lecturer = Users.Id
WHERE Lecturers_Assignment.Module = \"$moduleId\"";
echo $sql;

?>