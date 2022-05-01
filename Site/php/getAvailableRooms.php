<?php
include 'conn.php';
$date = mysqli_real_escape_string($conn, $_REQUEST['date']);
$timeFrom = mysqli_real_escape_string($conn, $_REQUEST['timef']);
$timeTo = mysqli_real_escape_string($conn, $_REQUEST['timet']);
$module = mysqli_real_escape_string($conn, $_REQUEST['module']);
if($module == 99){//Display all Rooms
$sql="SELECT * FROM Rooms";
$result = $conn->query($sql);
$rooms = [];
$roomsAvailable = array(array(),array());
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
        array_push($roomsAvailable[1], $rooms[$i]);
        $i++;
    }
}
echo json_encode($roomsAvailable);
}else{//Display available rooms
$sql = "SET @timeFrom = DATE('$date $timeFrom:00');
SET @timeTo = DATE('$date $timeTo:00');


SELECT DISTINCT Rooms.* FROM Rooms 
LEFT JOIN Events ON  Events.Room = Rooms.Number
WHERE NOT Events.Date = \"$date\" AND ( events.Time_From <= \"$timeFrom\" AND events.Time_To >= \"$timeTo\") OR Events.Room IS NULL";
//echo $sql;
$result = $conn-> multi_query($sql);
$conn-> next_result();
$conn -> next_result();
$result = $conn->store_result();
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
/*(NOT Events.Date = \"$date\" AND ( events.Time_From <= \"$timeFrom\" AND events.Time_To >= \"$timeTo\")) OR Events.Room IS NULL

           Solution that supposed to work -> 
           
           SET @timeFrom = DATE('$date $timeFrom:00');
SET @timeTo = DATE('$date $timeTo:00');


SELECT DISTINCT Rooms.* FROM Rooms 
LEFT JOIN Events ON  Events.Room = Rooms.Number
WHERE(DATE(CONCAT(events.Date, \" \", events.Time_From)) <=   @timeFrom AND DATE(CONCAT(events.Date, \" \",events.Time_To)) >=  @timeFrom)
           OR (DATE(CONCAT(events.Date, \" \", events.Time_From)) < @timeTo AND DATE(CONCAT(events.Date, \" \",events.Time_To)) >= @timeTo ) 
           OR (  @timeFrom <= DATE(CONCAT(events.Date, \" \", events.Time_From)) AND @timeTo >= DATE(CONCAT(events.Date, \" \", events.Time_From)))
;*/
}
?> 