<?php 

 session_start();
 if ($_SESSION['user']) {
  header('Location: profile.php');
}

$title_page = "Авторизация и регистрация";
?>

<?php 
   include_once 'layouts/head.php';
?>

<body>
   
   <main class="wrapper-center">

    <div class="card-vertical">
        <div class="card__wrap">
            
            <!--Start Head Notif-->
            <div class="notif-block">
                <div class="notif-block__wrap notif-block__action">
                    <img src="../libs/img/logo.png" alt="Logo">
                </div>
            </div>        
            <!--End Head Notif-->
            <div class="card__text-block">

                <!--Start Tabs-->
                <div class="tabs">
                    <ul class="tabs__wrap">
                        <li class="tabs__item active" data-tab="tab1">
                            <span class="text-label">
                                Авторизация
                            </span>
                        </li>
                        <li class="tabs__item" data-tab="tab2">
                            <span class="text-label">
                                Регистрация
                            </span>
                        </li>
                       
                    </ul>
                </div> 

                <div class="tab-content active" id="tab1">
                   <form class="get-autorize" action="../config/signin.php" method="post">
                    <div class="input-field">
                        <input class="input-field__input" id="log" name="email" type="email">
                        <label class="input-field__label" for="log">Login:</label>
                    </div>
                    <div class="input-field">
                        <input class="input-field__input" id="pas" name="password" type="password">
                        <label class="input-field__label" for="pas">Password:</label>
                    </div>
                    <?php
                        if ($_SESSION['message']) {
                        echo '<div class="notif-block">
                             <div class="notif-block__wrap notif-block__danger"> 
                               <span class="text-body"> ' . $_SESSION['message'] . '</span>
                            </div>
                            </div>';
                        }
                       unset($_SESSION['message']);
                     ?>
                              
                    <button class="btn primary" type="submit">    
                        <span class="body-bold">Autorize</span>
                        <i class="icofont-rounded-right"></i>
                    </button>
                   </form>
                </div>  
                <div class="tab-content" id="tab2">
                   <form class="get-autorize" action="" method="post">
                    <div class="notif-block">
                        <div class="notif-block__wrap notif-block__danger">
                            <span class="large-icon">
                                <i class="icofont-lock"></i>
                            </span>
                            <span class="text-body">
                              Регистрация недоступна 
                            </span>
                        </div>
                    </div>        
                   </form>
                </div>
                <!--/End Tabs-->

            
         </div>
       </div>
    </div>
   </main>

  <!--Start Linq Scripts-->
  <?php 
   include_once 'layouts/scripts.php';
  ?>
  <!--/End Linq Scripts-->  
</body>
</html>