<?php
include 'conn.php';
$id = mysqli_real_escape_string($conn, $_REQUEST['q']);
$sql = "SELECT * FROM Events WHERE Id = $id";
$result = $conn->query($sql);

$event = null;
if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result);
    $event = array(
        'Id' =>$row['Id'],
        'Module' =>$row['Module'],
        'Room' =>$row['Room'],
        'Type' =>$row['Type'],
        'Date' =>$row['Date'],
        'Time_From' =>$row['Time_From'],
        'Time_To' =>$row['Time_To'],
        'Description' =>$row['Description'],
        'Group' =>$row['Group']
    );
}
$conn->close();
echo json_encode($event);


?>