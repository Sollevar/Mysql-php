<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD");  
$id = $_POST['id']; 
$job_new = $_POST['job']; 
$job_new = trim($job_new); 
$job_new = ucfirst(strtolower($job_new)); 
$salary = $_POST['salary']; 


$sql = "UPDATE JOB_POSITION SET ";


if (!empty($job_new)) {
    $sql .= "JOB_NAME = '$job_new', ";
}


if (!empty($salary)) {
    $sql .= "SALARY = '$salary', ";
}


// Удаление последней запятой и пробела
$sql = rtrim($sql, ", ");

// Добавление условия WHERE
$sql .= " WHERE `ID` = '$id'";

mysqli_query($conn, $sql);
header('Location: ../job.php'); 

?>