<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM `PERSONS` WHERE `PERSONS`.`ID` = '$id'");
header('Location: /');
?>