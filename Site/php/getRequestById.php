<?php
    include 'conn.php';
    $id = mysqli_real_escape_string($conn, $_REQUEST['q']);
    $sql ="SELECT Requests.*, CONCAT(Users.First_Name, ' ', Users.Surname) AS Username 
    FROM Requests 
    LEFT JOIN Users ON Users.Id = Requests.User_Id
    WHERE Requests.Id = \"$id\"";
    

    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()){
    $request = array(
        'Id'=>$row['Id'],
        'User_Id'=>$row['User_Id'],
        'Type'=>$row['Type'],
        'Description'=>$row['Description'],
        'Status'=>$row['Status'],
        'Username'=>$row['Username']
    );}
    echo json_encode($request);
?>