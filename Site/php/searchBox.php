<?php
include 'conn.php';
$q = strtolower($_REQUEST["q"]);
$searchType = $_REQUEST["type"];
$sql = "";
$columns = array();
$searchIn = null;
if ($searchType == "Programmes") {}
switch ($searchType) {
    case "Programmes":
        $sql = "SELECT * FROM Programmes
        WHERE LOWER('Name') LIKE '%{$q}%'
           OR LOWER('Degree') LIKE '%{$q}%'
           OR LOWER('Department') LIKE '%{$q}%'
           OR LOWER('Level') LIKE '%{$q}%'
           OR LOWER('Type') LIKE '%{$q}%'";
        $columns = array("Id", "Degree", "Name", "Level", "Type");
        break;
    case "Modules":
        $sql = "SELECT * FROM Modules
        WHERE LOWER('Id') LIKE '%{$q}%'
           OR LOWER('Name') LIKE '%{$q}%'";
        $columns = array("Id","Id", "Name", "Description");

        break;
    case "Users":
        $sql = "SELECT * FROM Users
        WHERE LOWER('Id') LIKE '%{$q}%'
           OR LOWER('First_Name') LIKE '%{$q}%'
           OR LOWER('Surname') LIKE '%{$q}%'
           OR LOWER('Gender') LIKE '%{$q}%'
           OR LOWER('Birth_Date') LIKE '%{$q}%'
           OR LOWER('Postcode') LIKE '%{$q}%'
           OR LOWER('Priv_Email') LIKE '%{$q}%'";
        $columns = array("Id", "Id", "First_Name", "Surname", "Title", "Gender","Birth_Date", "Priv_Email", "Uni_Email", "Telephone", "Next_Of_Kin", "Street_Number", "Street_Name", "Postcode");

        break;
    case "Events":
        $sql = "SELECT * FROM Events
        WHERE LOWER('Module') LIKE '%{$q}%'
           OR LOWER('Room') LIKE '%{$q}%'
           OR LOWER('Type') LIKE '%{$q}%'
           OR LOWER('Date') LIKE '%{$q}%'";
        $columns = array("Id", "Module", "Room", "Type", "Date", "Time_From", "Time_To", "Description", "Group");
        break;
    default:
        $sql = "";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $array = null;
    $i = 0;
    while ($row = $result->fetch_assoc()) {

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

} else {
    echo "No Results - Refine your search";
}
echo "<table id=\"resultstable\"><tr>";
for ($i = 1; $i < count($columns); $i++) {
    echo "<th onclick=\"sortTable({$i})\">{$columns[$i]}</th>";
}
echo "</tr>";

for ($i = 0; $i < count($array); $i++) {

    echo "<tr class=\"clickable-row\" onclick=\"\">";
    for ($j = 1; $j < count($columns); $j++) {
        echo "<td>{$array[$i][$columns[$j]]}</td>";
    }
    echo "</tr>";

}

echo "</table>";
?>
