<?php

/*
Create a SQL query that creates a users table, which will store records with users.
This query can be made in phpMyAdmin or from a script.
*/

$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

/*
Description of columns in the users table:
id - unique user ID;
email - user's email;
password - user password;
*/

/*CREATE TABLE `user` (
`id` INT(11) NOT NULL AUTO_INCREMENT,
`email` VARCHAR(255) NOT NULL,
`password` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ENGINE=InnoDB AUTO_INCREMENT=1
 )");
