<?php
include 'conn.php';
$dbData = json_decode($_REQUEST['q'], true);//[0] - Module Info [1] - Lecturers [2] - Deadlines [3] - Student Groups
//distrubute data to separate variables
if(count($dbData) == 1){
    for ($i=1; $i <= 3 ; $i++) { 
        array_push($dbData, "string");
    }
}
$module = $dbData[0];
$lecturers = $dbData[1];
$deadlines = $dbData[2];
$groups = $dbData[3];
$errors = array();
//check if it's null
if(gettype($lecturers) == "string"){$lecturers = null;};
if(gettype($deadlines) == "string"){$deadlines = null;};
if(gettype($groups) == "string"){$groups = null;};
//----------------Save module data
//check if this module already exists
echo print_r($module);
$sql = "SELECT * FROM Modules WHERE id = \"{$module['Id']}\"";
$result = $conn->query($sql);
if(mysqli_num_rows($result) == 0){//create new module
    echo print_r($module);
$sql = "INSERT INTO Modules VALUES (\"{$module['Id']}\",\"{$module['Name']}\",\"{$module['Description']}\",\"{$module['Moodle_Link']}\");";
$result = $conn->query($sql);
if(!$result){
    array_push($errors, "adding new module failed");
}

}else{//update existing module
$sql = "UPDATE Modules SET
 `Name` = \"{$module['Name']}\", 
 `Description` = \"{$module['Description']}\",
 `Moodle_Link` = \"{$module['Moodle_Link']}\" 
 WHERE Id = \"{$module['Id']}\"";
}
$result = $conn->query($sql);
if(!$result){
    array_push($errors, "Updating module failed");
}


//----------------Save lecturers assigned to this module
if($lecturers != null){
    for ($i=0; $i < count($lecturers); $i++) { //add all lecturers
        $sql = "INSERT INTO Lecturers_Assignment VALUES(
            NULL, \"{$lecturers[$i]['Id']}\", \"{$module['Id']}\" 
        );"; 
        $result = $conn->query($sql);
        if(!$result){
            array_push($errors, "Updating lecturers failed");
        }
    }
    


}

//----------------Save Deadlines for this Module
if($deadlines != null){
    for ($i=0; $i < count($deadlines); $i++) { 
        $sql ="INSERT INTO Deadlines VALUES (
            NULL,
            \"{$module['Id']}\",
            \"{$deadlines['Name']}\",
            \"{$deadlines['Date']}\",
            \"{$deadlines['Weight']}\",
            \"{$deadlines['Moodle_Link']}\"
        );";
         $result = $conn->query($sql);
         if(!$result){
             array_push($errors, "Updating lecturers failed");
         }

    }
}
//----------------Save Student Groups for this Module
if($groups != null){
    for ($i=0; $i < count($groups); $i++) { //add all lecturers
        $sql = "INSERT INTO Student_Group VALUES(
            NULL, 
            \"{$module['Id']}\", 
            \"{$groups[$i]['Id']}\",  
            \"{$groups[$i]['Group']}\"
        );"; 
         echo $sql;
    $result = $conn->query($sql);
    if(!$result){
        array_push($errors, "Updating Student Groups failed");
    }
    }
    


}


if($errors == null){
    echo "Saved Succesfully!";
}else{
    echo "Could not save!";
    for ($i=0; $i < count($errors); $i++) { 
     echo "error: {$errors[$i]}";
    }
}
?>