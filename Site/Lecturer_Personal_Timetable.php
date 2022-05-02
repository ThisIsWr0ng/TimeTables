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
    <input type="button" id="logout" value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
    <input type="button" value="Timetable Finder" onclick="location.href='timetable_finder.php'"/>
    <main class="content">
    <section id="event-list" class="glass">
        <h3>Upcoming</h3><h3>events</h3><hr>
      </section>
      <div id="cal-wrap" class="glass">
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
      <section id="lecturer-forms" class="glass">
      <fieldset>
    <legend>Deadlines</legend>
    <section class="db-output-window" id="form-dead-output">No Deadlines Assigned</section>
    <div id="deadlines-fields">
     <select name="module" id="form-dead-module">
       <?php 
       $sql="SELECT DISTINCT Lecturers_Assignment.Module, Modules.Name FROM Lecturers_Assignment
       LEFT JOIN Modules ON Modules.Id = Lecturers_Assignment.Module 
       WHERE Lecturers_Assignment.Lecturer = '$username'";
       $result = $conn->query($sql);
       if($result->num_rows > 0){
         while ($row = $result->fetch_assoc()) {
           echo "<option value=\"{$row['Module']}\">{$row['Module']}: {$row['Name']}</option>";
         }
       }else{
         echo "<option value=\"NULL\">No modules assigned! please contact admin</option>";
       }
       ?>
     </select><br>
    <label for="name">Name:</label><br>
  <input type="text" id="form-mod-dead-name" name="name" value="" required><br>

  <label for="weight">Weight (%):</label><br>
  <input type="number" id="form-dead-weight" name="weight" min="0" max="100" step="5"><br>

  <label for="datetime">Date:</label><br>
  <input type="datetime-local" id="form-dead-date" name="datetime"><br>

  <label for="ml">Submission Link:</label><br>
  <input type="text" id="form-dead-moodle" name="ml" value=""><br>
  <input type="button" id="add-deadlines" value="Add"/> 
</div>

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
      <input type="submit" value="Submit">
    </form>
  </fieldset>
  </section>
      <script>
        var Module = null;
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

        function addLecturerDeadline(){
          const fModule = document.getElementById('form-dead-module');
          const fName = document.getElementById('form-dead-name');
          const fWeight = document.getElementById('form-dead-weight');
          const fDate = document.getElementById('form-dead-date');
          const fLink = document.getElementById('form-dead-moodle');
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function () {
            const mod = document.getElementById('form-dead-module');
            refreshDeadlines(mod.value);

          }
          xmlhttp.open("GET", `php/saveDeadlines.php?module=${fModule.value}&name=${fName.value}&weight=${fWeight.value}&date=${fDate.value}&moodle=${fLink.value}`);
          xmlhttp.send();
        }

        function refreshDeadlines(moduleName){
          
          xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function () {
            const output = document.getElementById('form-dead-output');
            output.innerHTML = this.responseText;
            var data = JSON.parse(this.responseText);
            if(data.length > 0){
              var text = "<table><tr><th>Name</th><th>Date</th><th>Weight</th><th>Submission Link</th></tr>";
              for (let i = 0; i < data.length; i++) {
                
                
              }

              output.innerHTML = text;
            }
          }
          xmlhttp.open("GET", `php/getDeadlines.php?module=${moduleName}`);
          xmlhttp.send();

        }
     
      </script>
    </main>
  </body>
</html>
