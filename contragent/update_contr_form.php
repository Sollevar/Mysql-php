<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

if (isset($_GET['id'])) {
    $contr_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT ID, CONTRAGENT_TYPE, COMPANY_NAME, ADDRES FROM `CONTRAGENTS`
        WHERE ID = ?");
    
    $stmt->bind_param("i", $contr_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Обработка результата
        // Вывод формы для изменения данных сотрудника
    } else {
        echo "Сотрудник с ID $contr_id не найден.";
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
    <title>Update contragent</title>
    <link rel="stylesheet" href="../kkk.css">
    <script defer src="llll.js"></script>
</head>
<body>
    <div class="container">
    <h2 class="title-h2">Изменить данные должности</h2>
    <a href="../index.php" class="floating-button form-btn">Вернуться на главную</a>
    <form class='form-add' action="update_contr.php" method="post">
        <input type="hidden" name="id" value="<?= $row['ID']?>">
        <label for="contr_type">
            Тип компании
            <input type="text" name="contr_type" id="contr_type" value="<?= $row['CONTRAGENT_TYPE']?>">
        </label>
        <label for="contr_name">
            Название компании
            <input type="text" name="contr_name" id="contr_name" value="<?= $row['COMPANY_NAME']?>">
        </label>
        <label for="contr_addr">
            Адрес компании
            <input type="text" name="contr_addr" id="contr_addr" value="<?= $row['ADDRES']?>">
        </label>
        <button type="submit" class="floating-button form-btn">Изменить данные</button>
    </form>
    </div>
</body>
</html>