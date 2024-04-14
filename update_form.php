<?php
$conn = new mysqli("localhost", "root", "", "databaseSBD");

if (isset($_GET['id'])) {
    $person_id = $_GET['id'];

    $stmt = $conn->prepare("SELECT P.ID, P.NAME, P.SURNAME, P.LASTNAME, P.BIRTHDATE, J.JOB_NAME, D.DEP_NAME, C.CONTRACT_NUMBER, CONTR.COMPANY_NAME  
        FROM PERSONS P 
        LEFT JOIN JOB_POSITION J ON P.JOB_POSITION_ID = J.ID 
        LEFT JOIN DEPARTAMENT D ON P.DEPARTAMENT_ID = D.ID 
        LEFT JOIN CONTRACTS C ON P.CONTRACT_ID = C.ID 
        LEFT JOIN CONTRAGENTS CONTR ON P.CONTRAGENT_ID = CONTR.ID
        WHERE P.ID = ?");
    
    $stmt->bind_param("i", $person_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Обработка результата
        // Вывод формы для изменения данных сотрудника
    } else {
        echo "Сотрудник с ID $person_id не найден.";
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
    <title>Update Persons</title>
    <link rel="stylesheet" href="kkk.css">
    <script defer src="llll.js"></script>
</head>
<body>
    <div class="container">
    <h2 class="title-h2">Изменить данные сотрудника</h2>
    <a href="index.php" class="floating-button form-btn">Вернуться на главную</a>
    <form class='form-add' action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $row['ID']?>">
        <label for="name">
            Имя
            <input type="text" name="name" id="name" value="<?= $row['NAME']?>">
        </label>
        <label for="surname">
            Фамилия
            <input type="text" name="surname" id="surname" value="<?= $row['SURNAME']?>">
        </label>
        <label for="lastname">
            Отчество
            <input type="text" name="lastname" id="lastname" value="<?= $row['LASTNAME']?>">
        </label>
        <label for="birthdate">
           Дата рождения
            <input type="date" name="birthdate" id="birthdate" value="<?= $row['BIRTHDATE']?>">
        </label>
        <div class="current_job">Текущая должность:<?= $row['JOB_NAME']?></div>
        <label for="job">
                        Должность
                        <select name="job_in_database" id="job_in_database"  class="select-css">
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
                    <div class="current_job">Текущий отдел:<?= $row['DEP_NAME']?></div>
                    <label for="dep">
                        Отдел
                        <select name="dep_in_database" id="dep_in_database"  class="select-css">
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
                    <div class="current_job">Текущий номер контракта:<?= $row['CONTRACT_NUMBER']?></div>
                    <label for="contract_number">
                        Контракт
                        <input type="number" name="contract_number" placeholder="Номер контракта">
                        Начало контракта
                        <input type="date" name="contract_start">
                        Конец контракта
                        <input type="date" name="contract_end">
                    </label>
                    <div class="current_job">Текущая компания: <?= $row['COMPANY_NAME']?></div>
                    <label for="contragent">
                        Компания
                    <select name="contragent_in_database" id="contragent_in_database"  class="select-css">
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
        
        <button type="submit" class="floating-button form-btn">Изменить данные</button>
    </form>
    </div>
</body>
</html>