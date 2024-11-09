<?php

    session_start();
    
    require_once 'login.php';
    $connect = new mysqli($hn, $un, $pw, $db);
    if($connect->connect_error) die("Fatal Error");
       
 if(isset($_POST['fullname']) &&
    isset($_POST['login-color']) &&
    isset($_POST['date-born']) &&
    isset($_POST['password']) &&
    isset($_POST['password_confirm']) &&
    isset($_POST['agree'])
  )
  {
    $fullname = htmlentities($_POST['fullname']);
    $login = htmlentities($_POST['login-color']);
    $dateborn = htmlentities($_POST['date-born']);
    $password = htmlentities($_POST['password']);
    $password_confirm = htmlentities($_POST['password_confirm']);
    $agree = $_POST['agree'];
  }
  else {
    $_SESSION['message'] = 'Одно или несколько полей пустые';
    header('Location: ../register.php');
  }

 if($password === $password_confirm && $agree == true) 
  { 
    $password = md5($password);
    $query = "INSERT INTO `accounts` (`id`, `fullname`, `login`, `password`, `date_born`) 
    VALUES (NULL, '$fullname', '$login', '$password', '$dateborn')";
    $res = $connect->query($query);
  
    if(!$res)  die("Fatal Error"); 
    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../index.php'); 
  } 
 elseif($agree != true){
       $_SESSION['message'] = 'Вы не дали согласие на обработку данных';
       header('Location: ../register.php');
 }
 else {
       $_SESSION['message'] = 'Пароли не совпадают';
       header('Location: ../register.php');
      }

?>
