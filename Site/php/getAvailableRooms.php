<?php
include 'conn.php';
$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$timeFrom = mysqli_real_escape_string($conn, $_REQUEST['timef']);
$timeTo = mysqli_real_escape_string($conn, $_REQUEST['timet']);
$module = mysqli_real_escape_string($conn, $_REQUEST['module']);
$sql = "SELECT DISTINCT Rooms.* FROM Rooms 
LEFT JOIN Events ON  Events.Room = Rooms.Number
WHERE (NOT Events.Date = \"$date\" AND NOT events.Time_From = \"$timeFrom\") OR Events.Room IS NULL";
$result = $conn->query($sql);

$rooms = [];
if ($result->num_rows > 0) {
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $rooms[$i] = array(
            'Number'=>$row['Number'],
            'Building'=>$row['Building'],
            'Number_Of_Seats'=>$row['Number_Of_Seats'],
            'Type'=>$row['Type'],
            'Equipment'=>$row['Equipment'],
            'Section'=>$row['Section'],
        );
        $i++;
    }
}
//Get numbers of students enrolled for this module
if($module != "" || $module == null){
$sql ="SELECT Users.Id FROM Users
LEFT JOIN Student_Enrolment ON Users.Id = Student_Enrolment.Student
LEFT JOIN Programmes ON Programmes.Id = Student_Enrolment.Programme
LEFT JOIN Module_Assignment ON Programmes.Id = Module_Assignment.Programme
WHERE Module_Assignment.Module = \"$module\"";
$result = $conn->query($sql);
$numStudents = $result->num_rows;

$roomsAvailable = array(array(),array());
for ($i=0; $i < count($rooms); $i++) { 
    if ($rooms[$i]['Number_Of_Seats']<= $numStudents) {
        array_push($roomsAvailable[0], $rooms[$i]);
    } else {
        array_push($roomsAvailable[1], $rooms[$i]);
    }
    
}
}else{
    for ($i=0; $i < count($rooms); $i++) { 
        array_push($roomsAvailable[1], $rooms[$i]);
    }

}
echo json_encode($roomsAvailable);
?>