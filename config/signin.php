<?php

    session_start();
    require_once 'login.php';
    
   function getPDO():PDO
   {
     try{
        return new \PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';charset=utf8;dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
     } catch(\PDOExeption $e){
        die("Connection error");
     }
   }

    $login = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = '$login' AND password = '$password'";
    $pdo = getPDO();
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $res = $stmt->fetch(\PDO::FETCH_ASSOC);
    
   if($res){

    $_SESSION['id'] = $res['id'];
  
    header("location: ../admin/profile.php");

   }
  else{

    $_SESSION['message'] = 'Неверный логин или пароль';
    header('location: ../admin/index.php');

   }
  
    ?>
