<?php

require_once "conn.php";


$firstname = mysqli_real_escape_string($conn, $_REQUEST['firstname']);
$surname = mysqli_real_escape_string($conn, $_REQUEST['surname']);
$title = mysqli_real_escape_string($conn, $_REQUEST['title']);
$gender = mysqli_real_escape_string($conn, $_REQUEST['gender']);
$dob = mysqli_real_escape_string($conn, $_REQUEST['dob']);
$nextofkin = mysqli_real_escape_string($conn, $_REQUEST['nextofkin']);
$privatemeail = mysqli_real_escape_string($conn, $_REQUEST['privateemail']);
$tel = mysqli_real_escape_string($conn, $_REQUEST['tel']);

$housenumber = mysqli_real_escape_string($conn, $_REQUEST['housenumber']);
$street = mysqli_real_escape_string($conn, $_REQUEST['street']);
$postcode = mysqli_real_escape_string($conn, $_REQUEST['postcode']);

$role = mysqli_real_escape_string($conn, $_REQUEST['role']);
$progamme = mysqli_real_escape_string($conn, $_REQUEST['programme']);
$level = mysqli_real_escape_string($conn, $_REQUEST['level']);
$uniemail = mysqli_real_escape_string($conn, $_REQUEST['uniemail']);
$formuid = mysqli_real_escape_string($conn, $_REQUEST['userid']);
$requestType = $_POST['btSubmit'];
if ($requestType == "Add") {//<<<<<<<<< ADD Code Here

if ($role == "Undergraduate Student")
{
    $userold = mysqli_query($conn, "SELECT * FROM users
    WHERE users.Id LIKE 'S%'
    ORDER BY Id DESC LIMIT 1;");
    $row = $userold->fetch_assoc();
    $userold = $row['Id'];
    $userold = print_r($userold, true);
    $usernew = ltrim($userold, 'S');
    
    
}
else
{
    $userold = mysqli_query($conn, "SELECT * FROM users
    WHERE users.Id NOT LIKE 'S%' AND LENGTH(users.Id) = 13
    ORDER BY Id DESC LIMIT 1;");
       $row = $userold->fetch_assoc();
       $userold = $row['Id'];
    $userold = print_r($userold, true);
    $usernew = ltrim($userold, 'S');
}

$Suser = $usernew + 1;

$s = "S";
if ($role == "Undergraduate Student")
{
    $user = $s.=$Suser;
}
else
{
    $user = $Suser;
}
$domain = "@mail.glyndwr.ac.uk";
$uniemail = $user.$domain;
$sqlusers = "INSERT INTO users (Id, First_Name, Surname, Title, Gender, Birth_Date, Priv_Email, Uni_Email, Telephone, Next_Of_Kin, Street_Number, Street_Name, Postcode) VALUES ('$user', '$firstname', '$surname', '$title', '$gender', '$dob', '$privatemeail', '$uniemail', '$tel', '$nextofkin', '$housenumber', '$street', '$postcode')";
mysqli_query($conn, $sqlusers);

$sqluserid = "SELECT * FROM users WHERE Id='$user'";
$userid = mysqli_query($conn, $sqluserid);

$sqlprogrammeid = "SELECT * FROM programmes WHERE Name='$progamme'";
$progammeid = mysqli_query($conn, $sqlprogrammeid);
$row = $userid->fetch_assoc();
$userid = $row['Id'];
$row = $progammeid->fetch_assoc();
$programmeid = $row['Id'];
$sqlenrol = "INSERT INTO student_enrolment (Id, Student, Programme, Date_Enrolled, Date_Finished) VALUES (NULL, '$userid', '$programmeid', NOW(), NULL)";
mysqli_query($conn, $sqlenrol);

header("location: ../admin_users.php");
}else if($requestType == "Delete"){//<<<<<<<<<Delete code here

$sqldelete = "DELETE FROM users WHERE Id='$formuid'";

$conn->query($sqldelete);




}else if($requestType == "Update"){//<<<<<<<<<Update code here


$sqlprogramme = "SELECT Id FROM progammes WHERE Name='$progamme'";
$programmeResult = $conn->query($sqlprogramme);

$sqluser = "UPDATE users SET First_Name='$firstname', Surname='$surname', Title='$title', Gender='$gender', Birth_Date='$dob', Priv_Email='$privatemeail', Uni_Email='$uniemail', Telephone='$tel', Next_Of_Kin='$nextofkin', Street_Number='$housenumber', Street_Name='$street', Postcode='$postcode' WHERE Id='$formuid'";
$conn->query($sqluser);

$sqlenrolment = "UPDATE student_enrolment SET Programme='$programmeResult', Date_Enrolled=NOW() WHERE Student='$formuid'";
$conn->query($sqlenrolment);

header("location: ../admin_users.php");

}else if($requestType == "Reset Password"){

}else if($requestType == "Default Settings"){
    
}
?>