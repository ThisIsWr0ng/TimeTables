<?php
require_once "conn.php";

$id = mysqli_real_escape_string($conn, $_REQUEST['requestid']);
$requestType = $_POST['btSubmit'];

if ($requestType == "Completed"){

    $comsql = "UPDATE requests SET Status='1' WHERE Id='$id'";

    $conn->query($comsql);

    header("location: ../admin_requests.php");
}
else if ($requestType == "Denied") {

    $densql = "UPDATE requests SET Status='2' WHERE Id='$id'";

    $conn->query($densql);

    header("location: ../admin_requests.php");
}
else if ($requestType == "Delete") {
    
    $delsql = "DELETE FROM requests WHERE Id='$id'";

    $conn->query($delsql);

    header("location: ../admin_requests.php");
}
?>