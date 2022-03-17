<?php

/*
Database connection. Creation of the set-db-connection.php file, in which the connection with the MySQL database through the PDO driver is set
*/

$dbh = new PDO('mysql:host=localhost;dbname=test', 'username', 'password');
