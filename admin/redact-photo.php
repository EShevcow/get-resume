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

  #$_SESSION['resume_id'] = $id;
  #setcookie('resume_id', $id, 0, "/");

  # костыль для ограничения доступа к разделу резюме другого пользователя 
  # $resume_id = $_COOKIE['resume_id'] == $id ? $_COOKIE['resume_id'] : header("Location: profile.php");
  
  $user->readOneUser();
  $resums = $hd->readInfo();
  $res_inf = $resums->fetch(PDO::FETCH_ASSOC); 
  extract($res_inf);

  $title_page = "Обновление фотографии: " . $profession;

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
                        <a class="breadcrumb__link breadcrumb__link_active" href="#">
                            <span class="bredcrumb__label">Обновление фото для: <?= $profession ?></span>
                        </a>
                    </div>
                </div> 
            </div>  
            <!--/End Breadcrumb Nav-->
            <?php 
            if($_POST){

                $hd->fullname = htmlentities($_POST["fullname"]);
                $avatar = !empty($_FILES["avatar"]["name"])
                ?  basename($_FILES["avatar"]["name"]) : "";
                $hd->avatar = $avatar;

                $hd->updatePhoto();
                $hd->uploadAvatar();      
                   
            }
            ?>
            <!--Start Profile Head-->
            <div class="card-horizontal">
                <div class="card__wrap">
                
                    <div class="card__text-block">
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post" enctype="multipart/form-data">

                        <div class="file-field input-field">
                            <div class="wireimage">
                                <div class="image__wrap">
                                   <img src="../libs/img/<?= $avatar ?>" alt="Image">
                                  
                                </div>
                            </div> 
                             <input type="file" name="avatar">  
                        </div>

                            <div class="input-field">
                                <input class="input-field__input" id="fn" name="fullname" type="text" value="<?= $fullname ?>">
                                <label class="input-field__label" for="fn">Редактировать имя:</label>
                            </div>

                             <div class="card__action">

                        <button class="btn primary" type="submit">
                          <span class="body-bold">
                            <i class="icofont-save"></i>
                            Сохранить
                         </span>
                     </button>
                    </div>
                </form>
                
                <!--Start Notif Block-->
                <div class="notif-block" id="send-notif">
                    <div class="notif-block__wrap notif-block__success">
                    <span class="text-body">
                        <i class="icofont-check-circled"></i>
                    </span>
                    <span class="text-body">
                        Имя и Аватар обновлены!
                    </span>
                    </div>
                </div> 
        <!--/End Notif Block-->
                 </div>
               </div>

            </div>
  
            <!--/End Profile Head-->

            <!--Start Resume Items-->
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
                        <div class="card__action">
                            <a class="btn primary" href="head-resume.php?id=<?= $id ?>">
                              <span class="body-bold">
                                Редактировать разделы резюме
                                <i class="icofont-arrow-right"></i>    
                             </span>
                            </a>
                            <a class="btn secondary" href="redact-info-resume.php?id=<?= $id ?>">    
                                <span class="body-bold">Редактировать информацию</span>
                                <i class="icofont-pencil"></i>
                            </a>
                        </div> 
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
  let response = await fetch("redact-photo.php?id=<?= $id ?>", { method: 'POST', body: new FormData(e.target) });
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
