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
    <title>Import Data</title>
    <meta name="description" content="Import Data"/>
    <link rel="stylesheet" href="Style/Basic.css"/>
    <link rel="stylesheet" href="Style/admin.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
    </script>
</head>

<body>
    <header>
        <img id="logo" src="img/TimeTables-logos/TimeTables-logos_white_cropped.png" alt="TimeTables Logo"/>
    </header>
    <input type="button" id="logout" value="Logout" onclick="location.href='php/logout.php'"/>
    <?php echo "<h3 id='log'>Logged in: $username</h3>" ?>
    <main class="admin-content">
        <h1 id="admin-title">Import Data</h1>
        <nav id="admin-nav">
            <input type="button" value="Home" onclick="location.href='admin_portal.php'"/>
            <input type="button" value="Users" onclick="location.href='admin_users.php'"/>
            <input type="button" value="Programmes" onclick="location.href='admin_programmes.php'"/>
            <input type="button" value="Modules" onclick="location.href='admin_modules.php'"/>
            <input type="button" value="Events" onclick="location.href='admin_events.php'"/>
            <input type="button" value="Requests" onclick="location.href='admin_requests.php'"/>
            <input type="button" value="Import Data" onclick="location.href='admin_import.php'"/>
            <input type="button" value="View Calendar" onclick="location.href='admin_calendar.php'"/>
        </nav>
        <div id="content-block">
        
            <div id="search-section">
               
                <h1>Data View</h1>
                <form id="xmlForm" name="xmlForm"><input id="input" type="file"> <input type="submit"></form>
                <textarea class="db-output-window" id="search-output" rows="20" cols="40" style="border:none;"></textarea>
                <div id="search-list-opt">
                <input type="button" value="Cancel" onclick="cancel()">
                    <input type="button" value="Confirm">
                    
                </div>
            </div>
        </div>
        </div>
        <script>
            var readXml=null;
            var doc = null;
       $('#xmlForm').submit(function(event) {
           event.preventDefault();
           var selectedFile = document.getElementById('input').files[0];
           //console.log(selectedFile);
           var reader = new FileReader();
           reader.onload = function(e) {
               readXml=e.target.result;
               console.log(typeof readXml);
               document.getElementById('search-output').innerHTML = readXml;
               var parser = new DOMParser();
               doc = parser.parseFromString(readXml, "application/xml");
               
               //console.log(doc);
           }
           reader.readAsText(selectedFile);

       });
           function cancel(){
            document.getElementById('search-output').innerHTML = null;
           }
           doc = null;
           readXml=null;
        </script>
    </main>
</body>
</html>