<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Timetable Finder</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
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

        function sortTable(n) {//Code from: https://www.w3schools.com/howto/howto_js_sort_table.asp
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("resultstable");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc";
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
      </script>
    </main>
  </body>
</html>
