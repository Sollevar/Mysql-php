<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание должности</title>
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
                <h2 class="title-h2">Добавить должность</h2>
                <form class='form-add' action="create_job.php" method="post">
                    <label for="job">
                        Название должности
                        <input type="text" name="job" id="job" placeholder="Введите должность" require>
                    </label>
                    <label for="salary">
                        Заработная плата
                        <input type="number" name="salary" id="salary" placeholder="Введите заработную плату" require>
                    </label>
                    <button type="submit" class="floating-button btn-submit">Добавить должность</button>
                </form>
        </div> 
    </div>   
</body>
</html>