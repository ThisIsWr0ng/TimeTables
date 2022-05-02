<?php
include 'conn.php';
$id = mysqli_real_escape_string($conn, $_REQUEST['id']);
$type = mysqli_real_escape_string($conn, $_REQUEST['type']);

//create sql
$sql ="SELECT `events`.*,
`rooms`.`type` AS room_type,
`modules`.`name` AS module_name,
`modules`.`description` AS module_description,
`modules`.`moodle_link`,
`users`.`surname`+', '+`users`.`first_name` AS lecturer,
`module_assignment`.`semester`,
`programmes`.`name` AS programme_name,
`semesters`.`start_date`,
`semesters`.`end_date`
FROM `events`
LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
LEFT JOIN `student_enrolment` ON `programmes`.`Id` = `student_enrolment`.`programme`
LEFT JOIN `lecturers_assignment` ON `modules`.`Id` = `lecturers_assignment`.`module`
LEFT JOIN `Users` ON `users`.`Id` = `lecturers_assignment`.`lecturer`
";
if ($type == "Programmes") {
   $sql .="WHERE Module_Assignment.Programme = \"$id\"";
} else if($type == "Modules"){
    $sql .="WHERE Events.Module = \"$id\"";

}else if($type == "Rooms"){
    $sql .="WHERE Events.Room = \"$id\"";
}
//echo $sql;
//query sql
$result = $conn->query($sql);

//put results in an array
$i =0;
$events = null;


while ($row = mysqli_fetch_array($result)) {
        $events[$i] = array(
            'module' => $row["Module"],
               'room' => $row["Room"],
               'type' => $row["Type"],
               'date' => $row["Date"],
               'time_from' => $row["Time_From"],
               'time_to' => $row["Time_To"],
               'description' => $row["Description"],
               'room_type' => $row["room_type"],
               'module_name' => $row["module_name"],
               'module_description' => $row["module_description"],
               'moodle_link' => $row["moodle_link"],
               'semester' => $row["semester"],
               'programme_name' => $row["programme_name"],
               'start_date' => $row["start_date"],
               'end_date' => $row["end_date"]

            
        );
        $i++;
    }

echo json_encode($events);
?>