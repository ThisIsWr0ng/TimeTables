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
        
            <div id="form-section">
            <h1>Import</h1>
                <input type="button" value="Users">
                <input type="button" value="Programmes and Modules">
                <input type="button" value="Events">


                
            </div>
            <div id="search-section">
               
                <h1>Data View</h1>
                <div class="db-output-window" id="search-output">Please select a file to display data</div>
                <div id="search-list-opt">
                <input type="button" value="Cancel">
                    <input type="button" value="Confirm">
                    
                </div>
            </div>
        </div>
        </div>
        <script>
           
        </script>
    </main>
</body>
</html>