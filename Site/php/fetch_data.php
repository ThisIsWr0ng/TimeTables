<?php 
function fetchEvents($student) {//Fetch event data based on user ID
    include 'conn.php';
    $sql = "SELECT `events`.*,`rooms`.`type` AS room_type,`modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `programmes`.`name`AS programme_name, `semesters`.`start_date`, `semesters`.`end_date`
    FROM `events` 
      LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
      LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
      LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
        LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
        LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
        LEFT JOIN `student_enrollment`ON `programmes`.`Id` = `student_enrollment`.`Programme`
        WHERE `student_enrollment`.`Student` = '$student';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      $array = null;
      $i = 0;
      while($row = $result->fetch_assoc()) {//separate outputs with for loop?
        $array[$i]= array(
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
        'end_date' => $row["end_date"],
      );
        $i += 1;
      }
     return $array;
      
    } else{
      echo "Error Fetching from database";
    }
    $conn->close();
}

function fetchProgrammes(){//Fetch all programmes
  include_once 'conn.php';
$sql ="SELECT * FROM programmes";
$result = $conn->query($sql);
return $result;
}
?>