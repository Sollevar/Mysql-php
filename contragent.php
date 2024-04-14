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
    <h2 class='title'>Cписок компаний</h2>
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
            <th>Тип компании</th>
            <th>Название компании</th>
            <th>Адрес компании</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $query = "SELECT ID, CONTRAGENT_TYPE, COMPANY_NAME, ADDRES FROM `CONTRAGENTS`
                    WHERE CONTRAGENT_TYPE LIKE '%$search%' OR COMPANY_NAME LIKE '%$search%' OR ADDRES LIKE '%$search%'";
            
            $result = mysqli_query($conn, $query);
            $contragents = mysqli_fetch_all($result);
            
            // Вывод результатов поиска
        } else {
            $contragents = mysqli_query($conn,"SELECT ID, CONTRAGENT_TYPE, COMPANY_NAME, ADDRES FROM `CONTRAGENTS`");
            $contragents = mysqli_fetch_all($contragents);
        }
           
            $counter = 1; // добавил счетчик чтобы выводить его вместо Id
              foreach($contragents as $contragent){
                ?>
                <tr>
                    <td>
                        <?= $counter ?> 
                    </td>
                    <td>
                        <?=$contragent[1] ?>
                    </td>
                    <td>
                        <?=$contragent[2] ?>
                    </td>
                    <td>
                        <?=$contragent[3] ?>
                    </td>
                    <td>
                        <a class="update" href="contragent/update_contr_form.php?id=<?=$contragent[0] ?>">Редактировать</a>
                    </td>
                    <td>
                        <a class="delete" href="contragent/delete_contr.php?id=<?=$contragent[0] ?>">Удалить</a>
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
            echo 'if(confirm("Вы уверены что хотите удалить должность?")){';
            echo 'button.setAttribute("href", "contragent/delete_contr.php?id=' . $contragent[0] . '");'; 
            echo '} else {';
            echo 'button.setAttribute("href", "");';
            echo 'e.preventDefault()';
            echo '}';
            echo '});';
            echo '});';
            echo '</script>';
        ?>
        <div class="bottom-wrapper">
            <a class="floating-button" href="contragent/create_contr_form.php">Добавить компанию</a>
            <form class="form-search" method="GET" action="">
                <input type="text" name="search" placeholder="Введите ключевые слова">
                <button class="btn-search" type="submit">Поиск</button>
                 <button class="btn-search" onclick="window.location.reload();">Полная версия таблицы</button>
            </form>
            <form class="generate" method="post" action="contragent/generate_excel_contr.php">
                <input type="hidden" name="search_query" value="<?php echo $search; ?>">
                <button class="btn-search" type="submit" name="generate_excel" value="Сгенерировать Excel файл">
                Сгенерировать Excel файл
                </button>
            </form>
        </div>
    </div>
</body>