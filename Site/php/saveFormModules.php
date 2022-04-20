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
$sql = "SELECT * FROM Modules WHERE id = \"{$module['Id']}\"";
$result = $conn->query($sql);
if(mysqli_num_rows($result) == 0){//create new module
$sql = "INSERT INTO Modules VALUES (\"{$module['Id']}\",\"{$module['Name']}\",\"{$module['Description']}\",\"{$module['Moodle_Link']}\");";
$result = $conn->query($sql);
if(!$result){
    array_push($errors, "adding new module failed");
}else{
    echo "Added a new module.\n";
}

}else{//update existing module
$sql = "UPDATE Modules SET
 `Name` = \"{$module['Name']}\", 
 `Description` = \"{$module['Description']}\",
 `Moodle_Link` = \"{$module['Moodle_Link']}\" 
 WHERE Id = \"{$module['Id']}\"";
 $result = $conn->query($sql);
 if(!$result){
     array_push($errors, "Updating module failed", $sql);
 }else{
     echo "Updated existing module.\n";
 }
}



//----------------Save lecturers assigned to this module
if($lecturers != null){
    for ($i=0; $i < count($lecturers); $i++) { //add all lecturers
        $sql = "SELECT Lecturer FROM  Lecturers_Assignment WHERE Module = \"{$module['Id']}\"";//check for similalities in db
        $result = $conn->query($sql);
        $cont = false;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()) { 
               if($lecturers[$i]['Id'] == $row['Lecturer']){
                   $cont = true;
                   break;
               }
            }
        }
        if($cont == true){continue;}//if it already exists, continue

        $sql = "INSERT INTO Lecturers_Assignment VALUES(
            NULL, \"{$lecturers[$i]['Id']}\", \"{$module['Id']}\" 
        );"; 
        $result = $conn->query($sql);
        if(!$result){
            array_push($errors, "Updating lecturers failed");
        }
    }
}else{//delete lecturers
    $sql = "DELETE FROM Lecturers_Assignment WHERE Module = \"{$module['Id']}\"";
    $conn->query($sql);
}

//----------------Save Deadlines for this Module
if($deadlines != null){
    for ($i=0; $i < count($deadlines); $i++) { 
        $sql = "SELECT Name FROM Deadlines WHERE Module_Id = \"{$module['Id']}\"";//check for similalities in db
        $result = $conn->query($sql);
        $cont = false;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()) { 
               if($deadlines[$i]['Name'] == $row['Name']){
                   $cont = true;
                   break;
               }
            }
        }
        if($cont == true){continue;}//if it already exists, continue

        $sql ="INSERT INTO Deadlines VALUES (
            NULL,
            \"{$module['Id']}\",
            \"{$deadlines[$i]['Name']}\",
            \"{$deadlines[$i]['Date']}\",
            \"{$deadlines[$i]['Weight']}\",
            \"{$deadlines[$i]['Moodle_Link']}\"
        );";
        
         $result = $conn->query($sql);
         if(!$result){
             array_push($errors, "Updating deadlines failed");
         }
    }
}else{
 $sql = "DELETE FROM Deadlines WHERE Module_Id = \"{$module['Id']}\"";
$conn->query($sql);
}
//----------------Save Student Groups for this Module
if($groups != null){
    for ($i=0; $i < count($groups); $i++) { //add all lecturers
        $sql = "SELECT User, Group_Name FROM Student_Group WHERE Module = \"{$module['Id']}\"";//check for similalities in db
        $result = $conn->query($sql);
        $cont = false;
        if($result->num_rows >0){
            while($row = $result->fetch_assoc()) { 
               if($groups[$i]['Group'] == $row['Group_Name'] && $groups[$i]['Id'] == $row['User']){
                   $cont = true;
                   break;
               }
            }
        }
        if($cont == true){continue;}//if it already exists, continue
        $sql = "INSERT INTO Student_Group VALUES(
            NULL, 
            \"{$module['Id']}\", 
            \"{$groups[$i]['Id']}\",  
            \"{$groups[$i]['Group']}\"
        );"; 
    $result = $conn->query($sql);
    if(!$result){
        array_push($errors, "Updating Student Groups failed");
    }
    }

}else{
    $sql = "DELETE FROM Student_Group WHERE Module = \"{$module['Id']}\"";
    $conn->query($sql);
}


if($errors == null){
    echo "Saved Succesfully!";
}else{
    echo "Could not save!";
    for ($i=0; $i < count($errors); $i++) { 
     echo "error: {$errors[$i]}\n";
    }
}
?>