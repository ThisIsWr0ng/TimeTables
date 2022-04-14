<?php

include 'conn.php';
$modules = json_decode($_REQUEST["q"], true);
  
$progId = $modules[0]['Programme'];
  

$sql ="SELECT `modules`.*, `programmes`.`Id` AS `Programme`, `semesters`.`Year`,`semesters`.`Name` AS `Semester`
    FROM `modules` 
        LEFT JOIN `module_assignment` ON `module_assignment`.`Module` = `modules`.`Id` 
        LEFT JOIN `programmes` ON `module_assignment`.`Programme` = `programmes`.`Id` 
        LEFT JOIN `semesters` ON `module_assignment`.`Semester` = `semesters`.`Id`
        WHERE `Programmes`.`Id` = $progId";
$result = $conn->query($sql);
$i = 0;
$currentModules= [];
while($row = mysqli_fetch_array($result)){
    $currentModules[$i] = array(
        'Id'=>$row["Id"],
        'Name'=>$row["Name"],
        'Semester'=>$row["Semester"],
        'Year'=>$row["Year"]);
    $i++;
}


for ($i=0; $i <count($modules) ; $i++) { 
    
    for ($j=0; $j < count($currentModules); $j++) { 
        
        if($modules[$i]['Id'] === $currentModules[$j]['Id'] && $modules[$i]['Semester'] ===$currentModules[$j]['Semester'] && $modules[$i]['Year'] === $currentModules[$j]['Year']){
            $modules[$i]['Id'] = "del";
           
        }
    
    }
}

$count = 0;
 for ($i=0; $i < count($modules); $i++) { 
     if($modules[$i]['Id'] != "del"){
         $sql ="INSERT INTO `Module_assignment` VALUES (NULL, {$progId}, \"{$modules[$i]['Id']}\", (SELECT Id FROM `Semesters` WHERE `Name` = \"{$modules[$i]['Semester']}\" AND `Year` = \"{$modules[$i]['Year']}\"))";
         $res = $conn->query($sql);
         if($res){
            $count++;
         }else{echo "Error inserting data!";}
     }
     
 }
 if($count>0){
     echo "Succesfully inserted $count rows!";
 }
 





?>