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
    <title>Admin Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <input type="button" id="logout" class="glass" value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content" class="glass">
      <h1 id="admin-title" class="glass" >Admin Dashboard</h1>
      <nav id="admin-nav" class="glass">
      <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
        <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
        <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
        <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
        <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
        <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
        <input type="button" value="Import Data" onclick="location.href='admin_import.php'"/>
        <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
      </nav>
      <div id="content-block" class="glass">
      
      <section>
      <?php
        echo "<h1 id='welcome'>Welcome $username!</h1>"
      ?>
      
      <?php
      include 'php/conn.php';
      $sql="SELECT * FROM requests WHERE status = 0";
      $result = $conn->query($sql);
      $count = 0;
      
        while (mysqli_fetch_array($result)) {
          $count++;
        }
       
        echo "<a href='admin_requests.php'><h2>You have $count active requests!</h2></a>";
      
      
      ?>
      <a href="User_Manual.pdf" target="_blank"><h2>User Manual<h2></a>
      </section>
</div>
    </main>
  </body>
</html>
