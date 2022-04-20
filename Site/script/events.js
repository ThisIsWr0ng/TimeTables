
let dbEvent = null;
//set visible fields

function findEventByType(id ,type){
    const fLabel = document.getElementById('form-evt-idlabel');
    const fId = document.getElementById('form-evt-id');
    const fName = document.getElementById('form-evt-name');
    const fType = document.getElementById('form-evt-type');
    const fDate = document.getElementById('form-evt-date');
    const fTimef = document.getElementById('form-evt-timefrom');
    const fTimet = document.getElementById('form-evt-timeto');
    const fRoom = document.getElementById('form-evt-room');
    const fGroup = document.getElementById('form-evt-group');
    const fRec = document.getElementById('form-evt-recurring');
    const fDesc = document.getElementById('form-evt-desc');

   if(type== "Event"){
       const xmlhttp = new XMLHttpRequest();
       xmlhttp.onload = function () {
        //document.getElementById('search-output').innerHTML= this.responseText;
        dbEvent = JSON.parse(this.responseText);
        displayEventFields("Session");
        document.getElementById('ev-radio-session').checked = true;
        fId.value = dbEvent.Module;
        fType.value = dbEvent.Type;
        fDate.value = dbEvent.Date;
        fTimef.value = dbEvent.Time_From;
        fTimet.value = dbEvent.Time_To;
        getAvailableRooms(dbEvent.Date, dbEvent.Time_From, dbEvent.Time_To, dbEvent.Module);
        fRoom.value = dbEvent.Room;
        fGroup.value = dbEvent.Group;
        fDesc.value = dbEvent.Description;
        fRec.value = "Weekly";
       };
       xmlhttp.open("GET", `php/getEventById.php?q=${id}`);
       xmlhttp.send();

        
    }else{console.log('Error :>> ', "Wrong type of input in findEventByType()");}
}
function displayEventFields(type){
    const fLabel = document.getElementById('form-evt-idlabel');
    const fName = document.getElementById('form-name');
    const fType = document.getElementById('form-type');
    const fRoom = document.getElementById('form-rooms');
    const fGroup = document.getElementById('form-group');
    if (type == "Session") {
        fLabel.innerHTML = "Module:";
        fName.classList.add('hidden');
        fType.classList.remove('hidden');
        fGroup.classList.remove('hidden');
        fRoom.classList.remove('hidden');

    } else if(type == "User Event") {
        fLabel.innerHTML = "User:";
        fName.classList.remove('hidden');
        fType.classList.add('hidden');
        fGroup.classList.add('hidden');
        fRoom.classList.add('hidden');
        
    }
}
function getAvailableRooms(date, timeFrom, timeTo, module){
    
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        //document.getElementById('search-output').innerHTML= this.responseText;
        var rooms = JSON.parse(this.responseText);
        const fRoom = document.getElementById('form-evt-room');
        removeAllChildNodes(fRoom);
        optgroup = document.createElement("optgroup");
        optgroup.setAttribute("label", "Available Rooms:")
        for (let i = 0; i < rooms[1].length; i++) {
           
            option  = document.createElement("option");
            option.value = rooms[1][i].Number;
            option.innerHTML = rooms[1][i].Number + ", "  + rooms[1][i].Type;
            optgroup.appendChild(option);
            
        }
        fRoom.appendChild(optgroup);

        if(rooms[0].length > 0){
            optgroup = document.createElement("optgroup");
            optgroup.setAttribute("label", "Groups Needed:")
        
        for (let i = 0; i < rooms[0].length; i++) {//rooms that will require groups
            option  = document.createElement("option");
            option.value = rooms[1][i].Number;
            option.innerHTML = rooms[1][i].Number + ", "  + rooms[1][i].Type;
            optgroup.appendChild(option);
        }
        fRoom.appendChild(optgroup);
    }
    }
    xmlhttp.open("GET", `php/getAvailableRooms.php?date=${date}&timef=${timeFrom}&timet=${timeTo}&module=${module}`);
    xmlhttp.send();
    
}
function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}
function refreshRooms(){
    const fId = document.getElementById('form-evt-id');
    const fDate = document.getElementById('form-evt-date');
    const fTimef = document.getElementById('form-evt-timefrom');
    const fTimet = document.getElementById('form-evt-timeto');
    getAvailableRooms(fDate.value, fTimef.value, fTimet.value, fId.value);
}
