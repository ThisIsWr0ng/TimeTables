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
    <title>Manage Modules</title>
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
      <h1 id="admin-title">Manage Modules</h1>
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
        <h1>Modules</h1>
        <form action="">
          <fieldset>
            <legend>Module Details</legend>
  <label for="id">Id:</label><br>
  <input type="text" id="form-mod-id" name="id" value=""><br>
  
  <label for="name">Name:</label><br>
  <input type="text" id="form-mod-name" name="name" value=""><br>

  <label for="ml">Moodle Link:</label><br>
  <input type="text" id="form-mod-moodle" name="ml" value=""><br>
  
  <label for="desc">Description</label><br>
  <textarea id="form-mod-desc" name="desc" rows="4" cols="30">
  </textarea> <br>
  
  

<input type="button" value="Save" onclick=""/> 
</fieldset>
</form> 
<form action="">
  <fieldset>
    <legend>Lecturers</legend>
    <section class="db-output-window" id="form-mod-lect-output"></section>
    <input type="button" value="Save" onclick="">

  </fieldset>
</form>
 
<form action="">
  <fieldset>
    <legend>Deadlines</legend>
    <section class="db-output-window" id="form-mod-dead-output"></section>
    <input type="button" onclick="" value="Add"/> 
<input type="button" onclick="" value="Save"/>
  </fieldset>
</form>
<form action="">
  <fieldset>
    <legend>Student Groups</legend>
    <select name="groupsel" id="form-group-sel"><option value="1">Group 1</option><option value="2">Group 2</option></select>
    <section class="db-output-window" id="form-mod-studgroup-output"></section>
    <input type="button" value="Save" onclick="">

  </fieldset>
</form>

     </div>
     <div id="search-section">
     <div id="search-section">
                <form class="admin-search">
                    <select name="search-type" id="search-type">
                        <option value="Users" >Users</option>
                        <option value="Programmes" >Programmes</option>
                        <option value="Modules"selected>Modules</option>
                        <option value="Events">Events</option>
                    </select>
                    <input type="text" id="search-searchbar" onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
                </form>
                <div id="search-list-opt-top">
                    <input type="button" name="list-remove" id="list-remove" value="-">
                    <input type="button" name="list-add" id="list-add" value="+" onclick="">
                </div>
                <div class="db-output-window" id="search-output"></div>
                <div id="search-list-opt">
                    <input type="button" value="Import List">
                    <input type="button" value="Export list">
                </div>
            </div>
     </div>
</div>
     </div>
     <script>
       let Deadlines = null;//Storage for deadlines
       let Lecturers = null;//Storage for lecturers
       let Groups = null;//Storage for student groups
       function findModule(id){
            if (id!= "") {
                var modules = JSON.parse('<?php echo json_encode(fetchModules()) ?>');
                var modul = null;
                for (let i = 0; i < modules.length; i++) {
                if(modules[i].Id == id){modul = modules[i];}
                else{modules[i] = null;}
                }
                if(typeof modul !== "undefined"){
      feedModForm(modul);
      modules = null;
      modul = null;
    }}}
    function feedModForm(mod){
    const mId = document.getElementById('form-mod-id');
    const mName = document.getElementById('form-mod-name');
    const mMoodle = document.getElementById('form-mod-moodle');
    const mDesc = document.getElementById('form-mod-desc');
    mId.value = mod.Id;
    mName.value = mod.Name;
    mMoodle.value = mod.Moodle_Link;
    mDesc.value = mod.Description;
    

    }


     </script>
    </main>
  </body>
</html>