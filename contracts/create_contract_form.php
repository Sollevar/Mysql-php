<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание контракта</title>
    <link rel="stylesheet" href="../kkk.css">
    <script defer src="../llll.js"></script>
</head>
<body>
    <div class="container">
    <?php 
        $conn = new mysqli("localhost", "root", "", "databaseSBD"); 
        if($conn->connect_error){ 
            die("Ошибка: " . $conn->connect_error); 
        } 
        echo "<div class='connect'>Подключение успешно установлено</div>"; 
    ?>
    <a href="../index.php" class="floating-button form-btn">Вернуться на главную</a>
            <div class="person__add">
                <h2 class="title-h2">Добавить контракт</h2>
                <form class='form-add' action="create_contract.php" method="post">
                    <label for="contract_number">
                        Номер контракта
                        <input type="number" name="contract_number" id="contract_number" placeholder="Введите номер контракта" require>
                    </label>
                    <label for="contract_start">
                       Начало контракта
                        <input type="date" name="contract_start" id="contract_start" placeholder="Введите дату начала контракта" require>
                    </label>
                    <label for="contract_end">
                       Конец контракта
                        <input type="date" name="contract_end" id="contract_end" placeholder="Введите дату конца контракта" require>
                    </label>
                    <button type="submit" class="floating-button btn-submit">Добавить контракт</button>
                </form>
        </div> 
    </div>   
</body>
</html>