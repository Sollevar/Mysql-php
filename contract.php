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
    <h2 class='title'>Cписок контрактов</h2>
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
            <th>Номер контракта</th>
            <th>Начало контракта</th>
            <th>Конец контракта</th>
            <th></th>
            <th></th>
        </tr>
        <?php
        if(isset($_GET['search'])) {
            $search = $_GET['search'];
            $query = "SELECT ID, CONTRACT_NUMBER, START_CONTRACT, END_CONTRACT FROM `CONTRACTS`
                    WHERE CONTRACT_NUMBER LIKE '%$search%' OR START_CONTRACT LIKE '%$search%' OR END_CONTRACT LIKE '%$search%'";
            
            $result = mysqli_query($conn, $query);
            $contracts = mysqli_fetch_all($result);
            
            // Вывод результатов поиска
        } else {
            $contracts = mysqli_query($conn,"SELECT ID, CONTRACT_NUMBER, START_CONTRACT, END_CONTRACT FROM `CONTRACTS`");
            $contracts = mysqli_fetch_all($contracts);
        }
           
            $counter = 1; // добавил счетчик чтобы выводить его вместо Id
              foreach($contracts as $contract){
                ?>
                <tr>
                    <td>
                        <?= $counter ?> 
                    </td>
                    <td>
                        <?=$contract[1] ?>
                    </td>
                    <td>
                        <?= date('d-m-Y', strtotime($contract[2]))?>
                    </td>
                    <td>
                        <?= date('d-m-Y', strtotime($contract[3]))?>
                    </td>
                    <td>
                        <a class="update" href="contracts/update_contract_form.php?id=<?=$contract[0] ?>">Редактировать</a>
                    </td>
                    <td>
                        <a class="delete" href="contracts/delete_contract.php?id=<?=$contract[0] ?>">Удалить</a>
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
            echo 'button.setAttribute("href", "contracts/delete_contract.php?id=' . $contract[0] . '");'; 
            echo '} else {';
            echo 'button.setAttribute("href", "");';
            echo 'e.preventDefault()';
            echo '}';
            echo '});';
            echo '});';
            echo '</script>';
        ?>
        <div class="bottom-wrapper">
            <a class="floating-button" href="contracts/create_contract_form.php">Добавить контракт</a>
            <form class="form-search" method="GET" action="">
                <input type="text" name="search" placeholder="Введите ключевые слова">
                <button class="btn-search" type="submit">Поиск</button>
                 <button class="btn-search" onclick="window.location.reload();">Полная версия таблицы</button>
            </form>
            <form class="generate" method="post" action="contracts/generate_excel_contract.php">
                <input type="hidden" name="search_query" value="<?php echo $search; ?>">
                <button class="btn-search" type="submit" name="generate_excel" value="Сгенерировать Excel файл">
                Сгенерировать Excel файл
                </button>
            </form>
        </div>
    </div>
</body>