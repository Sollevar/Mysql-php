<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM `JOB_POSITION` WHERE `ID` = '$id'");
header('Location: ../../job.php');
?>