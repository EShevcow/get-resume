<?php

if($_POST){
    // подключаем файлы для работы с базой данных и файлы с объектами
    require_once '../config/connect.php';
    include_once 'education.php';

    // получаем соединение с базой данных
    $database = new Connect;
    $db = $database->getConnect();  

    // подготавливаем объект Portfolio
    $educate = new Education($db);

    // устанавливаем ID для удаления
  
    $educate->id = $_POST["object_id"];

    // удаляем товар
    if ($educate->deletEducation()) {
        echo "Приглашение был удалёно";
    }

    // если невозможно удалить товар
    else {
        echo "Неудалось удалить ";
    } 
  }
?>