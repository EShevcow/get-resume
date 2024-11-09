<?php 

 session_start();
 if ($_SESSION['user']) {
  header('Location: profile.php');
}

?>


<?php 
 include_once 'layout-head.php';
?>

<body>
     
<div class="container-fluid">
<div class="row">
<div class="col s12">

 <div class="header">
   <a class="brand-logo">
     <img src="libs/img/logo.png" alt="Logotype"/>
  </a>
 </div>

 <section class="content-autorize">
   <div class="card card-autorize hoverable">
    <div class="card-content">
     
      <blockquote>
      <span class="card-title">Admin Autorize</span>
      </blockquote>
      
      <form action="config/signin.php" method="post">
        <div class="input-field">
          <i class="material-icons prefix">account_circle</i>
            <input id="login" type="text" class="resume" name = "email">
            <label for="login">Login</label>
            <small class="helper-text invalid">Login</small>
          </div>
          <div class="input-field">
          <i class="material-icons prefix">security</i>
            <input id="password" type="password" class="resume" name = "password">
            <label for="password">Пароль</label>
            <small class="helper-text invalid">Password</small>
          </div>
         <button class="btn waves-effect waves-light auth-submit" type="submit">
          Войти
        <i class="material-icons right">send</i>
      </button>
      
      </form> 
      <br>
      <?php
            if ($_SESSION['message']) {
                echo '<p class="alert-danger"> ' . $_SESSION['message'] . ' </p>';
            }
            unset($_SESSION['message']);
        ?>
      
        
    </div>
   </div>     
     
 </section> 

</div>
</div>     
</div>

<!--JavaScript at end of body for optimized loading-->
<script type="text/javascript" src="js/materialize.min.js"></script>
<!-- Custom script -->
<script src="js/script.js"></script>

</body>
</html>
        