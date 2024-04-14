<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD");  
$id = $_POST['id']; 
$contragent_type = $_POST['contr_type'];
$contragent_type = trim($contragent_type);
$contragent_type = strtoupper($contragent_type);
$contragent_name = $_POST['contr_name'];
$contragent_name = trim($contragent_name);
$contragent_name = ucfirst(strtolower($contragent_name));
$contragent_addr = $_POST['contr_addr'];


$sql = "UPDATE CONTRAGENTS SET ";


if (!empty($contragent_type)) {
    $sql .= "CONTRAGENT_TYPE = '$contragent_type', ";
}


if (!empty($contragent_name)) {
    $sql .= "COMPANY_NAME = '$contragent_name', ";
}

if (!empty($contragent_addr)) {
    $sql .= "ADDRES = '$contragent_addr', ";
}


// Удаление последней запятой и пробела
$sql = rtrim($sql, ", ");

// Добавление условия WHERE
$sql .= " WHERE `ID` = '$id'";

mysqli_query($conn, $sql);
header('Location: ../contragent.php'); 

?>