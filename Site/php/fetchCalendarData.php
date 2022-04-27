<?php 

 //Fetch event data based on user ID
    include 'conn.php';
    $student = mysqli_real_escape_string($conn, $_REQUEST['user']);
    if(strlen($student) == 9){
    $sql = "SELECT `events`.*,`rooms`.`type` AS room_type,`modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `programmes`.`name`AS programme_name, `semesters`.`start_date`, `semesters`.`end_date`
    FROM `events`
      LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
      LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
      LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
        LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
        LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
        LEFT JOIN `student_enrolment`ON `programmes`.`Id` = `student_enrolment`.`Programme`
        WHERE `student_enrolment`.`Student` = '$student';";
    }else {
        $sql = "SELECT `events`.*,`rooms`.`type` AS room_type,`modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `semesters`.`start_date`, `semesters`.`end_date`
    FROM `events`
      LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
      LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
       LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
        LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
        LEFT JOIN `lecturers_assignment`ON `modules`.`Id` = `lecturers_assignment`.`Module`
        WHERE `lecturers_assignment`.`Lecturer` = '$student';";
    }
    //echo $sql;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $array = null;
        $i = 0;
        while ($row = $result->fetch_assoc()) { //separate outputs with for loop?
            $array[$i] = array(
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
                //'programme_name' => $row["programme_name"],
                'start_date' => $row["start_date"],
                'end_date' => $row["end_date"],
            );
            $i += 1;
        }
        echo json_encode($array);

    } else {
        echo "Error Fetching from database";
    }
    $conn->close();

?>