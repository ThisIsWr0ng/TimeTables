
SELECT `events`.*, `modules`.`Name`, `rooms`.`Type`
FROM `events` 
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
	LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`;

    SELECT `events`.*, `modules`.*, `rooms`.`Type`, `module_assignment`.*, `programmes`.`Name`
FROM `events` 
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
	LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number` 
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`;

	SELECT `events`.*, `modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `programmes`.`name`AS programme_name, `programmes`.`Start_Date`, `programmes`.`End_Date`
FROM `events` 
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`;


	SELECT `events`.*, `modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `programmes`.`name`AS programme_name, `semesters`.`Start_Date`, `semesters`.`End_Date`
FROM `events` 
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
    LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`;
    
--Select modules by student number
SELECT `events`.*,`rooms`.`type` AS room_type,`modules`.`name`AS module_name,`modules`.`description` AS module_description, `modules`.`moodle_link`, `module_assignment`.`semester`, `programmes`.`name`AS programme_name, `semesters`.`start_date`, `semesters`.`end_date`
FROM `events` 
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id` 
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
    LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
    LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
    LEFT JOIN `student_enrollment`ON `programmes`.`Id` = `student_enrollment`.`Programme`
    WHERE `student_enrollment`.`Student` = "S19005373";