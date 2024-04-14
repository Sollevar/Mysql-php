<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM `DEPARTAMENT` WHERE `ID` = '$id'");
header('Location: ../../department.php');
?>