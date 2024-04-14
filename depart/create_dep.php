<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

$dep = $_POST['dep'];
$dep = trim($dep);
$dep = ucfirst(strtolower($dep));

// Проверка наличия отдела в базе данных
$result = mysqli_query($conn, "SELECT * FROM DEPARTAMENT WHERE DEP_NAME = '$dep'");
if (mysqli_num_rows($result) > 0) {
    echo "Ошибка: Отдела '$dep' уже существует в базе данных.";
    header("Location: create_job_form.php"); // Перенаправление обратно на форму
    exit();
}

// Вставка новой записи, если отдела нет в базе
if (mysqli_query($conn, "INSERT INTO DEPARTAMENT (ID, DEP_NAME) VALUES (NULL, '$dep')")) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . mysqli_error($conn);
}

$conn->close();
header("Location: ../../department.php");
?>