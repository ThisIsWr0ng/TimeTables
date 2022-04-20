function findEventByType(id ,type){
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

    if(type == "Module"){

    }else if(type== "User"){
        
    }else if(type== "Event"){
        
    }else{console.log('Error :>> ', "Wrong type of input in findEventByType()");}
}