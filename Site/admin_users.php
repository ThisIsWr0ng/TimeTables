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
    <meta charset="utf-8" />
    <title>Manage Users</title>
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
      <section>
        <form id="users-form"action="php/addUser.php" method="POST">
          <h1>Users</h1>
          <section>
            <fieldset>
            <legend>Personal Info</legend>
          <label>Firstname</label><br>
          <input type="text" id="form-user-firstname" name="firstname"><br><br>

          <label>Surname</label><br>
          <input type="text" id="form-user-surname"name="surname"><br><br>

          <label>Title</label><br>
          <input type="text" id="form-user-title"name="title"><br><br>

          <label>Gender</label><br>
          <select id="form-user-gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select><br><br>

          <label>Date of Birth</label><br>
          <input id="form-user-dob" type="date" name="dob"><br><br>

          <label>Next of Kin</label><br>
          <input type="text" id="form-user-nok"name="nextofkin"><br><br>

          <label>Private Email</label><br>
          <input type="text" id="form-user-prive"name="privateemail"><br><br>

          <label>Telephone</label><br>
          <input id="form-user-tel" type="tel" name="tel"><br><br>
</fieldset>
          </section>
          <section>
          <fieldset>

          <legend>Address</legend>
          <label>House Number</label><br>
          <input type="text"id="form-user-hnum" name="housenumber"><br><br>

          <label>Street</label><br>
          <input type="text" id="form-user-str"name="street"><br><br>

          <label>Postcode</label><br>
          <input type="text" id="form-user-post"name="postcode"><br><br>
          </fieldset>
</section>
          <section>
            <fieldset>
              <legend>University Info</legend>
            <label>User ID</label><br>
            <input type="text" id="form-user-id" name="userid" value="" disabled><br><br>

            <label>Role</label><br>
            <select id="form-user-role" name="role">
              <?php
require_once "php/conn.php";

$sql = "SELECT * FROM roles";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Name'];
    echo "<option value='$name'>$name</option>";
}
?>
            </select>

            <label>Programme</label><br>
            <select id="form-user-programme" name="programme">
            <?php
require_once "php/conn.php";

$sql = "SELECT * FROM programmes";
$result = $conn->query($sql);
while ($row = mysqli_fetch_array($result)) {
    $name = $row['Name'];
    echo "<option value='$name'>$name</option>";
}
?>
            </select>

            <label>Level</label><br>
            <select id="form-user-level" name="level">
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>

            <label>University Email</label><br>
            <input type="text" id="form-user-unie" name="uniemail">
            </fieldset>
          </section>
          <section>
            <input type="submit" name="btSubmit" value="Add">
            <input type="submit" name="btSubmit" value="Delete">
            <input type="submit" name="btSubmit" value="Update">
            <input type="submit" name="btSubmit" value="Reset Password">
            <input type="submit" name="btSubmit" value="Default Settings">
          </section>
        </form>
      </section>
     </div>
     <div id="search-section">
       <form class="admin-search">
         <select name="search-type" id="search-type">
           <option value="Users" selected>Users</option>
           <option value="Programmes">Programmes</option>
           <option value="Modules">Modules</option>
           <option value="Events">Events</option>
         </select>
         <input type="text" id="search-searchbar"onkeyup="searchBar(this.value)" value="Search" onclick='removeText()' tabindex='1'/>
       </form>
       <div id="search-list-opt-top">
       <input type="button" name="list-remove" id="list-remove" value="-">
       <input type="button" name="list-add" id="list-add" value="+" onclick=""></div>
       <div id="search-output"></div>
       <div id="search-list-opt">
         <input type="button"value="Import List">
         <input type="button"value="Export list">
       </div>
     </div>
</div>
    </main>
    <script>
function formLocation(loc){
  const form = document.getElementById('users-form'); 
      form.setAttribute("action", "${loc}")
    

}
      
function findUser(id){
    if(id != ""){
    console.log('id :>> ', id);
    var users = JSON.parse('<?php echo json_encode(fetchUsers())?>');
    var user = null;
    for (let i = 0; i < users.length; i++) {
      if(users[i].Id == id){user = users[i];}
      else{users[i] = null;}
    }
    if(typeof user !== "undefined"){
      feedUserForm(user);
      users = null;
      user = null;
    }else{
    console.log('User Not Found! :>> ');
    console.log('users :>> ', users);
    console.log('user :>> ', user);
    }
  }}

    </script>
  </body>

</html>