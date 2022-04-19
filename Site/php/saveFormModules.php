<?php
include 'conn.php';
$dbData = json_decode($_REQUEST['q'], true);
echo print_r($dbData);



?>