SELECT `events`.*,
	`modules`.`Name`,
	`rooms`.`Type`
FROM `events`
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
	LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`;
SELECT `events`.*,
	`modules`.*,
	`rooms`.`Type`,
	`module_assignment`.*,
	`programmes`.`Name`
FROM `events`
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
	LEFT JOIN `rooms` ON `events`.`Room` = `rooms`.`Number`
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`;
SELECT `events`.*,
	`modules`.`name` AS module_name,
	`modules`.`description` AS module_description,
	`modules`.`moodle_link`,
	`module_assignment`.`semester`,
	`programmes`.`name` AS programme_name,
	`programmes`.`Start_Date`,
	`programmes`.`End_Date`
FROM `events`
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`;
SELECT `events`.*,
	`modules`.`name` AS module_name,
	`modules`.`description` AS module_description,
	`modules`.`moodle_link`,
	`module_assignment`.`semester`,
	`programmes`.`name` AS programme_name,
	`semesters`.`Start_Date`,
	`semesters`.`End_Date`
FROM `events`
	LEFT JOIN `modules` ON `events`.`Module` = `modules`.`Id`
	LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id`
	LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id`
	LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`;
--Select modules by student number
SELECT `events`.*,
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
	LEFT JOIN `student_enrollment` ON `programmes`.`Id` = `student_enrollment`.`programme`
	LEFT JOIN `lecturers_assignment` ON `modules`.`Id` = `lecturers_assignment`.`module`
	LEFT JOIN `Users` ON `users`.`Id` = `lecturers_assignment`.`lecturer`
WHERE `student_enrollment`.`Student` = "S19005373";

--Select modules by programme
SELECT `events`.*,
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
	LEFT JOIN `student_enrollment` ON `programmes`.`Id` = `student_enrollment`.`programme`
	LEFT JOIN `lecturers_assignment` ON `modules`.`Id` = `lecturers_assignment`.`module`
	LEFT JOIN `Users` ON `users`.`Id` = `lecturers_assignment`.`lecturer`
WHERE `programmes`.`Id` = "1";

--Select users access level
SELECT `roles`.`Access_Level` 
FROM `users` 
	LEFT JOIN `role_assignment` ON `role_assignment`.`User` = `users`.`Id` 
	LEFT JOIN `roles` ON `role_assignment`.`Role` = `roles`.`Id`
    WHERE  `users`.`Id` = ;