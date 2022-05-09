<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Timetable Finder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Timetable Finder" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <script src="script/sortTable.js"></script>
  </head>
  <body>
    <header>
    <nav id="searchbar">
        
          <select
            id="search_type"
            name="search_type"
            onchange="showHint('');"
          >
            <option value="Programmes" selected>Programmes</option>
            <option value="Modules">Modules</option>
            <option value="Rooms">Rooms</option>
            
          </select>
          <input id="search_input" type="text" onkeyup="showHint(this.value)" />
        
      </nav>
      <img
        id="logo"
        src="img/TimeTables-logos/TimeTables-logos_white_cropped.png"
        alt="TimeTables Logo"
      />
    </header>
    
    <main class="content" >
    
      <div id="results"class="glass"></div>
      <script>
        function showHint(data) {
          if(data.length <= 0){
            data = "allfields"
          }
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function () {document.getElementById("results").innerHTML = this.responseText; };
            
            var selOption = document.getElementById("search_type").value;
            xmlhttp.open("GET",`php/search_timetables.php?q=${data}&type=${selOption}`);
            xmlhttp.send();
          
        }

        showHint(" ");

        
      </script>
    </main>
  </body>
</html>
