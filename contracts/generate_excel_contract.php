<?php
require '../vendor/autoload.php'; // Подключаем автозагрузчик Composer
$conn = new mysqli("localhost", "root", "", "databaseSBD");  

 if(isset($_POST['generate_excel'])) {
    $search_query = $_POST['search_query'];
    // Добавьте код для подключения к базе данных $conn
    
    $query = "SELECT ID, CONTRACT_NUMBER, START_CONTRACT, END_CONTRACT FROM `CONTRACTS`
    WHERE CONTRACT_NUMBER LIKE '%$search_query%' OR START_CONTRACT LIKE '%$search_query%' OR END_CONTRACT LIKE '%$search_query%'";
    
    $result = mysqli_query($conn, $query);
    $contracts = mysqli_fetch_all($result);
    
    // Код для генерации Excel файла с результатами поиска
    // Создаем новый объект PHPExcel 
    $objPHPExcel = new PHPExcel(); 
 
    // Устанавливаем активный лист 
    $objPHPExcel->setActiveSheetIndex(0); 
    $sheet = $objPHPExcel->getActiveSheet(); 
    
    // Заголовки столбцов 
    $sheet->setCellValue('A1', '№'); 
    $sheet->setCellValue('B1', 'Номер контракта'); 
    $sheet->setCellValue('C1', 'Начало контракта');
    $sheet->setCellValue('D1', 'Конец контракта');
    
    // Заполняем данными из запроса 
    $counter = 2; // Начинаем счет с 2, так как первая строка занята заголовками
    foreach($contracts as $contract){ 
        $sheet->setCellValue('A'.$counter, $counter - 1); 
        $sheet->setCellValue('B'.$counter, $contract[1]); 
        $sheet->setCellValue('C'.$counter, $contract[2]);
        $sheet->setCellValue('D'.$counter, $contract[3]);    
        $counter++; 
    } 
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    header('Content-Disposition: attachment;filename="contracts.xlsx"'); 
    header('Cache-Control: max-age=0'); 
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objWriter->save('php://output'); 
    
    exit;
    header('Location: /');
    }
?>