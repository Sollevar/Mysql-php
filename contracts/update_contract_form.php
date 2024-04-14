<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

if (isset($_GET['id'])) {
    $contracts_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT ID, CONTRACT_NUMBER, START_CONTRACT, END_CONTRACT FROM `CONTRACTS`
        WHERE ID = ?");
    
    $stmt->bind_param("i", $contracts_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Обработка результата
        // Вывод формы для изменения данных сотрудника
    } else {
        echo "Сотрудник с ID $contracts_id не найден.";
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
    <title>Update contract</title>
    <link rel="stylesheet" href="../kkk.css">
    <script defer src="llll.js"></script>
</head>
<body>
    <div class="container">
    <h2 class="title-h2">Изменить данные контракта</h2>
    <a href="../index.php" class="floating-button form-btn">Вернуться на главную</a>
    <form class='form-add' action="update_contract.php" method="post">
        <input type="hidden" name="id" value="<?= $row['ID']?>">
        <label for="contract_number">
            Номер контракта
            <input type="number" name="contract_number" id="contract_number" value="<?= $row['CONTRACT_NUMBER']?>">
        </label>
        <label for="contract_start">
            Начало контракта
            <input type="date" name="contract_start" id="contract_start" value="<?= $row['START_CONTRACT']?>">
        </label>
        <label for="contract_end">
            Конец контракта
            <input type="date" name="contract_end" id="contract_end" value="<?= $row['END_CONTRACT']?>">
        </label>
        <button type="submit" class="floating-button form-btn">Изменить данные</button>
    </form>
    </div>
</body>
</html>