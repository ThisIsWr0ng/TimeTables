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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Timetable</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link href="Style/calendar.css" rel="stylesheet" type="text/css" />
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
    <nav class="navbuttons">
      <input class="glass" type="button" value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
      <input class="glass" type="button" value="Timetable Finder" onclick="location.href='timetable_finder.php'"/>
      <input class="glass" type="button" value="Academic Calendar" onclick="location.href='Academic-Calendar-2021-22.pdf'" target="_blank">
    </nav>
    <main class="content">
    <section id="event-list" class="glass">
        <h3>Upcoming</h3><h3>events</h3><hr>
      </section>
      <section id="cal-wrap"class="glass">
        <!-- (A) PERIOD SELECTOR -->
        <div id="cal-date">
          <select id="cal-mth"></select>
          <select id="cal-yr"></select>
        </div>

        <!-- (B) CALENDAR -->
        <div id="cal-container"></div>
        </section>
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
        

     
      <script>
       var dbData = null;
        xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
   //document.getElementById("cal-wrap").innerHTML = this.responseText;//<<<<For debugging
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
