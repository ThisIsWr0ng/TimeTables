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
        $columns = array("Id","Degree", "Name", "Level", "Type");
        $searchIn = $columns[2];
      break;
    case "Module":
        $sql = "";
        $columns = array();
      break;
    case "Room":
        $sql = "";
        $columns = array();
      break;
    case "Degree":
        $sql = "";
        $columns = array();
        break;
    case "Year":
        $sql = "";
        $columns = array();
        break;
    case "Type":
        $sql = "";
        $columns = array();
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
        
            for ($j=0; $j < count($columns); $j++) { 
                $array[$i] = array($columns[$j] => $row[$columns[$j]]);
            }
            /*'id' => $row["Id"],
            'name' => $row["Name"],
            'degree' => $row["Degree"],
            'department' => $row["Department"],
            'level' => $row["Level"],
            'type' => $row["Type"],
            'start_date' => $row["Start_Date"],
            'end_date' => $row["End_Date"],
            'description' => $row["Description"],*/
        
        $i += 1;
    }
} else {
    echo "0 results";
}
echo "<table><tr>";
for ($i=1; $i < count($columns); $i++) { 
    echo "<th>{$columns[$i]}</th>";
}
echo"</tr>";
//echo "<table><tr><th>Degree</th><th>Name</th><th>Level</th><th>Type</th></tr>";
if ($q == "all" || $q == "") {
    for ($i = 0; $i < count($array); $i++) {
        $find = strtolower($array[$i][$searchIn]);//column to search in
        if (strpos($find, $q) !== false) {
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i][$columns[0]]}'\">";
          for ($j=1; $j < count($columns); $j++) { 
              echo "<td>{$array[$i][$columns[$j]]}</td>";
          }
          echo"</tr>";
        }
    }
} else {
    

    for ($i = 0; $i < count($array); $i++) {
        $find = strtolower($array[$i][$searchIn]);
        if (strpos($find, $q) !== false) {
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i][$columns[0]]}'\">";
            for ($j=1; $j < count($columns); $j++) { 
                echo "<td>{$array[$i][$columns[$j]]}</td>";
            }
            echo"</tr>";
        }

    }
}
echo "</table>";
?>