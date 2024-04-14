<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание компании</title>
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
                <h2 class="title-h2">Добавить компанию</h2>
                <form class='form-add' action="create_contr.php" method="post">
                    <label for="contr_type">
                        Тип компании
                        <input type="text" name="contr_type" id="contr_type" placeholder="Введите тип компании" require>
                    </label>
                    <label for="contr_name">
                        Название компании
                        <input type="text" name="contr_name" id="contr_name" placeholder="Введите название компании" require>
                    </label>
                    <label for="contr_addr">
                        Адрес компании
                        <input type="text" name="contr_addr" id="contr_addr" placeholder="Введите адрес компании" require>
                    </label>
                    <button type="submit" class="floating-button btn-submit">Добавить должность</button>
                </form>
        </div> 
    </div>   
</body>
</html>