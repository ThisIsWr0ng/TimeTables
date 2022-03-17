<?php

/*
User Registration System. A script uses a PDO driver to communicate with the database.
Create a class.user.php file with the User class. It contains a method for checking whether a given user exists and a method for saving the user to the database.
*/



 class User {
 
  function __construct($dbh) {
  
   $this->dbh = $dbh;
   
  }
  
  public function login($username, $password) {
  
   $sth = $this->dbh->prepare('SELECT password FROM users WHERE username = :username LIMIT 1');
   
   $sth->bindParam(':username', $username, PDO::PARAM_STR);
   
   $sth->execute();
   
   $row = $sth->fetch(PDO::FETCH_ASSOC);
   
   if($row && password_verify($password, $row['password']) === true) {
   
    return true;
    
   }
   
   else return false;
   
  }
  
  public function user_exist($username, $email) {
  
   $sth = $this->dbh->prepare('SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1');
   
   $sth->bindParam(':username', $username, PDO::PARAM_STR);
   $sth->bindParam(':email', $email, PDO::PARAM_STR);
   
   $sth->execute();
   
   return $sth->fetch(PDO::FETCH_ASSOC);
   
  }
  
  public function insert_user($username, $email, $password, $ip) {
  
   $sth = $this->dbh->prepare("INSERT INTO users (id, registered_timestamp, username, email, password, ip) VALUES('', CURRENT_TIMESTAMP(), :username, :email, :password, :ip)");
   
   $sth->bindParam(':username', $username, PDO::PARAM_STR);
   $sth->bindParam(':email', $email, PDO::PARAM_STR);
   $sth->bindParam(':password', $password, PDO::PARAM_STR);
   $sth->bindParam(':ip', $ip, PDO::PARAM_STR);
   
   return $sth->execute();
   
  }
  
 }
