<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

$job_new = $_POST['job'];
$job_new = trim($job_new);
$job_new = ucfirst(strtolower($job_new));
$salary = $_POST['salary'];

// Проверка наличия должности в базе данных
$result = mysqli_query($conn, "SELECT * FROM JOB_POSITION WHERE JOB_NAME = '$job_new'");
if (mysqli_num_rows($result) > 0) {
    echo "Ошибка: Должность '$job_new' уже существует в базе данных.";
    header("Location: create_job_form.php"); // Перенаправление обратно на форму
    exit();
}

// Вставка новой записи, если должности нет в базе
if (mysqli_query($conn, "INSERT INTO JOB_POSITION (ID, JOB_NAME, SALARY) VALUES (NULL, '$job_new', '$salary')")) {
    echo "Данные успешно добавлены в базу данных.";
} else {
    echo "Ошибка: " . mysqli_error($conn);
}

$conn->close();
header("Location: ../../job.php");
?>