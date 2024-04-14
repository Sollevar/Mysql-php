<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание сотрудника</title>
    <link rel="stylesheet" href="kkk.css">
    <script defer src="llll.js"></script>
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
    <a href="index.php" class="floating-button form-btn">Вернуться на главную</a>
            <div class="person__add">
                <h2 class="title-h2">Добавить сотрудника</h2>
                <form class='form-add' action="create.php" method="post">
                    <label for="name">
                        Имя
                        <input type="text" name="name" id="name" placeholder="Введите имя" require>
                    </label>
                    <label for="surname">
                        Фамилия
                        <input type="text" name="surname" id="surname" placeholder="Введите Фамилию" require>
                    </label>
                    <label for="lastname">
                        Отчество
                        <input type="text" name="lastname" id="lastname" placeholder="Введите Отчество" require>
                    </label>
                    <label for="birthdate">
                        Дата рождения
                        <input type="date" name="birthdate" id="birthdate" placeholder="Введите Дату рождения" require>
                    </label>
                    <label for="job">
                        Должность
                        <select name="job_in_database" id="job_in_database" class="select-css">
                        <option id="job_database" value="" selected>Выберите должность</option>
                        <?php
                            $jobs = mysqli_query($conn,"SELECT JOB_NAME FROM `JOB_POSITION`");
                            $jobs = mysqli_fetch_all($jobs);
                            foreach($jobs as $job){
                                ?>
                                  <option id="job_database"  value="<?php echo $job[0]; ?>"><?=$job[0] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        Новая должность
                        <input type="text" name="job" id="job" placeholder="Должность">
                        <input type="number" name="salary" id="salary"  placeholder="Заработная плата">
                    </label>
                    <label for="dep">
                        Отдел
                        <select name="dep_in_database" id="dep_in_database" class="select-css">
                        <option id="dep_database" value="" selected>Выберите отдел</option>
                    <?php
                            $deps = mysqli_query($conn,"SELECT DEP_NAME FROM `DEPARTAMENT`");
                            $deps = mysqli_fetch_all($deps);
                            foreach($deps as $dep){
                                ?>
                                  <option value="<?php echo $dep[0]; ?>"><?=$dep[0] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        Новый отдел
                        <input type="text" name="dep" id="dep" placeholder="Отдел">
                    </label>
                    <label for="contract_number">
                        Контракт
                        <input type="number" name="contract_number" placeholder="Номер контракта">
                        Начало контракта
                        <input type="date" name="contract_start">
                        Конец контракта
                        <input type="date" name="contract_end">
                    </label>
                    <label for="contragent">
                        Компания
                    <select name="contragent_in_database" id="contragent_in_database" class="select-css">
                    <option id="contragent_database" value="" selected>Выберите Компанию</option>
                            <?php
                            $contragents = mysqli_query($conn,"SELECT COMPANY_NAME FROM `CONTRAGENTS`");
                            $contragents = mysqli_fetch_all($contragents);
                            foreach($contragents as $contragent){
                                ?>
                                  <option value="<?php echo $contragent[0]; ?>"><?=$contragent[0] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <br>
                        <input type="text" name="contragent_type" id="contragent_type"  placeholder="Тип компании">
                        <input type="text" name="contragent_name" id="contragent_name" placeholder="Название компании">
                        <input type="text" name="contragent_addr" id="contragent_addr" placeholder="Адрес компании">
                    </label>
                    <button type="submit" class="floating-button btn-submit">Добавить работника</button>
                </form>
        </div> 
    </div>   
</body>
</html>