<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

$contragent_type = $_POST['contr_type'];
$contragent_type = trim($contragent_type);
$contragent_type = strtoupper($contragent_type);
$contragent_name = $_POST['contr_name'];
$contragent_name = trim($contragent_name);
$contragent_name = ucfirst(strtolower($contragent_name));
$contragent_addr = $_POST['contr_addr'];

// Проверка наличия должности в базе данных
$result = mysqli_query($conn, "SELECT * FROM CONTRAGENTS WHERE COMPANY_NAME = '$contragent_name'");
if (mysqli_num_rows($result) > 0) {
    echo "Ошибка: Компания '$contragent_name' уже существует в базе данных.";
    header("Location: create_contr_form.php"); // Перенаправление обратно на форму
    exit();
}

// Вставка новой записи, если должности нет в базе
if (mysqli_query($conn, "INSERT INTO CONTRAGENTS (ID, CONTRAGENT_TYPE, COMPANY_NAME, ADDRES) VALUES (NULL, '$contragent_type', '$contragent_name', '$contragent_addr')")) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . mysqli_error($conn);
}

$conn->close();
header("Location: ../../contragent.php");
?>