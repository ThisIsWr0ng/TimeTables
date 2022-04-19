<?php
include 'conn.php';
$q = $_REQUEST['q'];
$sql ="SELECT * FROM users WHERE id = \"$q\"";
$result = $conn->query($sql);
$i =0;
$user =null;
$row = mysqli_fetch_array($result);
    $user = array(
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
        "Postcode" => $row["Postcode"]);
echo json_encode($user);
?>