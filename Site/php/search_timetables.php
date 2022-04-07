<?php 
//$type =$_POST['type'];
//$text =$_POST['text'];

//if($type == "programme"){
 //fetchProgrammes($text);
//}



    include 'conn.php';
    $sql = "SELECT * FROM programmes";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $array = null;
        $i = 0;
        while ($row = $result->fetch_assoc()) {
          $array[$i] = array(
            'name' => $row["Name"],
            'degree' => $row["Degree"],
            'department' => $row["Department"],
            'level' => $row["Level"],
            'type' => $row["Type"],
            'start_date' => $row["Start_Date"],
            'end_date' => $row["End_Date"],
            'description' => $row["Description"],
          );
          $i += 1;
        }
    } else {
        echo "0 results";
    }
    //return $array;
    $q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  echo "<table><tr><th>Degree</th><th>Name</th><th>Level</th><th>Type</th></tr>";
  for ($i=0; $i < count($array); $i++) { 
    if (stristr($q, substr($array[$i]['name'], 0, $len))) {
       echo "<tr><td>{$array[$i]['degree']}</td><td>{$array[$i]['name']}</td><td>{$array[$i]['level']}</td><td>{$array[$i]['type']}</td></tr>";
        /* $hint = [];
        array_push($hint, $array[$i]);*/
      /*if ($hint === "") {
        $hint = $array[$i]['name'];
      } else {
        $hint .= ", $array[$i]['name']";
      }*/
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values


?>
