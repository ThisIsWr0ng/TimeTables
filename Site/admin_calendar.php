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
    <input type="button" id="logout" value="Logout" onclick="location.href='php/logout.php'"/>
    <?php echo "<h3 id='log'>Logged in: $username</h3>" ?>
    <main class="admin-content">
      <nav id="admin-nav">
      <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
        <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
        <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
        <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
        <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
        <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
        <input type="button" value="Import Data" onclick="location.href='admin_import.php'"/>
        <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
      </nav>
      <div id="cal-wrap">
        <!-- (A) PERIOD SELECTOR -->
        <div id="cal-date">
          <select id="cal-mth"></select>
          <select id="cal-yr"></select>
        </div>

        <!-- (B) CALENDAR -->
        <div id="cal-container"></div>

        <!-- (C) EVENT FORM -->
        <?php /*<div id="overlay">
          <form id="cal-event" action="php/eventRequest.php" method="post">
            <div id="evt-head"></div>
            <input type="date" id="evt-date" name="date" />
            <div id="evt-time"></div>
            <div id="evt-room"></div>
            <div id="request-fileds">
              <label for="eName">Event name:</label>
              <input type="text" id="eName" name="eName" required /><br />

              <label for="tFrom">Time From:</label>
              <input
                type="time"
                id="tFrom"
                name="timeFrom"
                min="12:00"
                max="00:00"
                required
              />
              <label for="tTo">Time To:</label>
              <input
                type="time"
                id="tTo"
                name="timeTo"
                min="12:00"
                max="00:00"
              /><br />

              <label for="evt-details">Event description:</label>
            </div>

            <textarea id="evt-details" name="details" readonly></textarea>
            <input id="evt-close" type="button" value="Close" />
            <input id="evt-request" type="button" value="Add Event" />
            <input id="evt-moodle-page" type="button" value="Moodle Page" />
            <input id="evt-next" type="button" value="Next -->" />
          </form>
        </div>*/?>
      </div>

      
      <div id="search-section">
                <form class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes"selected>Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </form>
                
                <div class="db-output-window" id="search-output"></div>
                <div id="search-list-opt">
                    
                    <input type="button" value="Export list">
                </div>
            </div>
     </div>
      <script>
        dbData = [0];

        
      </script>
    </main>
  </body>
</html>