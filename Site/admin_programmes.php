<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Manage Programmes</title>
    <meta name="description" content="Personal Timetable"/>
    <link rel="stylesheet" href="Style/Basic.css"/>
    <link rel="stylesheet" href="Style/admin.css"/>
    <script src="script/sortTable.js"></script>
    <script src="script/searchBox.js"></script>
    <?php include 'php/fetch_data.php'?>
</head>

<body>
    <header>
        <img id="logo"src="img/TimeTables-logos/TimeTables-logos_white_cropped.png" alt="TimeTables Logo"/>
    </header>
    <input type="button" class="glass" id="logout" value="<?php echo $username?> | Logout" onclick="location.href='php/logout.php'"/>
    <main class="admin-content" class="glass">
        <h1 id="admin-title" class="glass">Manage Programmes</h1>
        <nav id="admin-nav" class="glass">
            <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
            <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
            <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
            <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
            <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
            <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
            <input type="button" value="Import Data" onclick="location.href='admin_import.php'"/>
            <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
        </nav>
        <div id="content-block" class="glass"> 
            <div id="form-section">
                <h1>Programmes</h1>
                <section>
                <form id="programmes-form"action="php/programme.php" method="POST">
                    <fieldset>
                        <legend>Details</legend>
                        
                        <input type="hidden" id="form-prog-id" name="id" value=""><br>
                        <label for="name">Name:</label><br>
                        <input type="text" id="form-prog-name" name="name" value="" ><br>

                        <label for="degree">Degree:</label><br>
                        <select id="form-prog-deg" name="degree">
                            <option value="BA (Hons)">BA (Hons)</option>
                            <option value="BA">BA</option>
                            <option value="BEng (Hons)">BEng (Hons)</option>
                            <option value="BSc (Hons)">BSc (Hons)</option>
                            <option value="BSc (Ord)">BSc (Ord)</option>
                            <option value="BSc">BSc</option>
                            <option value="CertEd">CertEd</option>
                            <option value="DipHE">DipHE</option>
                            <option value="FdA">FdA</option>
                            <option value="FdEng">FdEng</option>
                            <option value="FdSc">FdSc</option>
                            <option value="MA">MA</option>
                            <option value="MBA">MBA</option>
                            <option value="MDes">MDes</option>
                            <option value="MRes">MRes</option>
                            <option value="MSc">MSc</option>
                            <option value="PGCE">PGCE</option>
                        </select>

                        <label for="department">Department:</label><br>
                        <select id="form-prog-dept" name="department">
                            <?php
require_once "php/conn.php";

$sql = "SELECT * FROM Departments";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Name'];
    echo "<option value='$name'>$name</option>";
}
?>
                        </select>

                        <label>Level</label><br>
                        <select id="form-prog-level" name="level">
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <label>Type</label><br>
                        <select id="form-prog-type" name="type">
                            <option value="Full Time">Full Time</option>
                            <option value="Part Time">Part Time</option>
                        </select>
                        <fieldset>
                        <label for="year">Academic Year:</label><br>
                        <select id="form-prog-year" name="year">
                            <?php
require_once "php/conn.php";

$sql = "SELECT DISTINCT year FROM semesters";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $year = $row['year'];
    echo "<option value='$year'>$year</option>";
}
?>
                        </select>
                        <input type="button" value="set dates" onclick="setProgrammeDates()">
                        </fieldset>
                        <label>Start Date</label><br>
                        <input id="form-prog-sdate" type="date" name="start"><br><br>

                        <label>End Date</label><br>
                        <input id="form-prog-edate" type="date" name="end"><br><br>

                        <label for="desc">Description</label><br>
                        <textarea id="form-prog-desc" name="desc" rows="4" cols="50">
  </textarea> <br>
  <section class="form-buttons">
            <input type="submit" name="btSubmit" value="Add">
            <input type="submit" name="btSubmit" value="Delete">
            <input type="submit" name="btSubmit" value="Update">
            <input type="submit" name="btSubmit" value="View_Students">
          </section>
                    </fieldset>
                </form>
                        </section>
                <form action="">
                    <fieldset id="modules-fieldset">
                        <legend>Modules</legend>
                        <select id="form-prog-sem" name="semester" onchange="refreshModules(this.value)">
                        <?php
require_once "php/conn.php";

$sql = "SELECT * FROM semesters";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $year = $row['Year'];
    $name =$row['Name'];
    echo "<option value='$name $year'>$name $year</option>";
}
?>
                        </select>
                        <section class="db-output-window" id="form-prog-mod-output"></section>
  <section class="form-buttons">
                        <section >
                            <input type="button" value="Save" onclick="SaveProgramModules()">
        </section>
                    </fieldset>
                </form>
            </div>
            <div id="search-section">
            <h1>SearchBox</h1>
                <section  class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes" selected>Programmes</option>
                        <option value="Modules">Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </section >
                
                <div class="db-output-window" id="search-output">Select search type and use search bar to display results</div>
                <div id="search-list-opt">
                   
                    <input type="button" value="Export list" onclick="exportXML()">
                </div>
            </div>
        </div>
        </div>
        <script>
            let sem1 = null;
            let sem2 = null;
            let Modules = null;
        function findProgramme(id){
            if (id!= "") {
                var programmes = JSON.parse('<?php echo json_encode(fetchProgrammes()) ?>');
                var prog = null;
                for (let i = 0; i < programmes.length; i++) {
                if(programmes[i].Id == id){prog = programmes[i];}
                else{programmes[i] = null;}
                }
                if(typeof prog !== "undefined"){
      feedProgForm(prog);
      programmes = null;
      prog = null;
    }}}
function getModulesForProg(id){
    sem1 =[];
    sem2 =[];
    const pId = document.getElementById('form-prog-id');
    const pSem = document.getElementById('form-prog-sem');
    const output = document.getElementById('form-prog-mod-output');
    var id = pId.value;
    modules = [];//Modules are stored here!!
    if (id != "") {
        var dbData = JSON.parse('<?php echo json_encode(fetchModulesToProgrammes()) ?>');//fetch table of modules
        for (let i = 0; i < dbData.length; i++) {
            if(dbData[i].Programme == id){modules.push(dbData[i]);}//keep modules for selected programme
            dbData[i] = null; //remove rest, not needed
        }
       
        for (let i = 0; i < modules.length; i++) {
            
            if(modules[i].Semester == "Semester 1"){
                sem1.push(modules[i]);
            }else{sem2.push(modules[i]);}
        }
      
        refreshModules(pSem.value);
    }else{
        output.innerHTML="Select programme first, or add it to database"
    }
}

function removeModulesRow(id, sem, year){
for (let i = 0; i < modules.length; i++) {//remove from array
    if(modules[i].Id == id && modules[i].Semester == sem && modules[i].Year == year){
      modules[i] = null;
      break;
    }
}
for (let i = 0; i < modules.length; i++) {//re-arrange array
    if(i == modules.length-1){
    break;
    }
    if(modules[i] == null){
        modules[i] = modules[i+1]
    }
}
modules.length = modules.length-1;//cut last part
refreshModules(`${sem} ${year}`);
}
function addToModulesList(id){
  var dbData = JSON.parse('<?php echo json_encode(fetchModules()) ?>');//fetch table of modules
  var modul = null;
  for (let i = 0; i < dbData.length; i++) {
      if(dbData[i].Id == id){
          modul = dbData[i];
          break;
      }

  }
  const pSem = document.getElementById('form-prog-sem').value;
  year = pSem.substring(11, 17).trim();
  sem = pSem.substring(0, 10).trim();
  prog = document.getElementById('form-prog-id').value;
  modul.Semester = sem;
  modul.Year = year;
  modul.Programme = prog;
  modules.push(modul);
  refreshModules(pSem);
}

function setProgrammeDates(){
    var year = document.getElementById('form-prog-year');
    xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function () {
             // document.getElementById('search-output').innerHTML = this.responseText;
            var dates = JSON.parse(this.responseText);
            const sDate = document.getElementById('form-prog-sdate');
            const eDate = document.getElementById('form-prog-edate');
            sDate.value = dates[0];
            eDate.value = dates[1];
          }
          xmlhttp.open("GET", `php/setDates.php?year=${year.value}`);
          xmlhttp.send();
}


window.onload = searchBar(' ');
        </script>
    </main>
</body>
</html>