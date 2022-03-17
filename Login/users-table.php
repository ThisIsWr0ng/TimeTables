<?php

/*
Create a SQL query that creates a users table, which will store records with users.
This query can be made in phpMyAdmin or from a script.
*/

$dbh = new PDO('mysql:host=localhost;dbname=test', $user, $pass);

/*
Description of columns in the users table:
id - unique user ID;
registered_timestamp - date of registration in the form of a timestamp;
username - username;
email - user's email;
password - user password;
ip - IP from which the account was created;
*/

$dbh->exec("CREATE TABLE IF NOT EXISTS `users` (
 `id` int(10) NOT NULL AUTO_INCREMENT,
 `registered_timestamp` int(10) NOT NULL,
 `username` varchar(30) NOT NULL,
 `email` varchar(50) NOT NULL,
 `password` varchar(255) NOT NULL,
 `ip` varchar(100) NOT NULL,
 PRIMARY KEY (`id`)
 )");
