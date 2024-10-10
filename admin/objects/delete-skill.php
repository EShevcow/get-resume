<?php

if($_POST){
    // подключаем файлы для работы с базой данных и файлы с объектами
    require_once '../config/connect.php';
    include_once 'skills-info.php';

    // получаем соединение с базой данных
    $database = new Connect;
    $db = $database->getConnect();  

    // подготавливаем объект Portfolio
    $sk = new Skills($db);

    // устанавливаем ID для удаления
  
    $sk->id = $_POST["object_id"];

    // удаляем товар
    if ($sk->deleteSkill()) {
        echo "Приглашение был удалёно";
    }

    // если невозможно удалить товар
    else {
        echo "Неудалось удалить приглашение ";
    } 
  }
?>