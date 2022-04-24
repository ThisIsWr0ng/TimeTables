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
    <title>Manage Requests</title>
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
    <?php echo "<h3 id='log'>Logged in: $username</h3>" ?>
    <main class="admin-content">
      <h1 id="admin-title">Manage Requests</h1>
      <nav id="admin-nav">
      <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
        <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
        <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
        <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
        <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
        <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
        <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
      </nav>
     
      <div id="content-block">
      <div id="form-section">
      <section>
        <form id="request-form" action="php/request.php" method="POST">
          <h1>Requests</h1>
          <section>
            <fieldset>
              <legend>Details</legend>
              <label>Id</label><br>
              <input type="text" name="requestid">

              <label>User Id</label>
              <input type="text" name="userid">

              <label>Username</label>
              <input type="text" name="username">

              <label>Request Type</label>
              <input type="text" name="requesttype">

              <label>Module</label>
              <input type="text" name="module">

              <label>Current Status</label>
              <input type="text" name="status">

              <label>Description</label>
              <input type="text" name="description">
            </fieldset>
          </section>
          <section>
            <fieldset>
              <legend>Comments/Messages</legend>
              <input type="text" name="comment">
            </fieldset>
          </section>
          <section>
            <input type="submit" value="Mark as Completed">
            <input type="submit" value="Mark as Denied">
            <input type="submit" value="Delete">
            <input type="submit" value="Message User">
          </section>

        </form>
      </section>
     </div>
     <div id="search-section">
       
     </div>
</div>
     </div>
    </main>
  </body>
</html>