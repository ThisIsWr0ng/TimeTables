<?php
include 'conn.php';
$id = mysqli_real_escape_string($conn, $_REQUEST['Id']);
$name = mysqli_real_escape_string($conn, $_REQUEST['eName']);
$type = mysqli_real_escape_string($conn, $_REQUEST['Type']);
$date = mysqli_real_escape_string($conn, $_REQUEST['Date']);
$timeFrom = mysqli_real_escape_string($conn, $_REQUEST['TimeF']);
$timeTo = mysqli_real_escape_string($conn, $_REQUEST['TimeT']);
$room = mysqli_real_escape_string($conn, $_REQUEST['Rooms']);
$group = mysqli_real_escape_string($conn, $_REQUEST['Group']);
$rec = mysqli_real_escape_string($conn, $_REQUEST['Recurring']);
$desc = mysqli_real_escape_string($conn, $_REQUEST['Description']);
$radio = mysqli_real_escape_string($conn, $_REQUEST['sessionradio']);
$sButton = mysqli_real_escape_string($conn, $_REQUEST['sButton']);
if($group == "None"){$group = null;};
if($sButton == "Save"){
if($radio == "Session"){
$sql = "INSERT INTO Events VALUES (
    NULL,
    \"$id\",
    \"$room\",
    \"$type\",
    \"$date\",
    \"$timeFrom\",
    \"$timeTo\",
    \"$desc\",
    '$group'
)";
$result = $conn->query($sql);


}else if($radio == "User Event"){

}



}else if($sButton == "Delete"){

}

//header("location: ../admin_events.php");
?>