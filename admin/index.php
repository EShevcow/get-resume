<?php 

 session_start();
 if ($_SESSION['user']) {
  header('Location: profile.php');
}
?>
<?php

?>
<!doctype html>
<html lang="en">
<head>
  <title>Авторизация</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="css/index.css">
 <style>
  .msg{
    display: block;
    border: 2p solid orange;
    padding: 10px;
    text-align: center;
    font-weight: 600;
}
 </style>
</head>
<body>
<div>
<div class="empty-layout">


<form class="card hoverable gray lighten-3 auth-card" action="../config/signin.php" method="post">
  <div class="card-content">
    <blockquote>
    <span class="card-title">Resume Constructor</span>
    </blockquote>
    <div class="input-field">
    <i class="material-icons prefix">account_circle</i>
      <input
          id="email"
          type="text"
          class="validate"
          name = "email"
      >
      <label for="email">Login</label>
      <small class="helper-text invalid">Login</small>
    </div>
    <div class="input-field">
    <i class="material-icons prefix">security</i>
      <input
          id="password"
          type="password"
          class="validate"
          name = "password" 
      >
      <label for="password">Пароль</label>
      <small class="helper-text invalid">Password</small>
    </div>
  </div>
  <div class="card-action">
    <div>
      <button
          class="btn waves-effect waves-light auth-submit"
          type="submit"
      >
        Войти
        <i class="material-icons right">send</i>
      </button>
    </div>

    <p class="center">
      Нет аккаунта?
      <a href="register.php">Зарегистрироваться</a>
    </p>
    <?php
            if ($_SESSION['message']) {
                echo '<p class="msg orange-text"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
  </div>
</form>

</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>