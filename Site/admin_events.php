<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Manage Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link rel="stylesheet" href="Style/admin.css" />
    <script src="script/sortTable.js"></script>
    <script src="script/searchBox.js"></script>
    <script src="script/events.js"></script>
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
      <h1 id="admin-title" class="glass">Manage Events</h1>
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
        <h1>Events</h1>
        <fieldset >
          <legend>Event Type</legend>
          <form action="php/event.php" method="post" novalidate>
          <label><input type="radio" id="ev-radio-session"name="sessionradio" value="Session" checked="checked" onchange="displayEventFields(this.value)"/>Session</label>
          <label><input type="radio" id="ev-radio-user"name="sessionradio" value="User Event" onchange="displayEventFields(this.value)"/>User Event</label>

        </fieldset>
        <fieldset>
          <legend>Event</legend>

        <label for="form-evt-id" id="form-evt-idlabel">Module:</label><br>
        <input type="text" id="form-evt-id" name="Id" value=""><br>
  <div id="form-name">
  <label for="form-evt-name">Name:</label><br>
  <input type="text" id="form-evt-name" name="eName" value="" required><br><br></div>

  <div id="form-type"><label for="form-evt-type">Type:</label><br>
  <select name="Type" id="form-evt-type">
    <option value="Exam">Exam</option>
    <option value="Practical">Practical</option>
    <option value="Seminar">Seminar</option>
    <option value="Tutorials">Tutorials</option>
    <option value="Self-Directed Study">Self-Directed Study</option>
  </select><br><br></div>

  <label for="form-evt-date">Date:</label><br>
  <input type="date" id="form-evt-date" name="Date" value="">
  <input type="button" value="Start of Semester" onclick="getModuleStartDate()"><br>

  <label for="form-evt-timefrom">Time from:</label><br>
  <input type="time" id="form-evt-timefrom" name="TimeF" value=""><br>

  <label for="form-evt-timeto">Time to:</label><br>
  <input type="time" id="form-evt-timeto" name="TimeT" value=""><br>

  <div id="form-rooms"><label for="form-evt-room">Rooms Available:</label><br>
  <select name="Rooms" id="form-evt-room" >
  <option value="None">Select Date and Time</option>
  </select><input type="button" value="Refresh" onclick="refreshRooms(1)">
  <input type="button" value="Show All" onclick="refreshRooms(0)"><br></div>

  <div id="form-group"><label for="form-evt-group">Group:</label><br>
  <select name="Group" id="form-evt-group">
    <option value="NULL" selected>None</option>
  </select><br><br></div>


  <label for="form-evt-desc">Description</label><br>
  <textarea id="form-evt-desc" name="Description" rows="4" cols="30">
  </textarea>
  <br>
  <fieldset>
  <label for="form-evt-recurring">Recurring:</label><br>
  <select name="Recurring" id="form-evt-recurring">
    <option value="Once" >Once</option>
    <option value="Weekly"selected>Weekly</option>
  </select><br><br>

  <input type="submit" id="form-evt-save" name="sButton" value="Save">
  <input type="submit" id="form-evt-delete" name="sButton" value="Delete">
  </fieldset>
</form>
</fieldset>


     </div>
     <div id="search-section">
     <h1>SearchBox</h1>
                <section class="admin-search">
                    <select name="search-type" id="search-type" onchange="searchBar(' ')">
                        <option value="Users" >Users</option>
                        <option value="Programmes" >Programmes</option>
                        <option value="Modules" selected>Modules</option>
                        <option value="Events" >Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" onload="searchBar(' ')" value="Search" onclick='removeText()' tabindex='1'/>
                </Section>

                <div class="db-output-window" id="search-output">Select search type and use search bar to display results</div>
                <div id="search-list-opt">

                    <input type="button" value="Export list" onclick="exportXML()">
                </div>
            </div>
     </div>

     </div>
     <script>
      window.onload = searchBar(' ');
       displayEventFields("Session");

     </script>
    </main>
  </body>
</html>