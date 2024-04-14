<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM `CONTRACTS` WHERE `ID` = '$id'");
header('Location: ../../contract.php');
?>