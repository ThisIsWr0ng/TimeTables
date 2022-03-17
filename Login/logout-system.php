<?php

/*
Logout System
*/



 session_start();
 
 unset($_SESSION['logged']);
 unset($_SESSION['username']);
 
 session_destroy();
 
 header('Location: login.php');
 
 exit;
