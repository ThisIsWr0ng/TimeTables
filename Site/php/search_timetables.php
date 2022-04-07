<?php

include 'conn.php';
$q= $_REQUEST["q"];
$searchType = $_REQUEST["type"];

$sql = "SELECT * FROM programmes";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array = null;
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        $array[$i] = array(
            'id' => $row["Id"],
            'name' => $row["Name"],
            'degree' => $row["Degree"],
            'department' => $row["Department"],
            'level' => $row["Level"],
            'type' => $row["Type"],
            'start_date' => $row["Start_Date"],
            'end_date' => $row["End_Date"],
            'description' => $row["Description"],
        );
        $i += 1;
    }
} else {
    echo "0 results";
}
 

$hint = "";

// lookup all hints from array if $q is different from ""
echo "<table><tr><th>Degree</th><th>Name</th><th>Level</th><th>Type</th></tr>";
if ($q == "alL" || $q == "") {
    for ($i = 0; $i < count($array); $i++) {
        $find = strtolower($array[$i]['name']);
        if (strpos($find, $q) !== false) {
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i]['id']}'\">
          <td>{$array[$i]['degree']}</td>
          <td>{$array[$i]['name']}</td>
          <td>{$array[$i]['level']}</td>
          <td>{$array[$i]['type']}</td></tr>";
        }
    }
} else {
    $q = strtolower($q);
    $len = strlen($q);

    for ($i = 0; $i < count($array); $i++) {
        $find = strtolower($array[$i]['name']);
        if (strpos($find, $q) !== false) {
            echo "<tr class=\"clickable-row\" onclick=\"window.location='timetable.php?id={$array[$i]['id']}'\">
          <td>{$array[$i]['degree']}</td>
          <td>{$array[$i]['name']}</td>
          <td>{$array[$i]['level']}</td>
          <td>{$array[$i]['type']}</td></tr>";
        }

    }
}
echo "</table>";

// Output "no suggestion" if no hint was found or output correct values
