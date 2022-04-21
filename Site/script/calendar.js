function drawCalendar(dbData){
    cal.init(dbData);
}

var cal = {
  
    // (A) PROPERTIES
    // (A1) COMMON CALENDAR
    sMon : false, // Week start on Monday?
    mName : ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], // Month Names
  
    // (A2) CALENDAR DATA
    data : [{}], // Events for the selected period
    sDay : 0, sMth : 0, sYear : 0, // Current selected day, month, year
  
    // (A3) COMMON HTML ELEMENTS
    hMth : null, hYear : null, // month/year selector
    hForm : null, hfHead : null, hfDate : null, hfTxt : null, hfDel : null, hOverlay : null, hNxt : null, hReq : null, hrFields : null, hfTime :null,// event form
  
    // (B) INIT CALENDAR
    init : (dbData) => {
      // (B1) GET + SET COMMON HTML ELEMENTS
      cal.hMth = document.getElementById("cal-mth");
      cal.hYear = document.getElementById("cal-yr");
      cal.hForm = document.getElementById("cal-event");
      cal.hfHead = document.getElementById("evt-head");
      cal.hfDate = document.getElementById("evt-date");
      cal.hfTxt = document.getElementById("evt-details");
      cal.hOverlay = document.getElementById("overlay");
      cal.hNxt = document.getElementById("evt-next");
      cal.hReq = document.getElementById("evt-request");
      cal.hrFields = document.getElementById("request-fileds");
      cal.hfTime =document.getElementById("evt-time");
      document.getElementById("evt-close").onclick = cal.close;
      cal.hReq.onclick = cal.showRequest;
      dbData;
      currentEventIndex = 0;
      cal.hNxt.onclick = cal.next;
      currentCell = null;
      
      // (B2) DATE NOW
      let now = new Date(),
          nowMth = now.getMonth(),
          nowYear = parseInt(now.getFullYear());
  
      // (B3) APPEND MONTHS SELECTOR
      for (let i=0; i<12; i++) {
        let opt = document.createElement("option");
        opt.value = i;
        opt.innerHTML = cal.mName[i];
        if (i==nowMth) { opt.selected = true; }
        cal.hMth.appendChild(opt);
      }
      cal.hMth.onchange = cal.list;
  
      // (B4) APPEND YEARS SELECTOR
      // Set to 10 years range. Change this as you like.
      for (let i=nowYear-10; i<=nowYear+10; i++) {
        let opt = document.createElement("option");
        opt.value = i;
        opt.innerHTML = i;
        if (i==nowYear) { opt.selected = true; }
        cal.hYear.appendChild(opt);
      }
      cal.hYear.addEventListener("change", cal.list);
  
      // (B5) START - DRAW CALENDAR
      cal.list();
    },
  
    // (C) DRAW CALENDAR FOR SELECTED MONTH
    list : () => {
      // (C1) BASIC CALCULATIONS - DAYS IN MONTH, START + END DAY
      // Note - Jan is 0 & Dec is 11
      // Note - Sun is 0 & Sat is 6
      cal.sMth = parseInt(cal.hMth.value); // selected month
      cal.sYear = parseInt(cal.hYear.value); // selected year
      let daysInMth = new Date(cal.sYear, cal.sMth+1, 0).getDate(), // number of days in selected month
          startDay = new Date(cal.sYear, cal.sMth, 1).getDay(), // first day of the month
          endDay = new Date(cal.sYear, cal.sMth, daysInMth).getDay(), // last day of the month
          now = new Date(), // current date
          nowMth = now.getMonth(), // current month
          nowYear = parseInt(now.getFullYear()), // current year
          nowDay = cal.sMth==nowMth && cal.sYear==nowYear ? now.getDate() : null ;
  
      //Prepare events from database data
      for (var i = 0; i <= daysInMth; i++){
        cal.data[i] = null;
      }
      
      for(var i = 0; i < dbData.length; i++){
        if(parseInt(dbData[i].date.substr(5, 6)) -1 == cal.sMth){
        var day = parseInt(dbData[i].date.substr(8, 9))
        if(cal.data[day] != null){
          if(parseInt(cal.data[day][cal.data[day].length-1].time_from.substr(0,5)) > parseInt(dbData[i].time_from.substr(0,5))){//Earlier event is displayed on top
            cal.data[day].unshift(dbData[i]);
          }else{
            cal.data[day].push(dbData[i]);
          }
          
        }else{
        cal.data[day] = [dbData[i]];
        }
      }
      }
      console.log("Prepared data:", cal.data);

      // (C3) DRAWING CALCULATIONS
      // Blank squares before start of month
      let squares = [];
      if (cal.sMon && startDay != 1) {
        let blanks = startDay==0 ? 7 : startDay ;
        for (let i=1; i<blanks; i++) { squares.push("b"); }
      }
      if (!cal.sMon && startDay != 0) {
        for (let i=0; i<startDay; i++) { squares.push("b"); }
      }
  
      // Days of the month
      for (let i=1; i<=daysInMth; i++) { squares.push(i); }
  
      // Blank squares after end of month
      if (cal.sMon && endDay != 0) {
        let blanks = endDay==6 ? 1 : 7-endDay;
        for (let i=0; i<blanks; i++) { squares.push("b"); }
      }
      if (!cal.sMon && endDay != 6) {
        let blanks = endDay==0 ? 6 : 6-endDay;
        for (let i=0; i<blanks; i++) { squares.push("b"); }
      }
  
      // (C4) DRAW HTML CALENDAR
      // Get container
      let container = document.getElementById("cal-container"),
      cTable = document.createElement("table");
      cTable.id = "calendar";
      container.innerHTML = "";
      container.appendChild(cTable);
  
      // First row - Day names
      let cRow = document.createElement("tr"),
          days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      if (cal.sMon) { days.push(days.shift()); }
      for (let d of days) {
        let cCell = document.createElement("td");
        cCell.innerHTML = d;
        cRow.appendChild(cCell);
      }
      cRow.classList.add("head");
      cTable.appendChild(cRow);
  
      // Days in Month
      let total = squares.length;
      cRow = document.createElement("tr");
      cRow.classList.add("day");
      var evColors = ["#556B2F", "#E9967A", "#8FBC8F", "#2F4F4F", "#DAA520"];//Event tiles colors
      var modules = [dbData[0].module];
      for (let i = 0; i < dbData.length; i++) {//check how many modules are available
        for (let j = 0; j < modules.length; j++) {
          if(modules[j] == dbData[i].module){ 
           break;
        }else if( j == modules.length - 1){
          modules.push(dbData[i].module);
        }
        }
      }
      console.log("mod:", modules);
      for (let i=0; i<total; i++) {
        let cCell = document.createElement("td");
        if (squares[i]=="b") { cCell.classList.add("blank"); }
        else {
          if (nowDay==squares[i]) { cCell.classList.add("today"); }
          cCell.innerHTML = `<div class="dd">${squares[i]}</div>`;
          if (cal.data[squares[i]]) {
          
              for (let index = 0; index < cal.data[squares[i]].length; index++) {
                var data = cal.data[squares[i]][index];
                var color = null;
                for (let j = 0; j < modules.length; j++) {//Assign one cor for each module
                  if(data.module == modules[j]){
                    color = evColors[j];
                  }
                }
                cCell.innerHTML += `<div class='evt' style="background-color: ${color};">
                <p>${data.time_from.substr(0,5)}-${data.time_to.substr(0,5)}: ${data.type}</p>
                <p>${data.module}</p>
                <p>${data.room} ${data.room_type}</p>
                </div>`;
              }
            
          }
          cCell.onclick = () => { 
            currentCell = cCell;
            cal.show(cCell, 0);
           
           };
        }
        cRow.appendChild(cCell);
        if (i!=0 && (i+1)%7==0) {
          cTable.appendChild(cRow);
          cRow = document.createElement("tr");
          cRow.classList.add("day");
        }
      }
     
      // (C5) REMOVE ANY PREVIOUS ADD/EDIT EVENT DOCKET
      cal.close();
    },
  
    // (D) SHOW EDIT EVENT DOCKET FOR SELECTED DAY
    show : (el, index, request) => {
      // (D1) FETCH EXISTING DATA
      cal.sDay = el.getElementsByClassName("dd")[0].innerHTML;
      
      let hasEvents = cal.data[cal.sDay] != null ;
      if(request){
        hasEvents = false
      }
  
      // (D2) UPDATE EVENT FORM
      cal.hfTime.classList.add("hideOverlay");
      cal.hrFields.classList.add("hideOverlay");
      cal.hNxt.classList.add("hideOverlay");
      cal.hOverlay.classList.remove("hideOverlay");
      document.getElementById("evt-moodle-page").classList.add("hideOverlay");
      document.getElementById("evt-room").classList.add("hideOverlay");
      

      if(hasEvents){//If there's an event during this day
        var data = cal.data[cal.sDay][index];
        cal.hfDate.setAttribute('value', `${cal.sYear}-${("0" +(cal.sMth + 1)).slice(-2)}-${("0" + cal.sDay).slice(-2)}`);//date
        cal.hfTime.innerHTML = `${data.time_from.substr(0,5)} - ${data.time_to.substr(0,5)}`;
        cal.hfTime.classList.remove("hideOverlay");
        cal.hfTxt.value = data.description;
        cal.hfHead.innerHTML= `<h1>${data.module}:</h1><h2>${data.module_name}</h2>Semester ${data.semester}`;
        head = document.createElement("h2").innerHTML=data.module_name;
        document.getElementById("evt-room").classList.remove("hideOverlay");
        document.getElementById("evt-room").innerHTML = `Room: ${data.room}, ${data.room_type}`;
        if(data.moodle_link != null){
        document.getElementById("evt-moodle-page").setAttribute("onclick", `location.href='${data.moodle_link}'`);
        document.getElementById("evt-moodle-page").classList.remove("hideOverlay");
        }
      if(cal.data[el.getElementsByClassName("dd")[0].innerHTML].length > 1){//If there's more than one event in a day
        cal.hNxt.classList.remove("hideOverlay");
      }
    }else{ //if there's no event during this day
      cal.hfDate.setAttribute('value', `${cal.sYear}-${("0" +(cal.sMth + 1)).slice(-2)}-${("0" + cal.sDay).slice(-2)}`);//date
      cal.hfTxt.value = "";
      cal.hfHead.innerHTML = "<h1>Add Event</h1>";
      
    }

    },
  
    // (E) CLOSE EVENT DOCKET
    close : () => {
      //cal.hForm.classList.add("hideOverlay");
      cal.hOverlay.classList.add("hideOverlay");
      cal.hfDate.setAttribute('readonly', '');
    },
  
    // (F) Request EVENT
    showRequest : () => {
      console.log("ShowRequest Started!");
      cal.hfTxt.removeAttribute('readonly');
      cal.hfDate.removeAttribute('readonly');
      cal.show(currentCell, 0, true);
      cal.hrFields.classList.remove("hideOverlay");
      cal.hReq.removeAttribute("type");
      cal.hReq.setAttribute('type', "submit")
    },
   
  
    // (G) DELETE EVENT FOR SELECTED DATE
    del : () => { if (confirm("Delete event?")) {
  
    }},

    next : () => {
      
      var numEvents = cal.data[currentCell.getElementsByClassName("dd")[0].innerHTML].length;
      console.log("cell", numEvents - 1, currentEventIndex);
      if(numEvents - 1 > currentEventIndex){
        cal.show(currentCell, ++currentEventIndex, false);
      }else{
        cal.show(currentCell, 0, false);
        currentEventIndex = 0;
      }
      
      
    }
  };
  function displayCalendarFor(type, id){
    window.location=`timetable.php?id=${id}&type=${type}`;
    if(type =="Module"){
      
    }else if (type == "Programme") {
      
    } else if(type == "User"){
      
    }
  }
 

  