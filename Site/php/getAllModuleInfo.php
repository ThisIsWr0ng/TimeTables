<?php
include 'conn.php';
$moduleId = $_REQUEST['q'];
//Get Module info
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
//Get Lecturers Info on this module
$sql ="SELECT * FROM Users LEFT JOIN Lecturers_Assignment ON Lecturers_Assignment.Lecturer = Users.Id
WHERE Lecturers_Assignment.Module = \"$moduleId\"";

$result = $conn->query($sql);
$i =0;
$users =null;
if ($result->num_rows > 0){
while ($row = mysqli_fetch_array($result)) {
    $users[$i] = array(
        "Id" => $row["Id"],
        "First_Name" => $row["First_Name"],
        "Surname" => $row["Surname"],
        "Title" => $row["Title"],
        "Gender" => $row["Gender"],
        "Birth_Date" => $row["Birth_Date"],
        "Priv_Email" => $row["Priv_Email"],
        "Uni_Email" => $row["Uni_Email"],
        "Telephone" => $row["Telephone"],
        "Next_Of_Kin" => $row["Next_Of_Kin"],
        "Street_Number" => $row["Street_Number"],
        "Street_Name" => $row["Street_Name"],
        "Postcode" => $row["Postcode"]);
        $i += 1;
}
$modules[1] = $users;
}else{
    $modules[1] = "No Lecturers Assigned";
}
//Get Deadlines on this module
$sql = "SELECT * FROM Deadlnes WHERE Module_Id = \"$moduleId\"";
$result = $conn->query($sql);
$i =0;
$deadlines =null;

if ($result){
while ($row = mysqli_fetch_array($result)) {
    $deadlines[$i] = array(
        'Name'=>$row['Name'],
        'Date'=>$row['Date'],
        'Weight'=>$row['Weight'],
        'Moodle_Link'=>$row['Moodle_Link'],
    );
}
$modules[2] = $deadlines;
}else{
    $modules[2] = "No Deadlines For $moduleId";
}
//Get Groups of students for this module
$sql = "SELECT Users.Id, Users.First_Name, Users.Surname, Student_Group.Group_Name AS Group FROM Users LEFT JOIN Student_Group ON Student_Group.User = Users.Id
WHERE Student_Group.Module = \"$moduleId\"";
$result = $conn->query($sql);
$i =0;
$groups =null;
if ($result){
while ($row = mysqli_fetch_array($result)) {
    $groups[$i] = array(
        'Id'=>$row['Id'],
        'First_Name'=>$row['First_Name'],
        'Surname'=>$row['Surname'],
        'Group'=>$row['Group'],
    );
}
$modules[3] = $groups;
}else{
    $modules[3] ="No Groups Assigned!";
}

echo json_encode($modules);//[0] - Module Info [1] - Lecturers [2] - Deadlines [3] - Student Groups
?>