<?php
try{
  $db = new PDO('mysql:host=localhost;dbname=nazwa_bazy', 'nazwa_uzytkownika', 'haslo_do_bazy');
}
catch (PDOException $e){
  die ("Error connecting to database!");
}
