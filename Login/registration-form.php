<?php

/*
Registration form uses Bootstrap.
Creating the code responsible for user registration. This is the registration.php page containing the previously created form linked to the PHP code and the User class
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
 
 <title>Registration</title>
</head>
<body>
 <div class="container">
  <h1>Registration</h1>
  <form action="" method="post">
   <div class="form-group">
    <p><label for="username">User Name</label><input type="text" name="username" id="username" class="form-control" placeholder="User Name" required /></p>
   </div>
   <div class="form-group">
    <p><label for="email">E-mail</label><input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required /></p>
   </div>
   <div class="form-group">
    <p><label for="password">Password</label><input type="password" name="password" id="password" class="form-control" placeholder="Password" required /></p>
   </div>
   <div class="form-group">
    <p><label for="repeated_password">Repeat password</label><input type="password" name="repeated_password" id="repeated_password" class="form-control" placeholder="Repeat password" required /></p>
   </div>
   <p><input type="submit" class="btn btn-primary" value="Register" /></p>
  </form>
 </div>
</body>
</html>

<?php else: ?>

<?php

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {

 $username = preg_replace('/[^\p{L}\p{N}]/iu', '', $_POST['username']);
 $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
 $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
 
 if(strlen($_POST['username']) >= 3) {
 
  if(strlen($_POST['username']) <= 30) {
  
   if(strlen($_POST['email']) >= 6) {
   
    if(strlen($_POST['email']) <= 30) {
    
     if(strlen($_POST['password']) >= 6) {
     
      if(strlen($_POST['password']) <= 16) {
      
       if(hash_equals($_POST['password'], $_POST['repeated_password'])) {
       
        require 'set-db-connection.php';
        require 'class.user.php';
        
        $user = new User($dbh);
        
        if(!$user->user_exist($username, $email)) {
        
         if($user->insert_user($username, $email, $password, $ip)) {
         
          echo '<p>The account has been created.</p>';
          
         }
         
         else {
         
          echo '<p>Failed to register.</p>';
          
         }
         
        }
        
        else {
        
         echo '<p>This user already exists.</p>';
         
        }
        
       }
       
       else {
       
        echo '<p>Passwords do not match.</p>';
        
       }
       
      }
      
      else {
      
       echo '<p>The password is too long</p>';
       
      }
      
     }
     
     else {
     
      echo '<p>Password is too short.</p>';
      
     }
     
    }
    
    else {
    
     echo '<p>E-mail is too long.</p>';
     
    }
    
   }
   
   else {
   
    echo '<p>E-mail is too short.</p>';
    
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

 echo '<p>Please complete all fields to register.</p>';
 
}

?>

<?php endif; ?>
