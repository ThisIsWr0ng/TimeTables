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
    <?php include 'php/fetch_data.php'?>
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
          <form>
          <label><input type="radio" id="ev-radio-session"name="sessionradio" value="Session" checked="checked"/>Session</label>
          
          <label><input type="radio" id="ev-radio-user"name="sessionradio" value="User Event"/>User Event</label>
          </form>
        </fieldset>
        <fieldset>
          <legend>Event</legend>
        <form action="">
        <label for="form-evt-id">Module:</label><br>
        <input type="text" id="form-evt-id" name="mod" value=""><br>
  
  <label for="form-evt-name">Name:</label><br>
  <input type="text" id="form-evt-name" name="lname" value="" required><br><br>

  <label for="form-evt-type">Type:</label><br>
  <select name="type" id="form-evt-type">
    <option value="Exam">Exam</option>
    <option value="Practical">Practical</option>
    <option value="Seminar">Seminar</option>
    <option value="Tutorials">Tutorials</option>
  </select><br><br>
  
  <label for="form-evt-date">Date:</label><br>
  <input type="date" id="form-evt-date" name="dow" value=""><br>

  <label for="form-evt-timefrom">Time from:</label><br>
  <input type="time" id="form-evt-timefrom" name="tf" value=""><br>
  
  <label for="form-evt-timeto">Time to:</label><br>
  <input type="time" id="form-evt-timeto" name="tt" value=""><br>
  
  <label for="form-evt-room">Rooms Available:</label><br>
  <select name="" id="form-evt-room">
  <option value="None">Select Date and Time</option>
  </select><br>

  <label for="form-evt-group">Group:</label><br>
  <select name="" id="form-evt-group">
    <option value="None">None</option>
  </select><br><br>

  <label for="form-evt-recurring">Recurring:</label><br>
  <select name="" id="form-evt-recurring">
    <option value="Once">Once</option>
    <option value="Weekly">Weekly</option>
  </select><br><br>


  <label for="form-evt-desc">Description</label><br>
  <textarea id="form-evt-desc" name="desc" rows="4" cols="30">
  </textarea>
  
  
  <br>
  
  <input type="submit" id="form-evt-save" name="btSubmit" value="Save">
  <input type="submit" id="form-evt-delete" name="btSubmit" value="Delete">
</form> 
</fieldset>


     </div>
     <div id="search-section">
     <div id="search-section">
                <form class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes" selected>Programmes</option>
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
     </div>
    </main>
  </body>
</html>