
<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

$username = $_SESSION["username"];
?>
  <head>
    <meta charset="utf-8" />
    <title id="page-title">Timetable</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Timetable" />
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
    <main class="content">
    <section id="event-list" class="glass">
        <h3>Upcoming</h3><h3>events</h3><hr>
      </section>
        
      <div id="cal-wrap" class="glass">
      <h2 id="demo">Demo</h2>
        <!-- (A) PERIOD SELECTOR -->
        <div id="cal-date">
          <select id="cal-mth"></select>
          <select id="cal-yr"></select>
        </div>

        <!-- (B) CALENDAR -->
        <div id="cal-container"></div>
      </div>
<!-- (C) EVENT FORM -->
<div id="overlay" class="hideOverlay">
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
        </div>
      <script>
        let dbData = null;
         xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function () {
          //document.getElementById('cal-container').innerHTML = this.responseText;
          dbData = JSON.parse(this.responseText);
          document.getElementById("demo").innerHTML = `Events for <?php echo $_REQUEST['name']; ?>`;
            console.log("Data Received:", dbData);
            window.addEventListener("load", drawCalendar(dbData));

          }
          xmlhttp.open("GET", `php/getTimetables.php?id=<?php echo $_REQUEST['id']?>&type=<?php echo $_REQUEST['type']?>`);
          xmlhttp.send();
           

          
            
      </script>
    </main>
  </body>
</html>
