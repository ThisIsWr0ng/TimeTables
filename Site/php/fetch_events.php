<?php 
function fetchEvents() {
    include 'conn.php';
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      $array = null;
      $i = 0;
      while($row = $result->fetch_assoc()) {//separate outputs with for loop?
        $array[$i]= array('id' => $row["Id"], 'module' => $row["Module"], 'room' => $row["Room"], 'type' => $row["Type"], 'date' => $row["Date"],'time_from' => $row["Time_From"],'time_to' => $row["Time_To"],'description' => $row["Description"]);
        $i += 1;
      }
     return $array;
      
      
    } else{
      echo "Error Fetching from database";
    }
    $conn->close();
}

?>