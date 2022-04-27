<?php 
include 'conn.php';
$type = mysqli_real_escape_string($conn, $_REQUEST['type']);
//$location = mysqli_real_escape_string($conn, $_REQUEST['location']);
//$name = mysqli_real_escape_string($conn, $_REQUEST['name']);



 //Creates XML string and XML document using the DOM 
 $dom = new DomDocument('1.0', 'UTF-8'); 

 //add root == secElement
 $prElement = null;
 $secElement = null;
$sql =null;
if ($type == "Programmes") {
    $programmes = null;
    $sql= "SELECT * FROM Programmes";
    $result = $conn->query($sql);
    $i = 0;
    if ($result->num_rows > 0){
        while ($row = mysqli_fetch_array($result)) {
            $programmes[$i] = array(
            'Id' => $row["Id"],
            'Name' => $row["Name"],
            'Degree' => $row["Degree"],
            'Department' => $row["Department"],
            'Level' => $row["Level"],
            'Start_Date' => $row["Start_Date"],
            'End_Date' => $row["End_Date"],
            'Description' => $row["Description"],
            'Type' => $row["Type"]
            );
            
            $sql ="SELECT Modules.* FROM Modules
            LEFT JOIN Module_Assignment ON Module_Assignment.Module = Modules.Id
            WHERE Module_Assignment.Programme = \"{$programmes[$i]['Id']}\"";
            
               $result2 = $conn->query($sql);
               
               if ($result2->num_rows > 0){
                    $j = 0;
                   while ($row2 = mysqli_fetch_array($result2)) {
                    $programmes[$i][$j] = array(
                        'Id' => $row2["Id"],
                        'Name' => $row2["Name"],
                        'Description' => $row2["Description"],
                        'Moodle_Link' => $row2["Moodle_Link"]);
                    $j++;
                   }
                }else{
                    $programmes[$i][0] = null;
                }
                $i++;
        }
        //echo "----------------------------",print_r($programmes);
        
        $prElement = $dom->appendChild($dom->createElement('Programmes'));
        
        
        for ($i = 0; $i < count($programmes); $i++) {
            //add programme element to secElement
            $programme = $dom->createElement('programme');
            $prElement->appendChild($programme);
       
            // Appending attributes to programme
            $attr = $dom->createAttribute('Id');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Id']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Name');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Name']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Degree');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Degree']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Department');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Department']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Level');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Level']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Start_Date');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Start_Date']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('End_Date');
            $attr->appendChild($dom->createTextNode($programmes[$i]['End_Date']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Description');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Description']));
            $programme->appendChild($attr);
            $attr = $dom->createAttribute('Type');
            $attr->appendChild($dom->createTextNode($programmes[$i]['Type']));
            $programme->appendChild($attr);
            if($programmes[$i][0] != null){//if programme has modules assigned
                
            for ($j=0; $j < count($programmes[$i][0]); $j++) { //add modules to each programme
                $module = $dom->createElement('Module');
                $programme->appendChild($module);
                // Appending attributes to module
                $attr = $dom->createAttribute('Id');
                $attr->appendChild($dom->createTextNode($programmes[$i][$j]['Id']));
                $module->appendChild($attr);
                $attr = $dom->createAttribute('Name');
                $attr->appendChild($dom->createTextNode($programmes[$i][$j]['Name']));
                $module->appendChild($attr);
                $attr = $dom->createAttribute('Description');
                $attr->appendChild($dom->createTextNode($programmes[$i][$j]['Description']));
                $module->appendChild($attr);
                $attr = $dom->createAttribute('Moodle_Link');
                $attr->appendChild($dom->createTextNode($programmes[$i][$j]['Moodle_Link']));
                $module->appendChild($attr);

            }
        }
            //echo print_r($prElement);
        }
       
        $dom->formatOutput = true; // set the formatOutput attribute of domDocument to true
       
        // save XML as string or file 
        $test1 = $dom->saveXML(); // put string in test1
        $dom->save("../XML/Programmes.xml"); // save as file
        exit();
    }




}





 
?>