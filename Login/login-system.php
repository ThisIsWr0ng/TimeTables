<?php

/*
Login System
*/



 ini_set('display_errors', '1');
 
 error_reporting(E_ALL);
 
 if(!isset($_POST['username'])):
 
?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.css" type="text/css" media="screen" />
  
  <title>Login</title>
 </head>
 <body>
  <div class="container">
   <h1>Login</h1>
   <form action="" method="post">
    <div class="form-group">
     <p><label for="username">User name</label><input type="text" name="username" id="username" class="form-control" placeholder="User name" required /></p>
    </div>
    <div class="form-group">
     <p><label for="password">Password</label><input type="password" name="password" id="password" class="form-control" placeholder="Password" required /></p>
    </div>
    <p><input type="submit" class="btn btn-primary" value="Login" /></p>
   </form>
  </div>
 </body>
</html>

<?php else: ?>

<?php

 if(!empty($_POST['username']) && !empty($_POST['password'])) {
 
  if(strlen($_POST['username']) >= 3) {
  
   if(strlen($_POST['username']) <= 30) {
   
    if(strlen($_POST['password']) >= 6) {
    
     if(strlen($_POST['password']) <= 16) {
     
      require 'set-db-connection.php';
      require 'class.user.php';
      
      $username = preg_replace('/[^\p{L}\p{N}]/iu', '', $_POST['username']);
      
      $user = new User($dbh);
      
      if($user->login($username, $_POST['password'])) {
      
       session_start();
       
       $_SESSION['logged'] = 1;
       $_SESSION['username'] = $username;
       
       header('Location: logged.php');
       
       exit;
       
      }
      
      else {
      
       echo '<p>Incorrect login details.</p>';
       
      }
      
     }
     
     else {
     
      echo '<p>The password is too long.</p>';
      
     }
     
    }
    
    else {
    
     echo '<p>Password is too short.</p>';
     
    }
    
   }
   
   else {
   
    echo '<p>Username is too long.</p>';
    
   }
   
  }
  
  else {
  
   echo '<p>Username is too short.</p>';
   
  }
  
 }
 
 else {
 
  echo '<p>Please complete all fields to log in.</p>';
  
 }
 
?>

<?php endif; ?>
