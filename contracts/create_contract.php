<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

$contract_number = $_POST['contract_number'];
$contract_start = $_POST['contract_start'];
$contract_end = $_POST['contract_end'];

// Проверка наличия контракта в базе данных
$result = mysqli_query($conn, "SELECT * FROM CONTRACTS WHERE CONTRACT_NUMBER = '$contract_number'");
if (mysqli_num_rows($result) > 0) {
    echo "Ошибка: Контракт '$contract_number' уже существует в базе данных.";
    header("Location: create_job_form.php"); // Перенаправление обратно на форму
    exit();
}

// Вставка новой записи, если контракта нет в базе
if (mysqli_query($conn, "INSERT INTO CONTRACTS (ID, CONTRACT_NUMBER, START_CONTRACT, END_CONTRACT) VALUES (NULL, '$contract_number', '$contract_start', '$contract_end')")) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . mysqli_error($conn);
}

$conn->close();
header("Location: ../../contract.php");
?>