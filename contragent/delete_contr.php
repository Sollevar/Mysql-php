<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM `CONTRAGENTS` WHERE `ID` = '$id'");
header('Location: ../../contragent.php');
?>