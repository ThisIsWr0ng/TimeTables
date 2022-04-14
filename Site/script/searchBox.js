function removeText(){//Remove text from field when clicked
    document.getElementById("search-searchbar").value= "";
  }
  function fetchForm(type, formId,formData){
    var formField = document.getElementById(formId);
    formField.value = formData;
    if (type == "Users") {
        findUser(formData);//Fill other form fields with user info
    } else if ((type == "Programmes")){
        findProgramme(formData);
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