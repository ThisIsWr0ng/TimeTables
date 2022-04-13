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
        <form>
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
          <select id="form-user-gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
          </select><br><br>

          <label>Next of Kin</label><br>
          <input type="text" id="form-user-nok"name="nextofkin"><br><br>

          <label>Private Email</label><br>
          <input type="text" id="form-user-prive"name="privateemail"><br><br>
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
            <input type="text" id="form-user-id" name="form-user-id" value="" disabled><br><br>

            <label>Role</label><br>
            <select id="form-user-role">
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
            <select id="form-user-programme">
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
            <select id="form-user-level">
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>

            <label>University Email</label><br>
            <input type="text" id="form-user-unie" name="uniemail">
            </fieldset>
          </section>
          <section>
            <input type="button" value="Add">
            <input type="button" value="Delete">
            <input type="button" value="Update">
            <input type="button" value="Reset Password">
            <input type="button" value="Default Settings">
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
      
   function removeText(){
    document.getElementById("search-searchbar").value= "";
  }
  function getData(data){
    if(data != ""){
    var sType = document.getElementById("search-type");
    var sTypeTxt = sType.options[sType.selectedIndex].text;
    var sOutput = document.getElementById('search-output');
    //console.log('sTypeTxt :>> ', sTypeTxt);
    //console.log('data :>> ', data);
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {sOutput.innerHTML = this.responseText; };
            
    
    xmlhttp.open("GET",`php/searchBox.php?q=${data}&type=${sTypeTxt}`);
    xmlhttp.send();
    return;
    }
  }
  function searchBar(data){
    var findResults = getData(data)
    var sOutput = document.getElementById('search-output');
  }
  function fetchForm(formId,formData){
    var formField = document.getElementById(formId);
    formField.value = formData;
    findUser(formData);//Fill other form fields with user info
  }
function feedUserForm(user){
  //Locate elements
  const uFname = document.getElementById('form-user-firstname');
  const uSurname = document.getElementById('form-user-surname');
  const uTitle = document.getElementById('form-user-title');
  const uGender = document.getElementById('form-user-gender');
  const uNok = document.getElementById('form-user-nok');
  const uPrivE = document.getElementById('form-user-prive');
  const uHnum = document.getElementById('form-user-hnum');
  const uStr = document.getElementById('form-user-str');
  const uPost = document.getElementById('form-user-post');
  const uId = document.getElementById('form-user-id');
  const uRole = document.getElementById('form-user-role');
  const uProg = document.getElementById('form-user-programme');
  const uLvl = document.getElementById('form-user-level');
  const uUniE = document.getElementById('form-user-unie');
  //assign values to form Fields
  uFname.value = user.First_Name;
  uSurname.value = user.Surname;
  uTitle.value = user.Title;
  uNok.value = user.Next_Of_Kin;
  uPrivE.value = user.Priv_Email;
  uHnum.value = user.Street_Number;
  uStr.value = user.Street_Name ;
  uPost.value = user.Postcode;
  uId.value = user.Id;
  uUniE.value = user.Uni_Email;
//assign values to dropdowns
  uGender.value = user.Gender;
  uRole.value = user.Role;
  uProg.value = user.Programme;
  uLvl.value = user.Level;
}
function findUser(id){
    if(id != ""){
    console.log('id :>> ', id);
    const users = JSON.parse('<?php echo json_encode(fetchUsers())?>');
    var user;
    for (let i = 0; i < users.length; i++) {
      if(users[i].Id == id){user = users[i];}
    }
    
    if(typeof user !== "undefined"){
      feedUserForm(user);
    }else{
    console.log('User Not Found! :>> ');
    console.log('users :>> ', users);
    console.log('user :>> ', user);
    }
  }}

    </script>
  </body>
</html>