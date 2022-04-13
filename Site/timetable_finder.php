<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Timetable Finder</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <script src="script/sortTable.js"></script>
  </head>
  <body>
    <header>
    <nav id="searchbar">
        <form onsubmit="showHint(this.value)">
          <select
            id="search_type"
            name="search_type"
            onchange="showHint('');"
          >
            <option value="Programme" selected>Programme</option>
            <option value="Module">Module</option>
            <option value="Room">Room</option>
            <option value="Degree">Degree</option>
            <option value="Year">Year</option>
            <option value="Type">Type</option>
            <option value="Name">Name</option>
          </select>
          <input id="search_input" type="text" onkeyup="showHint(this.value)" />
        </form>
      </nav>
      <img
        id="logo"
        src="img/TimeTables-logos/TimeTables-logos_white_cropped.png"
        alt="TimeTables Logo"
      />
    </header>
    
    <main class="content">
    
      <div id="results"></div>
      <script>
        function showHint(data) {
          if(data.length <= 0){
            data = "allfields"
          }
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {document.getElementById("results").innerHTML = this.responseText; };
            
            var selOption = document.getElementById("search_type").options[document.getElementById("search_type").selectedIndex].text;
            xmlhttp.open("GET",`php/search_timetables.php?q=${data}&type=${selOption}`);
            xmlhttp.send();
          
        }
        function displayResults(array) {
          console.log(array);
        }
        showHint(" ");

        
      </script>
    </main>
  </body>
</html>
