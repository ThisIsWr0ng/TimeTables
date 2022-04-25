function removeText(){//Remove text from field when clicked
    document.getElementById("search-searchbar").value= "";
  }
  function fetchForm(type, formId,formData){
    var formField = document.getElementById(formId);
    
    
    if (window.location.href.search("admin_users.php") != -1) {
      formField.value = formData;
        findUser(formData);//Fill other form fields with user info
    } else if (window.location.href.search("admin_programmes.php") != -1){
        
      if(type == "Programmes"){
        formField.value = formData;
        findProgramme(formData);
      }else if(type== "Modules"){addToModulesList(formData)}
    }else if(window.location.href.search("admin_modules.php") != -1){
      if(type == "Modules"){
        formField.value = formData;
        findModule(formData)
      }else if(type == "Users"){
        if(formData.length > 12){//add to lecturers
          addToModulesTables("Lecturer", formData);
        }else{//add to student groups
          addToModulesTables("Student", formData);
        }
      }
    }else if(window.location.href.search("admin_events.php") != -1){
      if(type == "Modules"){
        document.getElementById('ev-radio-session').checked = true;
        displayEventFields("Session");
        document.getElementById('form-evt-id').value = formData;
      }else if(type == "Events"){
        findEventByType(formData, "Event");
      }else if(type == "Users"){
        document.getElementById('ev-radio-user').checked = true;
        displayEventFields("User Event");
        document.getElementById('form-evt-id').value = formData;
        findEventByType(formData, "User");
      }

    }else if(window.location.href.search("admin_calendar.php") != -1){
      if(type == "Modules"){
        displayCalendarFor("Module", formData);
      }else if(type == "Users"){
        displayCalendarFor("User", formData);
      }else if(type == "Programmes"){
        displayCalendarFor("Programme", formData);
      }

    }else if(window.location.href.search("admin_requests.php") != -1){
      if (type == "Requests"){
        fillRequestForms(formData);
      }
    }

  }
  function searchBar(data){//Get search Type and ask for output
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
    const uDob = document.getElementById('form-user-dob');
    const uTel = document.getElementById('form-user-tel');
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
    uDob.value = user.Birth_Date;
    uTel.value = user.Telephone;
  //assign values to dropdowns  
  uGender.value = user.Gender;
    
    uRole.value = user.Role;
    uProg.value = user.Programme;
    uLvl.value = user.Level;
    console.log('selected programme :>> ', uProg.value);
  }
  function feedProgForm(prog){
    //Locate elements
    const pId = document.getElementById('form-prog-id');
    const pName = document.getElementById('form-prog-name');
    const pDeg = document.getElementById('form-prog-deg');
    const pDept = document.getElementById('form-prog-dept');
    const pLvl = document.getElementById('form-prog-level');
    const pYear = document.getElementById('form-prog-year');
    const pSdate = document.getElementById('form-prog-sdate');
    const pEdate = document.getElementById('form-prog-edate');
    const pDesc = document.getElementById('form-prog-desc');
     //assign values to form Fields
     pId.value = prog.Id;
     pName.value = prog.Name;
     pDesc.value = prog.Description;
     pSdate.value = prog.Start_Date;
     pEdate.value = prog.End_Date;
     //assign values to dropdowns  
     pDeg.value = prog.Degree;
     pDept.val = prog.Department;
     pLvl.val = prog.Level;
     pYear.val = null;
     //Feed modules for selected Programme
     getModulesForProg(prog.Id);
  }
  function refreshModules(sem){
    const pSem = document.getElementById('form-prog-sem');
    const output = document.getElementById('form-prog-mod-output');
    year = sem.substring(11, 17).trim();
    sem = sem.substring(0, 10).trim();
    outputText = "<table class=\"resultstable\"><tr><th>Id</th><th>Name</th></tr>";
    for (let i = 0; i < modules.length; i++) {
       if(modules[i].Semester == sem && modules[i].Year == year){
           outputText += `<tr onclick="removeModulesRow('${modules[i].Id}', '${sem}','${year}')"><td>${modules[i].Id}</td><td>${modules[i].Name}</td></tr>`;
       }
        
    }
    outputText += "</table>"
    output.innerHTML =  outputText;
}

function SaveProgramModules(){
  const xmlhttp = new XMLHttpRequest();
          xmlhttp.onload = function () {document.getElementById("form-prog-mod-output").innerHTML = this.responseText; };
          xmlhttp.open("GET",`php/updateProgramModules.php?q=${JSON.stringify(modules)}`);
          xmlhttp.send();
         
}
function getModuleLecturer(modul){
  const mLect = document.getElementById('form-mod-lect-output');
  if(typeof modul == 'string'){
    outputText = modul;
  }else{
    outputText = "<table class=\"resultstable\"><tr><th>Id</th><th>Name</th></tr>";
  for (let i = 0; i < modul.length; i++) {
       outputText += `<tr onclick="removeFromResultsTable('Lecturers', ${i})"><td>${modul[i].Id}</td><td>${modul[i].First_Name} ${modul[i].Surname}</td></tr>`;
  
}
outputText += "</table>"}
mLect.innerHTML =  outputText;
}
function getModuleDeadlines(modul){
  const mDead = document.getElementById('form-mod-dead-output');
  if(typeof modul == 'string'){outputText = modul;}else{
  outputText = "<table class=\"resultstable\"><tr><th>Name</th><th>Date</th><th>Weight</th></tr>";
  for (let i = 0; i < modul.length; i++) {
       outputText += `<tr onclick="removeFromResultsTable('Deadlines', ${i})"><td>${modul[i].Name}</td><td>${modul[i].Date}</td><td>${modul[i].Weight}</td></tr>`; 
}
outputText += "</table>"}
mDead.innerHTML =  outputText;
}
function getModuleGroups(modul){
  const mGroup = document.getElementById('form-mod-studgroup-output');
  const mSelect = document.getElementById('form-group-sel');
  
  if(typeof modul == 'string'){outputText = modul;}else{
  outputText = "<table class=\"resultstable\"><tr><th>Id</th><th>Name</th></tr>";
  for (let i = 0; i < modul.length; i++) {
   if(mSelect.value == modul[i].Group){
       outputText += `<tr onclick="removeFromResultsTable('Groups', ${i})"><td>${modul[i].Id}</td><td>${modul[i].First_Name} ${modul[i].Surname}</td></tr>`;
   }
    
}
outputText += "</table>"}
mGroup.innerHTML =  outputText;
}
function removeFromResultsTable(type, id){//remove rows from output tables in modules subpage

  //delete rows
  if(type == "Lecturers"){
    dbData[1].splice(id, 1);
    if(dbData[1].length == 0){dbData[1] = "No Lecturers Assigned";}
  }else if(type == "Deadlines"){
    dbData[2].splice(id, 1);
    if(dbData[2].length == 0){dbData[2] = "No Deadlines Assigned";}
  }else if(type == "Groups"){
    dbData[3].splice(id, 1);
    if(dbData[3].length == 0){dbData[3] = "No Groups Assigned";}
  }
  //refresh all results
  refreshModulesResultTables()
}
function saveFormModules(){
  const mId = document.getElementById('form-mod-id');
  const mName = document.getElementById('form-mod-name');
  const mDesc = document.getElementById('form-mod-desc');
  const mLink = document.getElementById('form-mod-moodle');
  if(dbData.length > 1){
  dbData[0].Id = mId.value;
  dbData[0].Name = mName.value;
  dbData[0].Description = mDesc.value;
  dbData[0].Moodle_Link = mLink.value;
  }else{//if it's a new module
    var modul = {
      Id:mId.value,
      Name:mName.value,
      Description:mDesc.value,
      Moodle_Link:mLink.value
    };
    dbData[0] = modul;
    dbData[1] = "string";
    dbData[2] = "string";
    dbData[3] = "string";
  }
  console.log('dbData :>> ', dbData);
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
    //document.getElementById("search-output").innerHTML = this.responseText;//<<<<For debugging
    window.alert(this.responseText);
  };
  xmlhttp.open("GET", `php/saveFormModules.php?q=${JSON.stringify(dbData)}`);
  xmlhttp.send();
}
function hide(el, hide){
  if(hide == 1){
    document.getElementById(el).classList.add('hidden');
  }else{
    document.getElementById(el).classList.remove('hidden');
  }
}
function findModule(id){
  if (id!= "") {
    const xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function () {
      dbData = JSON.parse(this.responseText);
      feedModForm(dbData[0]);
      refreshModulesResultTables()
     };
    xmlhttp.open("GET",`php/getAllModuleInfo.php?q=${id}`);
    xmlhttp.send();
     }}
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
function addToModulesTables(type, userId){//add students or lecturers to tables on modules page
var user = null;
if (userId!= "") {//Get user info
    const xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onload = function () {
      user = JSON.parse(this.responseText);
      if(type== "Lecturer"){
        if(typeof dbData[1] == "string"){dbData[1] = []}
dbData[1].push(user);
}else if(type == "Student"){//add student to selected group
const mGroup = document.getElementById('form-group-sel');
user.Group = mGroup.value;
if(typeof dbData[3] == "string"){dbData[3] = []}
dbData[3].push(user);
}
//refresh tables
refreshModulesResultTables()
    
    };
    xmlhttp.open("GET",`php/getUserById.php?q=${userId}`);
    xmlhttp.send();
     }
}
function refreshModulesResultTables(){
getModuleLecturer(dbData[1]);
getModuleDeadlines(dbData[2]);
getModuleGroups(dbData[3]);
}
function showDeadlineFields(){
hide('deadlines-fields',0);
const mAddButton = document.getElementById('add-deadlines');
mAddButton.setAttribute("onclick", "addToDeadlinesList()");


}
function hideDeadlineFields(){
hide('deadlines-fields',1);
const mAddButton = document.getElementById('add-deadlines');
mAddButton.setAttribute("onclick", "showDeadlineFields()");
}
function addToDeadlinesList(){
const dName = document.getElementById('form-mod-dead-name');
const dWeight = document.getElementById('form-mod-dead-weight');
const dDate = document.getElementById('form-mod-dead-date');
const dLink = document.getElementById('form-mod-dead-moodle');
var deadline = {};
deadline.Name = dName.value;
deadline.Weight = dWeight.value;
deadline.Date = dDate.value;
deadline.Moodle_Link = dLink.value;
console.log('dbData :>> ', dbData);
if(typeof dbData[2] == "string"){
dbData[2] = [];
dbData[2][0] = deadline;
}else{
dbData[2].push(deadline);
}

getModuleDeadlines(dbData[2]);
hideDeadlineFields();
}
function fillRequestForms(id){
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function () {
    
    //document.getElementById("search-output").innerHTML = this.responseText;//<<<<For debugging
    dbData = JSON.parse(this.responseText);
    const fId = document.getElementById('form-req-id');
    const fUId = document.getElementById('form-req-uid');
    const fuser = document.getElementById('form-req-username');
    const fType = document.getElementById('form-req-type');
    const fStat = document.getElementById('form-req-stat');
    const fDesc = document.getElementById('form-req-desc');
    fId.value = dbData.Id;
    fUId.value = dbData.User_Id;
    fuser.value = dbData.Username;
    fType.value = dbData.Type;
    fStat.value = dbData.Status;
    fDesc.value = dbData.Description;
  }
  xmlhttp.open("GET", `php/getRequestById.php?q=${id}`);
  xmlhttp.send();


}