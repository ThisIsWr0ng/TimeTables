
<?php /* Code snippets from: https://www.w3schools.com/*/


function fetchProgrammeEvents($id){//Fetch events on programme id
    include 'conn.php';
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
WHERE `programmes`.`Id` = '$id';";
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
               'programme_name' => $row["programme_name"],
               'start_date' => $row["start_date"],
               'end_date' => $row["end_date"],
           );
           $i += 1;
       }
       return $array;

   } else {
       echo "Error Fetching from database";
   }
   $conn->close();
}
function fetchUsers(){
    include 'conn.php';
    $sql ="SELECT `Users`.*,
	`Roles`.`Name` AS `Role`,
    `Programmes`.`Name` AS `Programme`,
    `Programmes`.`Level` AS `Level`
FROM Users
	LEFT JOIN `role_assignment` ON `role_assignment`.`User` = `users`.`Id`
	LEFT JOIN `roles` ON `role_assignment`.`Role` = `roles`.`Id`
    LEFT JOIN `student_enrolment` ON `Users`.`Id` = `student_enrolment`.`Student`
    LEFT JOIN `programmes` ON `student_enrolment`.`Programme` = `Programmes`.`Id`";
    $result = $conn->query($sql);
    $i =0;
    $users =null;
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
            "Postcode" => $row["Postcode"],
            "Role" => $row["Role"],
            "Programme" => $row["Programme"],
            "Level" => $row["Level"],);
            $i += 1;
    }
 
    return $users;
    $conn->close();
}
function fetchProgrammes(){
    include 'conn.php';
    $sql ="SELECT * FROM Programmes";
    $result = $conn->query($sql);
    $i =0;
    $Programmes =null;
    while ($row = mysqli_fetch_array($result)) {
        $Programmes[$i] = array(
            'Id' => $row["Id"],
            'Name' => $row["Name"],
            'Degree' => $row["Degree"],
            'Department' => $row["Department"],
            'Level' => $row["Level"],
            'Start_Date' => $row["Start_Date"],
            'End_Date' => $row["End_Date"],
            'Description' => $row["Description"],
            'Type' => $row["Type"]);
            $i += 1;
    }
 
    return $Programmes;
    $conn->close();
}
function fetchModulesToProgrammes(){
    include 'conn.php';
    $sql ="SELECT `modules`.*, `programmes`.`Id` AS `Programme`, `semesters`.`Year`,`semesters`.`Name` AS `Semester`
    FROM `modules` 
        LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
        LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id` 
        LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`";
   $result = $conn->query($sql);
   $i =0;
   $modules =null;
   while ($row = mysqli_fetch_array($result)) {
       $modules[$i] = array(
           'Id' => $row["Id"],
           'Name' => $row["Name"],
           'Description' => $row["Description"],
           'Moodle_Link' => $row["Moodle_Link"],
           'Programme' => $row["Programme"],
           'Year' => $row["Year"],
           'Semester' => $row["Semester"]);
           $i += 1;
   }
   return $modules;
    $conn->close();

}
function fetchModules(){
    include 'conn.php';
    $sql ="SELECT *
    FROM `modules`";
   $result = $conn->query($sql);
   $i =0;
   $modules =null;
   while ($row = mysqli_fetch_array($result)) {
       $modules[$i] = array(
           'Id' => $row["Id"],
           'Name' => $row["Name"],
           'Description' => $row["Description"],
           'Moodle_Link' => $row["Moodle_Link"]);
           $i += 1;
   }
   return $modules;
    $conn->close();

}
function fetchModulesFull(){
   
}

?>
