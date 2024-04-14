<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

if (isset($_GET['id'])) {
    $dep_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT ID, DEP_NAME FROM `DEPARTAMENT`
        WHERE ID = ?");
    
    $stmt->bind_param("i", $dep_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Обработка результата
        // Вывод формы для изменения данных сотрудника
    } else {
        echo "Сотрудник с ID $dep_id не найден.";
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
    <title>Update departament</title>
    <link rel="stylesheet" href="../kkk.css">
    <script defer src="llll.js"></script>
</head>
<body>
    <div class="container">
    <h2 class="title-h2">Изменить данные отдела</h2>
    <a href="../index.php" class="floating-button form-btn">Вернуться на главную</a>
    <form class='form-add' action="update_dep.php" method="post">
        <input type="hidden" name="id" value="<?= $row['ID']?>">
        <label for="dep">
            Отдел
            <input type="text" name="dep" id="dep" value="<?= $row['DEP_NAME']?>">
        </label>
        <button type="submit" class="floating-button form-btn">Изменить данные</button>
    </form>
    </div>
</body>
</html>