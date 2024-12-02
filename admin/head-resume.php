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
  #setcookie('resume_id', $id, 0, "/");

  # костыль для ограничения доступа к разделу резюме другого пользователя 
  # $resume_id = $_COOKIE['resume_id'] == $id ? $_COOKIE['resume_id'] : header("Location: profile.php");
  
  $user->readOneUser();
  $resums = $hd->readInfoRes();
  $res_inf = $resums->fetch(PDO::FETCH_ASSOC); 
  extract($res_inf);

  setcookie('prof', $profession, 0, "/");

  $title_page = "Разделы резюме: " . $_COOKIE['prof'];

?>


<?php 
  include_once 'layouts/head.php';
?>
<body>
    
    <!--Start Navbar-->
    <?php 
    include_once 'layouts/navbar.php';
    ?>
    <!--/End Navbar-->

    <div class="wrapper">
        <aside class="column">
           
            <div class="sidenav">
                <div class="sidenav__wrap">
                    <a href="#" class="sidenav__item sidenav__item_active">
                        <span class="text-label">Главная</span>
                    </a>
                    
                    <a href="experience.php" class="sidenav__item">
                        <span class="text-label">Опыт работы</span>
                    </a>
                    <a href="#" class="sidenav__item">
                        <span class="text-label">Навыки</span>
                    </a>
                    <a href="invites.html" class="sidenav__item">
                        <span class="text-label">Образование</span>
                    </a>
                    <a href="invites.html" class="sidenav__item">
                        <span class="text-label">Приглашения</span>
                    </a>
                </div>
            </div> 

            <!--Start Ads Block-->
           <?php 
           include_once 'layouts/ads-block.php';
           ?>
            <!--/End Ads Block-->
        </aside>
        <main>
          
            <div class="card-horizontal">
                <div class="card__wrap">
                    <div class="card__text-block">
                        <span class="body-text"><?= $profession ?></span>
                        <span class="text-small">
                           <?= $email ?>
                        </span>
                        <span class="text-small">
                            <?= $phone ?>
                        </span>
                        <blockquote>
                           <?= $about ?>
                        </blockquote>
                        <div class="card__action">
                            <a href="redact-photo.php?id=<?= $id ?>">
                                <span class="body-bold">
                                  Обновить фото
                                  <i class="icofont-arrow-right"></i>    
                               </span>
                              </a>
                              <a class="get-color" href="redact-info-resume.php?id=<?= $id ?>" >    
                                  <span class="body-bold">Редактировать информацию</span>
                                  <i class="icofont-pencil"></i>
                              </a>
                        </div> 
                    </div>
                </div>
            </div>           
               
          
        </main>
    </div>

    <!--Start Linq Scripts-->
    <?php 
    include_once 'layouts/scripts.php';
    ?>
    <!--/End Linq Scripts-->
</body>
</html>
