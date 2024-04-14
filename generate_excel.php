<?php
require 'vendor/autoload.php'; // Подключаем автозагрузчик Composer
$conn = new mysqli("localhost", "root", "", "databaseSBD");  

 if(isset($_POST['generate_excel'])) {
    $search_query = $_POST['search_query'];
    // Добавьте код для подключения к базе данных $conn
    
    $query = "SELECT P.ID, P.NAME, P.SURNAME, P.LASTNAME, P.BIRTHDATE, J.JOB_NAME, D.DEP_NAME, C.CONTRACT_NUMBER, CONTR.COMPANY_NAME   
            FROM PERSONS P  
            LEFT JOIN JOB_POSITION J ON P.JOB_POSITION_ID = J.ID  
            LEFT JOIN DEPARTAMENT D ON P.DEPARTAMENT_ID = D.ID  
            LEFT JOIN CONTRACTS C ON P.CONTRACT_ID = C.ID  
            LEFT JOIN CONTRAGENTS CONTR ON P.CONTRAGENT_ID = CONTR.ID 
            WHERE P.NAME LIKE '%$search_query%' OR P.SURNAME LIKE '%$search_query%' OR P.LASTNAME LIKE '%$search_query%' OR J.JOB_NAME LIKE '%$search_query%' OR D.DEP_NAME LIKE '%$search_query%' OR C.CONTRACT_NUMBER LIKE '%$search_query%' OR CONTR.COMPANY_NAME LIKE '%$search_query'";
    
    $result = mysqli_query($conn, $query);
    $persons = mysqli_fetch_all($result);
    
    // Код для генерации Excel файла с результатами поиска
    // Создаем новый объект PHPExcel 
    $objPHPExcel = new PHPExcel(); 
 
    // Устанавливаем активный лист 
    $objPHPExcel->setActiveSheetIndex(0); 
    $sheet = $objPHPExcel->getActiveSheet(); 
    
    // Заголовки столбцов 
    $sheet->setCellValue('A1', '№'); 
    $sheet->setCellValue('B1', 'Имя'); 
    $sheet->setCellValue('C1', 'Фамилия'); 
    $sheet->setCellValue('D1', 'Отчество'); 
    $sheet->setCellValue('E1', 'Дата рождения'); 
    $sheet->setCellValue('F1', 'Должность'); 
    $sheet->setCellValue('G1', 'Отдел'); 
    $sheet->setCellValue('H1', 'Номер контракта'); 
    $sheet->setCellValue('I1', 'Компания'); 
    
    // Заполняем данными из запроса 
    $counter = 2; // Начинаем счет с 2, так как первая строка занята заголовками
    foreach($persons as $person){ 
        $sheet->setCellValue('A'.$counter, $counter - 1); 
        $sheet->setCellValue('B'.$counter, $person[1]); 
        $sheet->setCellValue('C'.$counter, $person[2]); 
        $sheet->setCellValue('D'.$counter, $person[3]); 
        $sheet->setCellValue('E'.$counter, date('d-m-Y', strtotime($person[4]))); 
        $sheet->setCellValue('F'.$counter, $person[5]); 
        $sheet->setCellValue('G'.$counter, $person[6]); 
        $sheet->setCellValue('H'.$counter, $person[7]); 
        $sheet->setCellValue('I'.$counter, $person[8]); 

        $counter++; 
    } 
    
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    header('Content-Disposition: attachment;filename="persons.xlsx"'); 
    header('Cache-Control: max-age=0'); 
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
    $objWriter->save('php://output'); 
    
    exit;
    header('Location: /');
    }
?>