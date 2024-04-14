<?php
require '../vendor/autoload.php'; // Подключаем автозагрузчик Composer
$conn = new mysqli("localhost", "root", "", "databaseSBD");  

 if(isset($_POST['generate_excel'])) {
    $search_query = $_POST['search_query'];
    // Добавьте код для подключения к базе данных $conn
    
    $query = "SELECT ID, CONTRAGENT_TYPE, COMPANY_NAME, ADDRES FROM `CONTRAGENTS`
    WHERE CONTRAGENT_TYPE LIKE '%$search_query%' OR COMPANY_NAME LIKE '%$search_query%' OR ADDRES LIKE '%$search_query%'";
    
    $result = mysqli_query($conn, $query);
    $contrs = mysqli_fetch_all($result);
    
    // Код для генерации Excel файла с результатами поиска
    // Создаем новый объект PHPExcel 
    $objPHPExcel = new PHPExcel(); 
 
    // Устанавливаем активный лист 
    $objPHPExcel->setActiveSheetIndex(0); 
    $sheet = $objPHPExcel->getActiveSheet(); 
    
    // Заголовки столбцов 
    $sheet->setCellValue('A1', '№'); 
    $sheet->setCellValue('B1', 'Тип компании'); 
    $sheet->setCellValue('C1', 'Название компании');
    $sheet->setCellValue('D1', 'Адрес компании'); 
    
    // Заполняем данными из запроса 
    $counter = 2; // Начинаем счет с 2, так как первая строка занята заголовками
    foreach($contrs as $contr){ 
        $sheet->setCellValue('A'.$counter, $counter - 1); 
        $sheet->setCellValue('B'.$counter, $contr[1]); 
        $sheet->setCellValue('C'.$counter, $contr[2]);
        $sheet->setCellValue('D'.$counter, $contr[3]);  
        $counter++; 
    } 
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    header('Content-Disposition: attachment;filename="contragents.xlsx"'); 
    header('Cache-Control: max-age=0'); 
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objWriter->save('php://output'); 
    
    exit;
    header('Location: /');
    }
?>