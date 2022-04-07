<?php

include 'conn.php';
$q = strtolower($_REQUEST["q"]);
$searchType = $_REQUEST["type"];
$sql = "";
$columns = array();
$searchIn = null;
if ($searchType == "Programme") {}
switch ($searchType) {
    case "Programme":
        $sql = "SELECT * FROM programmes";
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        $searchIn = $columns[2];
        break;
    case "Module":
        $sql = "SELECT * FROM modules";
        $columns = array("Id","Id", "Name", "Description");
        $searchIn = $columns[2];
        break;
    case "Room":
        $sql = "SELECT * FROM Rooms";
        $columns = array("Number", "Number", "Type", "Building", "Section");
        $searchIn = $columns[1];
        break;
    case "Degree":
        $sql = "SELECT * FROM programmes";
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        $searchIn = $columns[1];
    case "Year":
        $sql = "SELECT * FROM programmes";
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        $searchIn = $columns[3];
        break;
    case "Type":
        $sql = "SELECT * FROM programmes";
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        $searchIn = $columns[4];
        break;
    case "Name":
        $sql = "";
        $columns = array();
        break;

    default:
        $sql = "";
        $columns = array();
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
        if($searchType == "Programme" || $searchType == "Degree" || $searchType == "Year" || $searchType == "Type"){
        $array[$i] = array(
        'Id' => $row["Id"],
        'Name' => $row["Name"],
        'Degree' => $row["Degree"],
        'Level' => $row["Level"],
        'Type' => $row["Type"]);
        }elseif($searchType == "Module" ){
            $array[$i] = array(
                'Id' => $row["Id"],
                'Name' => $row["Name"],
                'Description' => $row["Description"]);
        }elseif($searchType == "Room"){
            $array[$i] = array(
                'Number' => $row["Number"],
                'Building' => $row["Building"],
                'Type' => $row["Type"],
                'Section' => $row["Section"]);
        }
        $i += 1;
    }

} else {
    echo "0 results";
}
echo "<table id=\"resultstable\"><tr>";
for ($i = 1; $i < count($columns); $i++) {
    echo "<th onclick=\"sortTable({$i})\">{$columns[$i]}</th>";
}
echo "</tr>";
if ($q != "all" || $q !== "" || $q !== null) {
    for ($i = 0; $i < count($array); $i++) {
        $find = strtolower($array[$i][$searchIn]);
        if (strpos($find, $q) !== false) {
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i][$columns[0]]}&type={$searchType}'\">";
            for ($j = 1; $j < count($columns); $j++) {
                echo "<td>{$array[$i][$columns[$j]]}</td>";
            }
            echo "</tr>";
        }

    }
}elseif ($q == "allfields"){
    for ($i = 0; $i < count($array); $i++) {
       
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i][$columns[0]]}&type={$searchType}'\">";
            for ($j = 1; $j < count($columns); $j++) {
                echo "<td>{$array[$i][$columns[$j]]}</td>";
            }
            echo "</tr>";
        

    }
}
echo "</table>";
?>