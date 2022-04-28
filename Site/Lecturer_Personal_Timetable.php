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
    <title>Personal Timetable</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link href="style/calendar.css" rel="stylesheet" type="text/css" />
    <script src="script/calendar.js"></script>
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
    <input type="button" value="Timetable Finder" onclick="location.href='timetable_finder.php'"/>
    <main class="content">
      <div id="cal-wrap">
        <!-- (A) PERIOD SELECTOR -->
        <div id="cal-date">
          <select id="cal-mth"></select>
          <select id="cal-yr"></select>
        </div>

        <!-- (B) CALENDAR -->
        <div id="cal-container"></div>

        <!-- (C) EVENT FORM -->
        <div id="overlay" class="hideOverlay">
          <form id="cal-event" action="php/eventRequest.php" method="post">
            <div id="evt-head"></div>
            <input type="date" id="evt-date" name="date" />
            <input type="hidden" name="user" value="<?php echo $username?>">
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
                required
              />
              <label for="tTo">Time To:</label>
              <input
                type="time"
                id="tTo"
                name="timeTo"
                required
              /><br />

              <label for="evt-details">Event description:</label>
            </div>

            <textarea id="evt-details" name="details" readonly></textarea>
            <input id="evt-close" type="button" value="Close" />
            <input id="evt-request" type="button" value="Add Event" />
            <input id="evt-moodle-page" type="button" value="Moodle Page" />
            <input id="evt-next" type="button" value="Next -->" />
          </form>
        </div>
      </div>
      <section id="lecturer-forms">
      <fieldset>
    <legend>Deadlines</legend>
    <section class="db-output-window" id="form-mod-dead-output">No Deadlines Assigned</section>
    <div id="deadlines-fields">
    <label for="name">Name:</label><br>
  <input type="text" id="form-mod-dead-name" name="name" value="" required><br>

  <label for="weight">Weight (%):</label>
  <input type="number" id="form-mod-dead-weight" name="weight" min="0" max="100" step="5">

  <label for="datetime">Date:</label>
  <input type="datetime-local" id="form-mod-dead-date" name="datetime">

  <label for="ml">Moodle Link:</label><br>
  <input type="text" id="form-mod-dead-moodle" name="ml" value=""><br>
    
</div>
<input type="button" id="add-deadlines" value="Add"/> 
  </fieldset>
  <fieldset>
    <legend>Request</legend>
    <form action="">
      <select name="req-type" id="req-type">
        <option value="Room">Room Change</option>
        <option value="Time">Time Change</option>
        <option value="Day">Day Change</option>
        <option value="Group">Create Student Groups</option>
        <option value="Module">Module</option>
        <option value="Generic">Other</option>
      </select>
      <input type="hidden" name="user" value="<?php echo $username?>">
      <textarea name="description" id="req-desc" cols="80" rows="10"></textarea>
      <input type="submit">
    </form>
  </fieldset>
  </section>
      <script>
        var dbData = null;
        xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
   //document.getElementById("evt-details").innerHTML = this.responseText;//<<<<For debugging
    dbData = JSON.parse(this.responseText);
    console.log("Data Received:", dbData);
    window.addEventListener("load", drawCalendar(dbData));
  }
  xmlhttp.open("GET", 'php/fetchCalendarData.php?user=<?php echo $username ?>');
  xmlhttp.send();
        
      </script>
    </main>
  </body>
</html>