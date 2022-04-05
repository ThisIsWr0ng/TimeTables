
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