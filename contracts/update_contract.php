<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD");  
$id = $_POST['id']; 
$contract_number = $_POST['contract_number'];
$contract_start = $_POST['contract_start'];
$contract_end = $_POST['contract_end'];



$sql = "UPDATE CONTRACTS SET ";


if (!empty($contract_number)) {
    $sql .= "CONTRACT_NUMBER = '$contract_number', ";
}


if (!empty($contract_start)) {
    $sql .= "START_CONTRACT = '$contract_start', ";
}

if (!empty($contract_end)) {
    $sql .= "END_CONTRACT = '$contract_end', ";
}



// Удаление последней запятой и пробела
$sql = rtrim($sql, ", ");

// Добавление условия WHERE
$sql .= " WHERE `ID` = '$id'";

mysqli_query($conn, $sql);
header('Location: ../contract.php'); 

?>