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
        $array[$i]= array('id' => $row["id"], 'module' => $row["module"], 'room' => $row["room"], 'type' => $row["type"], 'day_of_week' => $row["day_of_week"],'time_from' => $row["time_from"],'time_to' => $row["time_to"],'description' => $row["description"]);
        $i += 1;
      }
     return $array;
      
      
    } else{
      echo "Error Fetching from database";
    }
    $conn->close();
}

?>