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
    <h2 class='title'>Cписок отделов</h2>
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
            <th>Отдел</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $query = "SELECT ID, DEP_NAME FROM `DEPARTAMENT`
                    WHERE DEP_NAME LIKE '%$search%'";
            
            $result = mysqli_query($conn, $query);
            $deps = mysqli_fetch_all($result);
            
            // Вывод результатов поиска
        } else {
            $deps = mysqli_query($conn,"SELECT ID, DEP_NAME FROM `DEPARTAMENT`");
            $deps = mysqli_fetch_all($deps);
        }
           
            $counter = 1; // добавил счетчик чтобы выводить его вместо Id
              foreach($deps as $dep){
                ?>
                <tr>
                    <td>
                        <?= $counter ?> 
                    </td>
                    <td>
                        <?=$dep[1] ?>
                    </td>
                    <td>
                        <a class="update" href="depart/update_dep_form.php?id=<?=$dep[0] ?>">Редактировать</a>
                    </td>
                    <td>
                        <a class="delete" href="depart/delete_dep.php?id=<?=$dep[0] ?>">Удалить</a>
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
            echo 'if(confirm("Вы уверены что хотите удалить отдел?")){';
            echo 'button.setAttribute("href", "depart/delete_dep.php?id=' . $dep[0] . '");'; 
            echo '} else {';
            echo 'button.setAttribute("href", "");';
            echo 'e.preventDefault()';
            echo '}';
            echo '});';
            echo '});';
            echo '</script>';
        ?>
        <div class="bottom-wrapper">
            <a class="floating-button" href="depart/create_dep_form.php">Добавить отдел</a>
            <form class="form-search" method="GET" action="">
                <input type="text" name="search" placeholder="Введите ключевые слова">
                <button class="btn-search" type="submit">Поиск</button>
                 <button class="btn-search" onclick="window.location.reload();">Полная версия таблицы</button>
            </form>
            <form class="generate" method="post" action="depart/generate_excel_dep.php">
                <input type="hidden" name="search_query" value="<?php echo $search; ?>">
                <button class="btn-search" type="submit" name="generate_excel" value="Сгенерировать Excel файл">
                Сгенерировать Excel файл
                </button>
            </form>
        </div>
    </div>
</body>