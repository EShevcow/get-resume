<?php 
session_start();
if (!$_SESSION['id']) {
   header('Location: index.php');
}
// получаем ID пользователя
$id_exp = isset($_GET["id_exp"]) ? $_GET["id_exp"] : die("ERROR: отсутствует ID.");

include_once '../config/connect.php';
include_once '../objects/user.php';
include_once '../objects/header.php';
include_once '../objects/experience.php';
include_once '../objects/get-date.php';

$database = new Connect;
$db = $database->getConnect();

$user = new User($db, $fullname, $gender, $avatar, $login, $password, $dateborn);
$exp = new Experience($db);
$dt = new GetDate();

$exp->user_id = $_SESSION['id'];
$exp->resume_id = $_SESSION['resume_id'];
$exp->id = $id_exp;
$exp->readOneExp();

$title_page = "Редактирование опыта в:  " . $exp->comps;

?>

<?php 
 include_once 'layouts/head.php';
?>
<body>
    
    <!--Start Navbar-->
    <?php 
    include_once 'layouts/navbar.php';
    ?> 
   <!--/End Navbar -->

    <div class="wrapper">
        <aside class="column">

           <!--Start Sidenav-->
            <div class="sidenav">
                <div class="sidenav__wrap">
                    <a href="head-resume.php?id=<?= $exp->resume_id ?>" class="sidenav__item">
                        <span class="text-label">Главная</span>
                    </a>
                    <a href="experience.php" class="sidenav__item sidenav__item_active">
                        <span class="text-label">Опыт работы</span>
                    </a>
                   
                </div>
            </div> 

            <!--Start Ads Block-->
           <?php 
           include_once 'layouts/ads-block.php';
           ?>
               <!--/End Ads Block-->
        </aside>
        <main class="column">

           <!--Start Breadcrumb Nav-->
           <div class="card-vertical">
           <div class="breadcrumb">
            <div class="breadcrumb__wrap">
                <a class="breadcrumb__link" href="experience.php">
                    <span class="bredcrumb__label">Опыт работы</span>
                    <i class="icofont-rounded-right"></i>
                </a>
                <a class="breadcrumb__link  breadcrumb__link_active" href="#">
                    <span class="bredcrumb__label">Редактирование опыта: <?= $exp->prof ?></span>

                </a>
               
            </div>
         </div> 
      </div>
            <!--/End Breadcrumb Nav-->
            <?php 
             if($_POST){

                $exp->comps = htmlspecialchars($_POST['comp']);
                $exp->category = htmlspecialchars($_POST['category']);
                $exp->prof = htmlspecialchars($_POST['prof']);
                $exp->descs = htmlspecialchars($_POST['desc']);
                $exp->period = htmlspecialchars($_POST['start-date']);
                $exp->period_end = htmlspecialchars($_POST['end-date']);
                 
                $exp->updateOneExp();

             }
            ?>
            <!--Start Redact Block-->
            <div class="card-horizontal">
                <div class="card__wrap">
                    <div class="card__text-block">

                  <!--Start Notif-->
                    <div class="notif-block" id="send-notif">
                        <div class="notif-block__wrap notif-block__success">
                           <i class="icofont-check-circled"></i>
                            <span class="text-body">
                             Опыт работы изменен
                            </span>
                        </div>
                    </div>  
                   <!--/End Notif-->

                        <span class="body-text">Редактировать опыт работы </span>
                        <form class="column" action="" method="post">
            
                            <div class="input-field">
                                <input class="input-field__input get-input" id="cmp" name="comp" type="text" value="<?= $exp->comps ?>">
                                <label class="input-field__label" for="cmp">Название компании:</label>
                            </div>
                            <div class="input-field">
                                <select class="input-field__select" name="category" id="sel1">
                                    <option value="" selected><?= $exp->category ?></option> 
                                    <option value="Другое">Другое</option>
                                    <option value="IT">IT</option>
                                    <option value="Производство">Производство</option>
                                    <option value="Торговля">Торговля</option>
                                    <option value="Логистика">Логистика</option>
                                    <option value="HoReCa">HoReCa</option>
                                </select>
                                <span class="input-field__icon">
                                    <i class="icofont-rounded-down"></i>
                                </span>
                                <label class="input-field__label" for="sel1">Категория работы:</label>
                            </div> 
                            <div class="input-field">
                                <input class="input-field__input get-input" id="prf" name="prof" type="text" value="<?= $exp->prof ?>">
                                <label class="input-field__label" for="prf">Профессия:</label>
                            </div>
                            <div class="input-field">  
                                <textarea class="input-field__textarea get-textarea" id="dsc" name="desc"><?= $exp->descs ?></textarea>
                                <label class="input-field__label" for="dsc">Описание работы:</label>
                            </div> 
                            <div class="input-field">
                                <input class="input-field__date get-input" type="date" name="start-date" id="bgn" value="<?= $exp->period ?>">
                                <label class="input-field__label" for="bgn">Дата начала:</label>
                            </div>
                            <div class="input-field">
                                <input class="input-field__date get-input" type="date" name="end-date" id="end" value="<?= $exp->period_end ?>">
                                <label class="input-field__label" for="end">Дата окончания:</label>
                            </div> 
                            <div class="input-field">
                                <button class="btn primary" type="submit">
                                    <i class="icofont-ui-add"></i>
                                    <span class="body-bold">Добавить</span>
                                    
                                </button>
                            </div>
                           </form>  
                       
                    </div>
                </div>
            </div>           
               
          
        </main>
    </div>

    <!--Start Linq Scripts-->
    <?php 
     include_once 'layouts/scripts.php'; 
    ?>
    <script>
     document.querySelector('form').onsubmit = async e => {
      e.preventDefault();
      let response = await fetch("redact-experience.php?id_exp=<?= $id_exp ?>", { method: 'POST', body: new FormData(e.target) });
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
