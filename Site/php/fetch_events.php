<?php 
function fetchEvents() {
    include 'conn.php';
    $sql = "SELECT id, event_name, date_booked, description, artist, time_from, time_to FROM events WHERE YEAR(date_booked) like YEAR(NOW())";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      $array = null;
      $i = 0;
      while($row = $result->fetch_assoc()) {//separate outputs with for loop?
        $array[$i]= array('id' => $row["id"], 'event_name' => $row["event_name"], 'date_booked' => $row["date_booked"], 'description' => $row["description"], 'artist' => $row["artist"],'time_from' => $row["time_from"],'time_to' => $row["time_to"]);
        $i += 1;
      }
     return $array;
      
      
    } else{
      echo "Error Fetching from database";
    }
    $conn->close();
}

?>