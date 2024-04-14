<?php
require '../vendor/autoload.php'; // Подключаем автозагрузчик Composer
$conn = new mysqli("localhost", "root", "", "databaseSBD");  

 if(isset($_POST['generate_excel'])) {
    $search_query = $_POST['search_query'];
    // Добавьте код для подключения к базе данных $conn
    
    $query = "SELECT ID, DEP_NAME FROM `DEPARTAMENT`
    WHERE DEP_NAME LIKE '%$search_query%'";
    
    $result = mysqli_query($conn, $query);
    $deps = mysqli_fetch_all($result);
    
    // Код для генерации Excel файла с результатами поиска
    // Создаем новый объект PHPExcel 
    $objPHPExcel = new PHPExcel(); 
 
    // Устанавливаем активный лист 
    $objPHPExcel->setActiveSheetIndex(0); 
    $sheet = $objPHPExcel->getActiveSheet(); 
    
    // Заголовки столбцов 
    $sheet->setCellValue('A1', '№'); 
    $sheet->setCellValue('B1', 'Отдел'); 
    
    // Заполняем данными из запроса 
    $counter = 2; // Начинаем счет с 2, так как первая строка занята заголовками
    foreach($deps as $dep){ 
        $sheet->setCellValue('A'.$counter, $counter - 1); 
        $sheet->setCellValue('B'.$counter, $dep[1]);  
        $counter++; 
    } 
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    header('Content-Disposition: attachment;filename="deps.xlsx"'); 
    header('Cache-Control: max-age=0'); 
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objWriter->save('php://output'); 
    
    exit;
    header('Location: /');
    }
?>