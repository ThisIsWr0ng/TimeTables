<?php
include 'conn.php';

$year = mysqli_real_escape_string($conn, $_REQUEST['year']);
//$year = substr($year, 11);
$sql="SELECT Start_Date FROM Semesters WHERE Year = \"$year\" AND Name = \"Semester 1\";
SELECT End_Date FROM Semesters WHERE Year = \"$year\" AND Name = \"Semester 2\";";
//echo $sql;
$dates =array();
if ($conn -> multi_query($sql)) {
    do {
      // Store first result set
      if ($result = $conn -> store_result()) {
        while ($row = $result -> fetch_row()) {
          $dates[] = $row[0];
        }
       $result -> free_result();
      }
      
    } while ($conn -> next_result());
  }
  $conn -> close();
  echo json_encode($dates);
?>