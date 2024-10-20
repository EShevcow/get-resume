<?php
  
  if($_POST){
    // подключаем файлы для работы с базой данных и файлы с объектами
    require_once '../config/connect.php';
    include_once 'invite-read.php';

    // получаем соединение с базой данных
    $database = new Connect;
    $db = $database->getConnect();  

    // подготавливаем объект Portfolio
    $invites = new Invites($db);

    // устанавливаем ID для удаления
  
    $invites->id = $_POST["object_id"];

    // удаляем товар
    if ($invites->deleteInvite()) {
        echo "Приглашение был удалёно";
    }

    // если невозможно удалить товар
    else {
        echo "Неудалось удалить приглашение ";
    } 
  }
?>