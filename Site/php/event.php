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

$programmeStart = null;
$programmeEnd = null;
$holidays = null;
$errors = array();
$count = 0;
if($group == "None"){$group = null;};
if($sButton == "Save"){
if($radio == "Session"){
    if($rec == "Once"){//Single event
        $sql = "INSERT INTO Events VALUES (
            NULL,
            \"$id\",
            \"$room\",
            \"$type\",
            \"$date\",
            \"$timeFrom\",
            \"$timeTo\",
            \"$desc\",
            $group
        )";
        $result = $conn->query($sql);
        if($result){$count++;}else if (!$result){array_push($errors, "Failed to create single session event");}
    }else{//recurring event
        //get start and end date of this module's semester
        $sql="SELECT Semesters.Start_Date, Semesters.End_Date FROM
        Semesters LEFT JOIN Module_Assignment ON Semesters.Id = Module_Assignment.Semester 
        WHERE Module_Assignment.Module = \"$id\"";
        $result = $conn->query($sql);
        if($result ->num_rows >0){
            $row = $result->fetch_assoc();
            $programmeStart = $row['Start_Date'];
            $programmeEnd = $row['End_Date'];
        }else{array_push($errors, "Unable to get programme details for selected module!");}
        //Get Holidays info
        $sql = "SELECT * FROM Holidays";
        $result = $conn->query($sql);
        if($result ->num_rows >0){
            $i = 0;
            while ($row = $result->fetch_assoc()){
                 $holidays[$i] = array(
                     'Name'=>$row['Name'],
                     'Date_From'=>$row['Date_From'],
                     'Date_To'=>$row['Date_To']
                 );
                $i++;
            }
        }else{array_push($errors, "Unable to get academic holidays.");}
        $tempDate = $date;
     
        do {//Loop for recurring events
            //check if date falls into academic holidays
            $inHolidays = false;
            if(count($holidays) > 0){
            for ($i=0; $i < count($holidays); $i++) { 
                if($tempDate >= $holidays[$i]['Date_From'] && $tempDate <= $holidays[$i]['Date_To']){
                    $inHolidays = true;
                    break;
                }
            }}
            if($inHolidays){
            $tempDate = strtotime($tempDate);
            $tempDate = strtotime("+1 week", $tempDate);
            $tempDate = date('Y-m-d', $tempDate);
                continue;

            }else{
                $sql = "INSERT INTO Events VALUES (
                    NULL,
                    \"$id\",
                    \"$room\",
                    \"$type\",
                    \"$tempDate\",
                    \"$timeFrom\",
                    \"$timeTo\",
                    \"$desc\",
                    $group
                )";
                $result = $conn->query($sql);
                if($result){$count++;}else if (!$result){array_push($errors, "Failed to create recurring session event on $tempDate");}

            }
            //Set the next date next week
           $tempDate = strtotime($tempDate);
           $tempDate = strtotime("+1 week", $tempDate);
           $tempDate = date('Y-m-d', $tempDate);
        } while ($tempDate < $programmeEnd);
    }
}else if($radio == "User Event"){
    $sql = "INSERT INTO User_Events VALUES (
    NULL,
    \"$id\",
    \"$name\",
    \"$date\",
    \"$timeFrom\",
    \"$timeTo\",
    \"$desc\"
    )";
$result = $conn->query($sql);
if (!$result){array_push($errors, "Failed to create user event on $date");}

}



}else if($sButton == "Delete"){
    if($radio == "User Event"){
        $sql="DELETE FROM User_Events WHERE
        User = \"$id\" AND
        Name = \"$name\" AND
        Date = \"$date\" AND
        Time_From = \"$timeFrom\" AND
        Time_To = \"$timeTo\"";
        $result = $conn->query($sql);
        if (!$result){array_push($errors, "Failed to delete user event on $date");}
    }else{//session

        if($rec == "Once"){
            $sql="DELETE FROM Events WHERE
            Module = \"$id\" AND
            Type = \"$type\" AND
            Date = \"$date\" AND
            Time_From = \"$timeFrom\" AND
            Time_To = \"$timeTo\"";
            $result = $conn->query($sql);
            if (!$result){array_push($errors, "Failed to delete session event on $date");}
            
        }else{
            $sql = "DELETE FROM Events WHERE
            Module = \"$id\" AND
            Type = \"$type\" AND
            Time_From = \"$timeFrom\" AND
            Time_To = \"$timeTo\"";
             $result = $conn->query($sql);
             if (!$result){array_push($errors, "Failed to delete multiple sessios of $id");}else{echo "Succesfully deleted multiple events";}
        }

    }

 

}
if(count($errors) > 0){
    //echo "<script type=\"text/javascript\"> alert(\"Errors: $errors)\")</script>";
}
if($count > 0){
   // echo "<script type=\"text/javascript\"> alert(\"succesfully created $count events\"); window.location.assign(../admin_events.php);</script>";

}
header("location: ../admin_events.php");


?>