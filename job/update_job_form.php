<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

if (isset($_GET['id'])) {
    $job_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT ID, JOB_NAME, SALARY FROM `JOB_POSITION`
        WHERE ID = ?");
    
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Обработка результата
        // Вывод формы для изменения данных сотрудника
    } else {
        echo "Сотрудник с ID $job_id не найден.";
    }

    $stmt->close();
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update jobs</title>
    <link rel="stylesheet" href="../kkk.css">
    <script defer src="llll.js"></script>
</head>
<body>
    <div class="container">
    <h2 class="title-h2">Изменить данные должности</h2>
    <a href="../index.php" class="floating-button form-btn">Вернуться на главную</a>
    <form class='form-add' action="update_job.php" method="post">
        <input type="hidden" name="id" value="<?= $row['ID']?>">
        <label for="job">
            Должность
            <input type="text" name="job" id="job" value="<?= $row['JOB_NAME']?>">
        </label>
        <label for="salary">
            Заработная плата
            <input type="number" name="salary" id="salary" value="<?= $row['SALARY']?>">
        </label>
        <button type="submit" class="floating-button form-btn">Изменить данные</button>
    </form>
    </div>
</body>
</html>