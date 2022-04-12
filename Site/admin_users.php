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
    <title>Manage Users</title>
    <meta name="description" content="Personal Timetable" />
    <link rel="stylesheet" href="Style/Basic.css" />
    <link rel="stylesheet" href="Style/admin.css" />
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
      <h1 id="admin-title">Manage Users</h1>
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

     </div>
     <div id="search-section">
       <form class="admin-search">
         <select name="search-type" id="search-type">
           <option value="Users" selected>Users</option>
           <option value="Programmes">Programmes</option>
           <option value="Modules">Modules</option>
         </select>
         <select name="search-subset" id="search-subset">
           <option value="Name" selected>Name</option>
         </select>
         <input type="text" id="search-searchbar"onkeyup="searchBar()" value="Search" onclick='removeText()' tabindex='1'/>
       </form>
       <div id="search-list-opt-top">
       <input type="button" name="list-remove" id="list-remove" value="-">
       <input type="button" name="list-add" id="list-add" value="+"></div>
       <div id="search-output"></div>
       <div id="search-list-opt">
         <input type="button"value="Import List">
         <input type="button"value="Export list">
       </div>
     </div>
</div>
    </main>
    <script>
      function removeText(){
        document.getElementById("search-searchbar").value= "";
      }
      function searchBar(){
        var sType = document.getElementById("search-type");
        var sTypeTxt = sType.options[sType.selectedIndex].text;

        var sSub = document.getElementById("search-subset");
        var sSubTxt = sSub.options[sSub.selectedIndex].text;
        const sOutput = document.getElementById('search-output');
        

      }

    </script>
  </body>
</html>