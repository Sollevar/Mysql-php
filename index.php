<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="kkk.css">
    <script defer src='main.js'></script>
</head>
<body>
    <div class="container">
    <h2 class='title'>Cписок сотрудников</h2>
    <nav class="nav">
        <ul class="nav__list list-reset">
            <li class="nav__item"><a href="index.php">Работники</a></li>
            <li class="nav__item"><a href="job.php">Должности</a></li>
            <li class="nav__item"><a href="department.php">Отделы</a></li>
            <li class="nav__item"><a href="contragent.php">Компании</a></li>
            <li class="nav__item"><a href="contract.php">Контракты</a></li>
        </ul>
    </nav>
<?php 
$conn = new mysqli("localhost", "root", "", "databaseSBD"); 
if($conn->connect_error){ 
    die("Ошибка: " . $conn->connect_error); 
} 
echo "<div class='connect'>Подключение успешно установлено</div>";
?>   
    <table  class="table_dark">
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Фамилия</th>
            <th>Отчество</th>
            <th>Дата рождения</th>
            <th>Должность</th>
            <th>Отдел</th>
            <th>Номер контракта</th>
            <th>Компания</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            
            $query = "SELECT P.ID, P.NAME, P.SURNAME, P.LASTNAME, P.BIRTHDATE, J.JOB_NAME, D.DEP_NAME, C.CONTRACT_NUMBER, CONTR.COMPANY_NAME  
                    FROM PERSONS P 
                    LEFT JOIN JOB_POSITION J ON P.JOB_POSITION_ID = J.ID 
                    LEFT JOIN DEPARTAMENT D ON P.DEPARTAMENT_ID = D.ID 
                    LEFT JOIN CONTRACTS C ON P.CONTRACT_ID = C.ID 
                    LEFT JOIN CONTRAGENTS CONTR ON P.CONTRAGENT_ID = CONTR.ID
                    WHERE P.NAME LIKE '%$search%' OR P.SURNAME LIKE '%$search%' OR P.LASTNAME LIKE '%$search%' OR J.JOB_NAME LIKE '%$search%' OR D.DEP_NAME LIKE '%$search%' OR C.CONTRACT_NUMBER LIKE '%$search%' OR CONTR.COMPANY_NAME LIKE '%$search%'";
            
            $result = mysqli_query($conn, $query);
            $persons = mysqli_fetch_all($result);
            
            // Вывод результатов поиска
        } else {
            $persons = mysqli_query($conn,"SELECT P.ID, P.NAME, P.SURNAME, P.LASTNAME, P.BIRTHDATE, J.JOB_NAME, D.DEP_NAME, C.CONTRACT_NUMBER, CONTR.COMPANY_NAME 
            FROM PERSONS P
            LEFT JOIN JOB_POSITION J ON P.JOB_POSITION_ID = J.ID
            LEFT JOIN DEPARTAMENT D ON P.DEPARTAMENT_ID = D.ID
            LEFT JOIN CONTRACTS C ON P.CONTRACT_ID = C.ID
            LEFT JOIN CONTRAGENTS CONTR ON P.CONTRAGENT_ID = CONTR.ID");
            $persons = mysqli_fetch_all($persons);
        }
           
            $counter = 1; // добавил счетчик чтобы выводить его вместо Id
              foreach($persons as $person){
                ?>
                <tr>
                    <td>
                        <?= $counter ?> 
                    </td>
                    <td>
                        <?=$person[1] ?>
                    </td>
                    <td>
                        <?=$person[2] ?>
                    </td>
                    <td>
                        <?=$person[3] ?>
                    </td>
                    <td>
                        <?= date('d-m-Y', strtotime($person[4]))?> 
                        <!-- преобразовал в строку и поменял порядок -->
                    </td>
                    <td>
                        <?=$person[5] ?>
                    </td>
                    <td>
                        <?=$person[6] ?>
                    </td>
                    <td>
                        <?=$person[7] ?>
                    </td>
                    <td>
                        <?=$person[8] ?>
                    </td>
                    <td>
                        <a class="update" href="update_form.php?id=<?=$person[0] ?>">Редактировать</a>
                    </td>
                    <td>
                        <a class="delete" href="delete.php?id=<?=$person[0] ?>">Удалить</a>
                    </td>
                </tr>
                <?php
                $counter++;
              }
        ?>
    </table>
    <?php
       echo '<script>';
       echo 'const deleteButtons = document.querySelectorAll(".delete");';
       echo 'deleteButtons.forEach(function(button){';
       echo 'button.addEventListener("click", function(e){';
       echo 'if(confirm("Вы уверены что хотите удалить сотрудника?")){';
       echo 'button.setAttribute("href", "delete.php?id=' . $person[0] . '");'; 
       echo '} else {';
       echo 'button.setAttribute("href", "");';
       echo 'e.preventDefault()';
       echo '}';
       echo '});';
       echo '});';
       echo '</script>';
    ?>
    <div class="bottom-wrapper">
        <a class="floating-button" href="create_form.php">Добавить сотрудника</a>
        <form class="form-search" method="GET" action="">
          <input type="text" name="search" placeholder="Введите ключевые слова">
         <button class="btn-search" type="submit">Поиск</button>
         <button class="btn-search" onclick="window.location.reload();">Полная версия таблицы</button>
        </form>
        <form class="generate" method="post" action="generate_excel.php">
            <input type="hidden" name="search_query" value="<?php echo $search; ?>">
            <button class="btn-search" type="submit" name="generate_excel" value="Сгенерировать Excel файл">
            Сгенерировать Excel файл
            </button>
        </form>
    </div>
    </div>  
</body>
</html>
