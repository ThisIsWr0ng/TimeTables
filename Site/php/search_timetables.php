<?php

include 'conn.php';
$q = strtolower($_REQUEST["q"]);
$searchType = $_REQUEST["type"];
$sql = "";
$columns = array();
switch ($searchType) {
    case "Programmes":
        $columns = array("Id", "Degree", "Name", "Level", "Type");
       
        break;
    case "Modules":
        $columns = array("Id", "Id", "Name", "Description");
       
        break;
    case "Rooms":
        $columns = array("Number","Number", "Building", "Type");
      
        break;
    default:
    $columns = array("Id");
}
//Create SQL code

if($q == ""|| $q == " " || $q == "allfields"){
$sql = "SELECT * FROM {$searchType}";
}else{
$sql = "SELECT * FROM {$searchType}  WHERE ( ";
    

for ($i=0; $i < count($columns); $i++) { 
    if($i == count($columns) - 1){
        $a = "CONVERT(`{$columns[$i]}` USING utf8) LIKE '%{$q}%'";
        $sql .= $a;
    
    }else{
        $a = "CONVERT(`{$columns[$i]}` USING utf8) LIKE '%{$q}%' OR ";
        $sql .= $a;
    }
    
}
$a = ")";
$sql .= $a;
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array = null;
    $i = 0;
    while ($row = $result->fetch_assoc()) {

        /*for ($j = 0; $j < count($columns); $j++) {
            $temp = [];
            if ($j == 0) {
                $temp = array($columns[$j] => $row[$columns[$j]]);
            } else {
                $temp2 = array($columns[$j] => $row[$columns[$j]]);
                array_push($temp, $temp2);
            }
        }
        $array[$i] = $temp;*/
        if($searchType == "Programmes"){
        $array[$i] = array(
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'Degree' => $row["Degree"],
        'Level' => $row["Level"],
        'Type' => $row["Type"]);
        }elseif($searchType == "Modules" ){
            $array[$i] = array(
                'Id' => $row["Id"],
                'Name' => $row["Name"],
                'Description' => $row["Description"]);
        }elseif($searchType == "Rooms"){
            $array[$i] = array(
                'Number' => $row["Number"],
                'Building' => $row["Building"],
                'Type' => $row["Type"],
                'Section' => $row["Section"]);
        }
        $i += 1;
    }
    echo "<table id=\"resultstable\"><tr>";
    for ($i = 1; $i < count($columns); $i++) {
        $k = $i-1;
        echo "<th onclick=\"sortTable({$k})\">{$columns[$i]}</th>";
    }
    echo "</tr>";
    
        for ($i = 0; $i < count($array); $i++) {
        
            
                echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i][$columns[0]]}&type={$searchType}'\">";
                for ($j = 1; $j < count($columns); $j++) {
                    echo "<td>{$array[$i][$columns[$j]]}</td>";
                }
                echo "</tr>";
            
    
        }
    
    echo "</table>";
} else {
    echo "No results! Refine your search";
}

$conn->close();
?>