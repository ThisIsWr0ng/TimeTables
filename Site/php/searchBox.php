<?php
include 'conn.php';
$q = strtolower($_REQUEST["q"]);
$searchType = $_REQUEST["type"];
$sql = "";
$columns = array();
$onClick = null;
//define what to search for and select columns to search/display
switch ($searchType) {
    case "Programmes":
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        $onClick = "form-programme-id";
        break;
    case "Modules":
        $columns = array("Id", "Name", "Description");
        $onClick = "form-module-id";
        break;
    case "Users":
        $columns = array("Id", "First_Name", "Surname", "Title", "Role", "Gender","Birth_Date", "Priv_Email", "Uni_Email", "Telephone", "Next_Of_Kin", "Street_Number", "Street_Name", "Postcode");
        $onClick = "form-user-id";
        break;
    case "Events":
        $columns = array("Id", "Module", "Room", "Type", "Date", "Time_From", "Time_To", "Description", "Group");
        $onClick = "form-event-id";
        break;
    default:
    $columns = array("Id");
}
//Create SQL code
$sql = "SELECT * FROM {$searchType}";

if($searchType == "Users"){
    $sql = "SELECT `Users`.*, `Roles`.Name AS \"Role\" FROM {$searchType} LEFT JOIN `role_assignment` ON `role_assignment`.`User` = `users`.`Id` 
	LEFT JOIN `roles` ON `role_assignment`.`Role` = `roles`.`Id`  WHERE (  ";
    }else{
        $sql = "SELECT * FROM {$searchType}  WHERE ( ";
    }

for ($i=0; $i < count($columns); $i++) { 
    if($i == count($columns) - 1){
        $a = "CONVERT(`{$columns[$i]}` USING utf8) LIKE '%{$q}%'";
        $sql .= $a;
    }elseif($searchType == "Users" && $i == 0){
        $a = "CONVERT(`Users`.`Id` USING utf8) LIKE '%{$q}%' OR ";
        $sql .= $a;
    }else{
        $a = "CONVERT(`{$columns[$i]}` USING utf8) LIKE '%{$q}%' OR ";
        $sql .= $a;
    }
    
}
$a = ")";
$sql .= $a;
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array = null;
    $i = 0;
    while ($row = $result->fetch_assoc()) { //convert sql results into array

        /*for ($j = 0; $j < count($columns); $j++) { //<<<<<<<<<<<God knows why that doesn't work
        $temp = [];
        if ($j == 0) {
        $temp = array($columns[$j] => $row[$columns[$j]]);
        } else {
        $temp2 = array($columns[$j] => $row[$columns[$j]]);
        array_push($temp, $temp2);
        }
        }
        $array[$i] = $temp;*/
        if ($searchType == "Programmes") {
            $array[$i] = array(
                'Id' => $row["Id"],
                'Name' => $row["Name"],
                'Degree' => $row["Degree"],
                'Level' => $row["Level"],
                'Type' => $row["Type"]);
        } elseif ($searchType == "Modules") {
            $array[$i] = array(
                'Id' => $row["Id"],
                'Name' => $row["Name"],
                'Description' => $row["Description"]);
        } elseif ($searchType == "Users") {
            $array[$i] = array(
                "Id" => $row["Id"],
                "First_Name" => $row["First_Name"],
                "Surname" => $row["Surname"],
                "Title" => $row["Title"],
                "Gender" => $row["Gender"],
                "Birth_Date" => $row["Birth_Date"],
                "Priv_Email" => $row["Priv_Email"],
                "Uni_Email" => $row["Uni_Email"],
                "Telephone" => $row["Telephone"],
                "Next_Of_Kin" => $row["Next_Of_Kin"],
                "Street_Number" => $row["Street_Number"],
                "Street_Name" => $row["Street_Name"],
                "Postcode" => $row["Postcode"],
                "Role" => $row["Role"],
            );
        } elseif ($searchType == "Events") {
            $array[$i] = array(
                "Id" => $row["Id"],
                "Module" => $row["Module"],
                "Room" => $row["Room"],
                "Type" => $row["Type"],
                "Date" => $row["Date"],
                "Time_From" => $row["Time_From"],
                "Time_To" => $row["Time_To"],
                "Description" => $row["Description"],
                "Group" => $row["Group"],
            );
        }
        $i += 1;
    }

//Echo results
echo "<table id=\"resultstable\"><tr>";
for ($i = 0; $i < count($columns); $i++) {
 
    echo "<th onclick=\"sortTable({$i})\">{$columns[$i]}</th>";
}
echo "</tr>";

for ($i = 0; $i < count($array); $i++) {

    echo "<tr class=\"clickable-row\" onclick=\"fetchForm('{$searchType}','{$onClick}', '{$array[$i]['Id']}')\">";
    for ($j = 0; $j < count($columns); $j++) {
       
        echo "<td>{$array[$i][$columns[$j]]}</td>";
    }
    echo "</tr>";

}

echo "</table>";
} else {
    echo "No Results - Refine your search";
}
$conn->close();
?>
