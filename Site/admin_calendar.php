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
    <script src="script/sortTable.js"></script>
    <link href="style/calendar.css" rel="stylesheet" type="text/css" />
    <script src="script/calendar.js"></script>
    <script src="script/searchBox.js"></script>
    <?php  include 'php/conn.php'; ?>
    <?php  include 'php/fetch_data.php'; ?>
  </head>
  <body>
    <header>
      <img
        id="logo"
        src="img/TimeTables-logos/TimeTables-logos_white_cropped.png"
        alt="TimeTables Logo"
      />
    </header>
    <input type="button" id="logout" class="glass"value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content">
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
      
      <div class="glass"id="search-section">
      <h1>SearchBox</h1>
                <section  class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes"selected>Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </section >
                
                <div class="db-output-window" id="search-output">Select search type and use search bar to display results</div>
                <div id="search-list-opt">
                    
                    <input type="button" value="Export list" onclick="exportXML()">
                </div>
            </div>
     </div>
      <script>
         window.onload = searchBar(' ');
        dbData = [0];

        
      </script>
    </main>
  </body>
</html>