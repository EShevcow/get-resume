<?php

if($_POST){
    // подключаем файлы для работы с базой данных и файлы с объектами
    require_once '../config/connect.php';
    include_once 'portfolio-info.php';

    // получаем соединение с базой данных
    $database = new Connect;
    $db = $database->getConnect();  

    // подготавливаем объект Portfolio
    $pt = new Portfolio($db);

    // устанавливаем ID для удаления 
    $pt->id = $_POST["object_id"];

    // удаляем проект
    try {
        $pt->deletePort();
        echo "<div class='alert-danger z-depth-2'>
             <b>Портфолио удалено!<b>            
         </div>"; 
    }
    catch (Exception $e) {
        echo "<div class='alert-danger z-depth-2'>
             <b>Не удалось Добавить портфолио!<b>            
         </div>";
    } 
  }
?>