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
    <title>Manage Events</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link rel="stylesheet" href="Style/admin.css" />
    <script src="script/searchBox.js"></script>
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
    <input type="button" id="logout" value="Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content">
      <h1 id="admin-title">Manage Events</h1>
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
        <h1>Events</h1>
        <fieldset >
          <legend>Event Type</legend>
          <form action="php/event.php" method="post">
          <label><input type="radio" id="ev-radio-session"name="sessionradio" value="Session" checked="checked" onchange="displayEventFields(this.value)"/>Session</label>
          <label><input type="radio" id="ev-radio-user"name="sessionradio" value="User Event" onchange="displayEventFields(this.value)"/>User Event</label>
          
        </fieldset>
        <fieldset>
          <legend>Event</legend>
        
        <label for="form-evt-id" id="form-evt-idlabel">Module:</label><br>
        <input type="text" id="form-evt-id" name="Id" value=""><br>
  <div id="form-name">
  <label for="form-evt-name">Name:</label><br>
  <input type="text" id="form-evt-name" name="Name" value="" required><br><br></div>

  <div id="form-type"><label for="form-evt-type">Type:</label><br>
  <select name="type" id="form-evt-type">
    <option value="Exam">Exam</option>
    <option value="Practical">Practical</option>
    <option value="Seminar">Seminar</option>
    <option value="Tutorials">Tutorials</option>
  </select><br><br></div>
  
  <label for="form-evt-date">Date:</label><br>
  <input type="date" id="form-evt-date" name="Date" value=""><br>

  <label for="form-evt-timefrom">Time from:</label><br>
  <input type="time" id="form-evt-timefrom" name="TimeF" value=""><br>
  
  <label for="form-evt-timeto">Time to:</label><br>
  <input type="time" id="form-evt-timeto" name="TimeT" value=""><br>
  
  <div id="form-rooms"><label for="form-evt-room">Rooms Available:</label><br>
  <select name="Rooms" id="form-evt-room">
  <option value="None">Select Date and Time</option>
  </select><br></div>

  <div id="form-group"><label for="form-evt-group">Group:</label><br>
  <select name="Group" id="form-evt-group">
    <option value="None">None</option>
  </select><br><br></div>

  <label for="form-evt-recurring">Recurring:</label><br>
  <select name="Recurring" id="form-evt-recurring">
    <option value="Once" selected>Once</option>
    <option value="Weekly">Weekly</option>
  </select><br><br>


  <label for="form-evt-desc">Description</label><br>
  <textarea id="form-evt-desc" name="Description" rows="4" cols="30">
  </textarea>
  
  
  <br>
  
  <input type="submit" id="form-evt-save" name="Button" value="Save">
  <input type="submit" id="form-evt-delete" name="Button" value="Delete">
</form> 
</fieldset>


     </div>
     <div id="search-section">
     <div id="search-section">
                <form class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes" >Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events" selected>Events</option>
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
     </div>
     <script>
       displayEventFields("Session");

     </script>
    </main>
  </body>
</html>