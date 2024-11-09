<?php

if($_POST){
    // подключаем файлы для работы с базой данных и файлы с объектами
   
    require_once '../config/connect.php';
    include_once 'experience.php';
    
    // получаем соединение с базой данных
    $database = new Connect;
    $db = $database->getConnect();  

    // подготавливаем объект 
    $res = new Experience($db);

    // устанавливаем ID для удаления
  
    $res->id = $_POST["object_id"];

    // удаляем товар
    if ($res->deleteExp()) {
        echo "Приглашение был удалёно";
    }

    // если невозможно удалить товар
    else {
        echo "Неудалось удалить приглашение ";
    } 
  }
 

?>