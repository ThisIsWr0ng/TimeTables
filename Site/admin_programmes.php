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
    <title>Manage Programmes</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link rel="stylesheet" href="Style/admin.css" />
    <script src="script/searchBox.js"></script>
    <script src="script/sortTable.js"></script>
    <script src="script/searchBox.js"></script>
    <?php include 'php/fetch_data.php'?>
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
    <main class="admin-content">
      <h1 id="admin-title">Manage Programmes</h1>
      <nav id="admin-nav">
      <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
        <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
        <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
        <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
        <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
        <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
        <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
      </nav>
      <div id="content-block">
      <div id="form-section">
        <form>
          <fieldset>
            <legend>Details</legend>
        <label for="id">id:</label><br>
  <input type="text" id="id" name="id" value=""><br>
      <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" value="" disabled="true"><br> 

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
            <label>Start Date</label><br>
          <input id="form-prog-sdate" type="date" name="dob"><br><br>

          <label>End Date</label><br>
          <input id="form-prog-edate" type="date" name="dob"><br><br>

  <label for="desc">Description</label><br>
  <textarea id="form-prog-descc" name="desc" rows="4" cols="50">
  </textarea> <br></fieldset>
</form>
     </div>
     <div id="search-section">
       
     </div>
</div>
     </div>
    </main>
  </body>
</html>