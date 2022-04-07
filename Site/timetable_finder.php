
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Timetable Finder</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <?php  include 'php/conn.php'; ?>
    <?php  include 'php/fetch_data.php'; ?>
    <script src="script/timetable_finder.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
 
        <nav>
            <form>
            <select id="search_type" name="search_type" onchange="showHint('all')">
                <option value="Programme" selected>Programme</option>
                <option value="Module">Module</option>
                <option value="Room">Room</option>
                <option value="Degree">Degree</option>
                <option value="Year">Year</option>
                <option value="Type">Type</option>
                <option value="Name">Name</option>
            </select>
            <input id="search_input" type="text" onkeyup="showHint(this.value)"/> 
            </form>
        </nav>
        <div id="results">

        </div>
        <script>
            
//------------------------------------------------
function showHint(str) {
  if (str.length == 0) {
    document.getElementById("results").innerHTML = "";
    return;
  } else {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      document.getElementById("results").innerHTML = this.responseText;
    }
    var selOption = document.getElementById("search_type").options[document.getElementById("search_type").selectedIndex].text;
  xmlhttp.open("GET", `php/search_timetables.php?q=${str}&type=${selOption}`);
  xmlhttp.send();
  }

}
function displayResults(array){
  console.log(array);
}
showHint('all');
  //---------------------------------------
        //var dbData = JSON.parse( '<?php //echo json_encode(fetchProgrammes()) ?>' );
        //console.log("Received dbData:", dbData);
        //findResults(dbData);
        </script>
    </main>
  </body>
</html>