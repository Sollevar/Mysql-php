<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD");  
$id = $_POST['id']; 
$dep = $_POST['dep']; 
$dep = trim($dep); 
$dep = ucfirst(strtolower($dep)); 


$sql = "UPDATE DEPARTAMENT SET ";


if (!empty($dep)) {
    $sql .= "DEP_NAME = '$dep', ";
}


// Удаление последней запятой и пробела
$sql = rtrim($sql, ", ");

// Добавление условия WHERE
$sql .= " WHERE `ID` = '$id'";

mysqli_query($conn, $sql);
header('Location: ../department.php'); 

?>