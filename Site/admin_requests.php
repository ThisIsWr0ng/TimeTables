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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <input type="button" id="logout" class="glass" value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content" >
      <h1 id="admin-title" class="glass">Manage Requests</h1>
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
      <div id="form-section">
      <section>
        <form id="request-form" action="php/request.php" method="POST">
          <h1>Requests</h1>
          <section>
            <fieldset>
              <legend>Details</legend>
              <label>Id</label><br>
              <input type="text" id="form-req-id" name="requestid">

              <label>User_Id</label>
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
              <textarea id="form-req-comm" name="comment"></textarea>
            </fieldset>
          </section>
          <section>
            <input type="submit" name="btSubmit" value="Completed">
            <input type="submit" name="btSubmit" value="Denied">
            <input type="submit" name="btSubmit" value="Delete">
            <input type="submit" name="btSubmit" value="Message User">
          </section>

        </form>
      </section>
     </div>
     <div id="search-section">
     <h1>SearchBox</h1>
                <section  class="admin-search">
                    <select name="search-type" id="search-type" onchange="searchBar(' ')">
                    <option value="Requests" selected>Requests</option>
                        <option value="Users" >Users</option>
                        <option value="Programmes">Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </section >
              
                <div class="db-output-window" id="search-output">Select search type and use search bar to display results</div>
                <div id="search-list-opt">
                <input type="button" value="Refresh">
                    <input type="button" value="Export list" onclick="exportXML()">
                </div>
            
     </div>
</div>
     </div>
     <script>
        window.onload = searchBar(' ');
     </script>
    </main>
  </body>
</html>