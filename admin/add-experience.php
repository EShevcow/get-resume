<?php 
   
   session_start();
   if (!$_SESSION['id']) {
      header('Location: index.php');
  }
 

  include_once '../config/connect.php';
  include_once '../objects/user.php';
  include_once '../objects/header.php';
  include_once '../objects/experience.php';
  include_once '../objects/get-date.php';

  $database = new Connect;
  $db = $database->getConnect();

  $user = new User($db);
  $dt = new GetDate();
  $exp = new Experience($db);

  $exp->user_id = $_SESSION['id'];
  $exp->resume_id = $_SESSION['resume_id'];

 # $works = $exp->readExperience();
 # $count = $exp->countExperience();
 

  $title_page = "Добавление опыта работы для: " . $_COOKIE['prof'];
  
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

        <!--Start Sidenav-->
        <aside class="column">
           
            <div class="sidenav">
                <div class="sidenav__wrap">
                    <a href="head-resume.php?id=<?= $_SESSION['resume_id'] ?>" class="sidenav__item">
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
        <!--/End Sidenav-->

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
                     <span class="bredcrumb__label">Добавление опыта работы</span>
 
                 </a>
                
             </div>
          </div> 
       </div>
     <!--/End Breadcrumb Nav-->
     <?php 
      
        
        if($_POST){
           
      
                $exp->comps =  htmlspecialchars($_POST["comp"]);
                $exp->category = htmlspecialchars($_POST["category"]);
                $exp->prof = htmlspecialchars($_POST["prof"]);
                $exp->descs = htmlspecialchars($_POST["desc"]);
                $exp->user_id;
                $exp->resume_id;
                $exp->period = htmlspecialchars($_POST["start-date"]);
                $exp->period_end = htmlspecialchars($_POST["end-date"]);
                
               # try{

                   # var_dump($exp->user_id);
                   # var_dump($exp->resume_id);
                   # var_dump($exp);

                if($exp->addExperience()){
                   echo "<script>
                            setTimeout(() => {
                           $('#send-notif').slideToggle();
                            }, 3000);
                        </script>";
                }
                else{
                
                  echo "<script>
                         alert('Error Add Experience');
                       </script>";

                }
        }
    
     ?>
            <!--Start Experience Block-->  
           <div class="card-vertical">
              <div class="card__wrap">

              <div class="notif-block" id="send-notif">
            <div class="notif-block__wrap notif-block__success">
                <span class="large-icon">
                    <i class="icofont-check-circled"></i>
                </span>
                <span class="text-body">
                  Success
                </span>
            </div>
        </div>   
           
                <h3>Добавить опыт работы</h3>
                 <div class="card__text-block">
                    <form class="column" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            
                        <div class="input-field">
                            <input class="input-field__input get-input" id="txt" name="comp" type="text">
                            <label class="input-field__label" for="txt">Название компании:</label>
                        </div>
                        <div class="input-field">
                            <select class="input-field__select" name="category" id="sel1">  
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
                            <input class="input-field__input get-input" id="txt" name="prof" type="text">
                            <label class="input-field__label" for="txt">Профессия:</label>
                        </div>
                        <div class="input-field">  
                            <textarea class="input-field__textarea get-textarea" id="dsc" name="desc"></textarea>
                            <label class="input-field__label" for="dsc">Описание работы:</label>
                        </div> 
                        <div class="input-field">
                            <input class="input-field__date get-input" type="date" name="start-date" id="bgn">
                            <label class="input-field__label" for="bgn">Дата начала:</label>
                        </div>
                        <div class="input-field">
                            <input class="input-field__date get-input" type="date" name="end-date" id="end">
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
            <!--/End Experience Block-->   
          
        </main>
    </div>

    <!--Start Modal Window-->
    <!--/End Modal Window-->

    <!--Start Linq Scripts-->
    <?php 
     include_once 'layouts/scripts.php';
    ?>
    <!--/End Linq Scripts-->
</body>
</html>
