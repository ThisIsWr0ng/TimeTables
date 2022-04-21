
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title id="page-title">Timetable</title>
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
    <main class="content">

        <h2 id="demo">Demo</h2>
      <div id="cal-wrap">
        <!-- (A) PERIOD SELECTOR -->
        <div id="cal-date">
          <select id="cal-mth"></select>
          <select id="cal-yr"></select>
        </div>

        <!-- (B) CALENDAR -->
        <div id="cal-container"></div>

        <!-- (C) EVENT FORM -->
        <div id="overlay">
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
      </div>

      <script>
console.log( "headers:",<?php echo json_encode($_REQUEST['type']); ?>, <?php echo json_encode($_REQUEST['id']); ?>);

        
            var dbData = JSON.parse( '<?php echo json_encode(fetchProgrammeEvents($_REQUEST['id']))?>' );//Request data
            var name = "";
            if(<?php echo json_encode($_REQUEST['type']); ?> == "Programme"){//timetable header
                name = dbData[0].programme_name;
            }
            else if(<?php echo json_encode($_REQUEST['type']); ?> == "Module"){
                name = dbData[0].module_name;
            }
            document.getElementById("demo").innerHTML = `<?php echo json_encode($_REQUEST['type']); ?>: ${name}`;
            console.log("Data Received:", dbData);
            window.addEventListener("load", drawCalendar(dbData));
      </script>
    </main>
  </body>
</html>
