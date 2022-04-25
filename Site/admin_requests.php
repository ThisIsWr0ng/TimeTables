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
    <script src="script/sortTable.js"></script>
    <script src="script/searchBox.js"></script>
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
              <input type="text" id="form-req-id" name="requestid">

              <label>User Id</label>
              <input type="text" id="form-req-uid" name="userid">

              <label>Username</label>
              <input type="text" id="form-req-username" name="username">

              <label>Request Type</label>
              <input type="text" id="form-req-type" name="requesttype">

              <label>Current Status</label>
              <input type="text" id="form-req-stat" name="status">

              <label>Description</label>
              <input type="text" id="form-req-desc" name="description">
            </fieldset>
          </section>
          <section>
            <fieldset>
              <legend>Comments/Messages</legend>
              <input type="text" id="form-req-comm" name="comment">
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
                <form class="admin-search">
                    <select name="search-type" id="search-type">
                    <option value="Requests" selected>Requests</option>
                        <option value="Users" >Users</option>
                        <option value="Programmes">Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </form>
                <div id="search-list-opt-top">
                    <input type="button" name="list-remove" id="list-remove" value="-">
                    <input type="button" name="list-add" id="list-add" value="+" onclick="">
                </div>
                <div class="db-output-window" id="search-output"></div>
                <div id="search-list-opt">
                    <input type="button" value="Import List">
                    <input type="button" value="Export list">
                </div>
            
     </div>
</div>
     </div>
    </main>
  </body>
</html>