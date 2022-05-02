<?php //Get deadlines by module Id
include 'conn.php';
$moduleId = $_REQUEST['module'];

$sql = "SELECT * FROM Deadlines WHERE Module_Id = \"$moduleId\"";
//echo $sql;
$result = $conn->query($sql);
$i =0;
$deadlines =null;
if ($result->num_rows > 0){
while ($row = mysqli_fetch_array($result)) {
    $deadlines[$i] = array(
        "Name"=>$row["Name"],
        "Date"=>$row["Date"],
        "Weight"=>$row["Weight"],
        "Moodle_Link"=>$row["Moodle_Link"]);
        $i += 1;
}}

echo json_encode($deadlines);
?>