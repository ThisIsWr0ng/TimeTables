<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Admin Calendar</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link rel="stylesheet" href="Style/admin.css" />
  </head>
  <body>
    <header>
      <img
        id="logo"
        src="img/TimeTables-logos/TimeTables-logos_white_cropped.png"
        alt="TimeTables Logo"
      />
    </header>
    <input type="button" id="logout" value="Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content">
      <nav id="admin-nav">
      <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
        <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
        <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
        <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
        <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
        <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
        <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
      </nav>
     
    </main>
  </body>
</html>