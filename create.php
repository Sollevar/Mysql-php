<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
// ФИО + дата рождения
$name = $_POST['name'];
$name = trim($name);
$name = ucfirst(strtolower($name));
$surname = $_POST['surname'];
$surname = trim($surname);
$surname = ucfirst(strtolower($surname));
$lastname = $_POST['lastname'];
$lastname = trim($lastname);
$lastname = ucfirst(strtolower($lastname));
$birthdate = $_POST['birthdate']; 
// Должность
$job_new = $_POST['job'];
$job_new = trim($job_new);
$job_new = ucfirst(strtolower($job_new));
$salary = $_POST['salary'];
$job_old = $_POST['job_in_database'];
// Отдел
$dep_old = $_POST['dep_in_database'];
$dep_new = $_POST['dep'];
$dep_new = trim($dep_new);
$dep_new = ucfirst(strtolower($dep_new));
// Контракт
$contract_number = $_POST['contract_number'];
$contract_start = $_POST['contract_start'];
$contract_end = $_POST['contract_end'];
// Компания
$contragent_old = $_POST['contragent_in_database'];
$contragent_type = $_POST['contragent_type'];
$contragent_type = trim($contragent_type);
$contragent_type = strtoupper($contragent_type);
$contragent_name = $_POST['contragent_name'];
$contragent_name = trim($contragent_name);
$contragent_name = ucfirst(strtolower($contragent_name));
$contragent_addr = $_POST['contragent_addr'];



if($job_new){
    $sql = "INSERT INTO `JOB_POSITION` (`ID`, `JOB_NAME`, `SALARY`) VALUES (NULL, '$job_new', '$salary')";
    if ($conn->query($sql) === TRUE) {
        $new_job_id = $conn->insert_id; 
    }
}

if($job_old){
    $sql = "SELECT ID FROM JOB_POSITION WHERE JOB_NAME = '$job_old'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Рабочее место найдено, получение ID
        $row = $result->fetch_assoc();
        $existing_job_id = $row["ID"];
    } 
}

if($dep_old){
    $sql = "SELECT ID FROM DEPARTAMENT WHERE DEP_NAME = '$dep_old'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // отдел найден, получение ID
        $row = $result->fetch_assoc();
        $existing_dep_id = $row["ID"];
    } 
}

if($dep_new){
    $sql = "INSERT INTO `DEPARTAMENT` (`ID`, `DEP_NAME`) VALUES (NULL, '$dep_new')";
    if ($conn->query($sql) === TRUE) {
        $new_dep_id = $conn->insert_id; 
    }
}

if($contract_number){
    $sql = "INSERT INTO `CONTRACTS` (`ID`, `CONTRACT_NUMBER`, `START_CONTRACT`, `END_CONTRACT`) VALUES (NULL, '$contract_number', '$contract_start', '$contract_end')";
    if ($conn->query($sql) === TRUE) {
        $contract_id = $conn->insert_id; 
    }
}

if($contragent_old){
    $sql = "SELECT ID FROM CONTRAGENTS WHERE COMPANY_NAME = '$contragent_old'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // компания найдена, получение ID
        $row = $result->fetch_assoc();
        $existing_contragent_id = $row["ID"];
    } 
}

if($contragent_name){
    $sql = "INSERT INTO `CONTRAGENTS` (`ID`, `CONTRAGENT_TYPE`, `COMPANY_NAME`, `ADDRES`) VALUES (NULL, '$contragent_type', '$contragent_name', '$contragent_addr')";
    if ($conn->query($sql) === TRUE) {
        $new_contragent_id = $conn->insert_id; 
    }
}


$job_id = isset($new_job_id) ? $new_job_id : $existing_job_id;
$dep_id = isset($new_dep_id) ? $new_dep_id : $existing_dep_id;
$contragent_id = isset($new_contragent_id) ? $new_contragent_id : $existing_contragent_id;

mysqli_query($conn, "INSERT INTO `PERSONS` (`ID`, `NAME`, `SURNAME`, `LASTNAME`, `BIRTHDATE`, `JOB_POSITION_ID`, `DEPARTAMENT_ID`, `CONTRACT_ID`, `CONTRAGENT_ID`) VALUES (NULL, '$name', '$surname', '$lastname', '$birthdate', '$job_id', '$dep_id', '$contract_id', '$contragent_id')");



header('Location: /');
?>