<?php 

  session_start();
  if (!$_SESSION['id']) {
     header('Location: index.php');
  }

  // получаем ID пользователя
  $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

  include_once '../config/connect.php';
  include_once '../objects/user.php';
  include_once '../objects/header.php';
  include_once '../objects/experience.php';
  include_once '../objects/get-date.php';

  $database = new Connect;
  $db = $database->getConnect();

  $user = new User($db);
  $exp = new Experience($db);
  $dt = new GetDate();
  $hd = new Header($db);

  $user->id = $_SESSION['id'];
  $hd->user_id = $_SESSION['id'];
  $hd->id = $id;

  $_SESSION['resume_id'] = $id;
 # setcookie('resume_id', $id, 0, "/");

  # костыль для ограничения доступа к разделу резюме другого пользователя 
  # $resume_id = $_COOKIE['resume_id'] == $id ? $_COOKIE['resume_id'] : header("Location: profile.php");
  
  $user->readOneUser();
  $resums = $hd->readInfoRes();
  $res_inf = $resums->fetch(PDO::FETCH_ASSOC); 
  extract($res_inf);

  $title_page = "Редактирование: " . $profession;

?>


<?php 
  include_once 'layouts/head.php';
?>
<body>

<!--Start Navbar-->
<?php 
 include_once 'layouts/navbar.php';
?> 
<!-- /End Navbar -->

  <div class="wrapper-left">

        <!-- Start Main Content -->
        <main class="column">
           
            <!--Start Breadcrumb Nav-->
            <div class="card-vertical">
                 <div class="breadcrumb">
                     <div class="breadcrumb__wrap">
                        <a class="breadcrumb__link" href="profile.php">
                            <span class="bredcrumb__label">Профиль</span>
                            <i class="icofont-rounded-right"></i>
                        </a>
                        <a class="breadcrumb__link" href="redact-photo.php?id=<?= $id ?>">
                            <span class="bredcrumb__label">Обновление фото</span>
                            <i class="icofont-rounded-right"></i>
                        </a>
                        <a class="breadcrumb__link breadcrumb__link_active" href="#">
                            <span class="bredcrumb__label">Редактирование Инфо Резюме</span>
                        </a>
                    </div>
                </div> 
            </div>  
            <!--/End Breadcrumb Nav-->
            
            <!--Start Profile Head-->
            <div class="card-vertical">
                <div class="card__wrap">
                    <a href="redact-photo.php?id=<?= $id ?>" class="tooltip-right" data-tooltip="Изменить фото">
                    <div class="card__image avatar">
                        <img src="../libs/img/<?= $avatar ?>" alt="images">
                    </div>
                    </a>
                    <div class="card__text-block">
                        <span class="body-text"><?= $fullname ?></span>
                 </div>
               </div>
            </div>
            <!--/End Profile Head-->

            <!--Start Resume Items-->
            <div class="card-vertical">
                <div class="card__wrap"> 

             <!--Start Block Notification-->
                <div class="notif-block" id="send-notif">
            <div class="notif-block__wrap notif-block__success">
                <span class="large-icon">
                    <i class="icofont-check-circled"></i>
                </span>
                <span class="text-body notif">
                 Данные успешно обновлены!
                </span>
            </div>
        </div>   
          <!--/End Block Notification -->

            <?php 
             if($_POST){
 
 
                $hd->phone = htmlentities($_POST["phone"]);
                $hd->email = htmlentities($_POST["email"]);
                $hd->live_place = htmlentities($_POST["live_place"]);
                $hd->profession = htmlentities($_POST["profession"]);
                $hd->money = htmlentities($_POST["money"]);
                $hd->about = htmlentities($_POST['about']);

                $hd->updateResume();
              
                #  еще один костыль для отмены отправки про перезагрузке
                #  header("Location: redact-info-resume.php?id={$id}"
               
              }
            ?>
                    <div class="card__text-block">
                    <span class="body-text">Редактирование Резюме</span>
                    <form class="column" action="" method="post">
                        <div class="input-field">
                            <input class="input-field__input" id="prof" name="profession" type="text" value="<?= $profession ?>">
                            <label class="input-field__label" for="prof">Целевая профессия</label>
                        </div>
                        <div class="input-field">
                            <input class="input-field__input" id="phone" name="phone" type="tel" value="<?= $phone ?>">
                            <label class="input-field__label" for="phpne">Номер телефона</label>
                        </div>
                        <div class="input-field">
                            <input class="input-field__input" id="email" name="email" type="tel" value="<?= $email ?>">
                            <label class="input-field__label" for="email">Email</label>
                        </div>
                        <div class="input-field">
                            <input class="input-field__input" id="mn" name="money" type="number" value="<?= $money ?>">
                            <label class="input-field__label" for="mn">Зарплатные ожидания</label>
                        </div>
                        <div class="input-field">
                            <input class="input-field__input" id="lp" name="live_place" type="text" value="<?= $live_place?>">
                            <label class="input-field__label" for="lp">Место жительства</label>
                        </div>
                        <div class="input-field">  
                            <textarea class="input-field__textarea" name="about" placeholder="Коротко о себе"><?= $about ?></textarea>
                            <label class="input-field__label" for="about">О себе</label>
                        </div> 
                        <div class="card__action">
                            <button class="btn primary">
                                <i class="icofont-pencil"></i>
                                <span class="body-bold">Сохранить</span>
                            </button> 
                        </div>
                    </form>  
                 </div>
               </div>
            </div>
            <!--/End Resume Items-->
            
        </main>
        <!--/End Main Content-->

        <!--Start Aside & Ads-->
        <aside class="column">
          
        <!--Start Ads Block-->
        <?php 
        include_once 'layouts/ads-block.php';
        ?>
        <!--/End Ads Block-->

        </aside>
        <!--/End Aside -->
        </div>

<!--Start Linq Scripts-->
<?php 
 include_once 'layouts/scripts.php';
?>
<script>
  document.querySelector('form').onsubmit = async e => {
  e.preventDefault();
  let response = await fetch("redact-info-resume.php?id=<?= $id ?>", { method: 'POST', body: new FormData(e.target) });
 // let result = await response.text();
 
  $('#send-notif').slideToggle();
  setTimeout(() => {
    $('#send-notif').slideToggle();
  }, 3000);
  
   }
 
</script>
<!--/End Linq Scripts-->
</body>
</html>
