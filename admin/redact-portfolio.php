  <?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/
$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/portfolio-info.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$portfolio = new Portfolio($db);

$portfolio->id = $id; 

$portfolio->readOnePortfolio();

$title_page = "Проект ".$portfolio->title;


?>

<?php

$row = $res->fetch(PDO::FETCH_ASSOC);
extract($row);

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
               <img src="libs/img/logo.png" alt="logotype"/>
              </a>
              
              <a href="#" data-target='dropdown1' class="right dropdown-trigger">
                <i class="icofont-navigation-menu"></i>
              </a>

             <ul id='dropdown1' class='dropdown-content'>
                <li>
                    <a class="nav-list_item" href="#">
                     Главная
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="#">
                     Опыт работы
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="#">
                      Ключевые навыки
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="#">
                     Образование
                    </a>
                  </li>
                  <li>
                   <a class="nav-list_item" href="#">
                       Портфолио
                   </a>
                  </li>
                  <li>
                   <a class="nav-list_item" href="#">
                      Мои Приглашения
                   </a>
                  </li>
            </ul>

            </div>
           </div>
        

       <div class="col l3">
        <div class="nav-panel hoverable">
          <div class="avatar">
            <img src="<?php echo "img/"."{$avatar}" ?>" alt="Avatar" class="circle responsive-img">
           
          </div>
          <p class="user_title"><?php echo "{$fullname}" ?></p>
          <hr>
          <ul  class="nav-list ">
            <li>
              <a class="nav-list_item" href="home.php">
                <i class="icofont-search-property"></i>
               Главная
              </a>
            </li>
            <li>
              <a class="nav-list_item" href="experience.php">
                <i class="icofont-brand-wordpress"></i>
               Опыт работы
              </a>
            </li>
            <li>
              <a class="nav-list_item" href="skills.php">
               <i class="icofont-key"></i>
                Ключевые навыки
              </a>
            </li>
            <li>
              <a class="nav-list_item" href="education.php">
                <i class="icofont-university"></i>
               Образование
              </a>
            </li>
            <li>
             <a class="nav-list_item" href="portfolio.php">
                <i class="icofont-bag-alt"></i>
                 Портфолио
             </a>
            </li>
            <li>
             <a class="nav-list_item active" href="#">
                <i class="icofont-pencil"></i>
                <?php echo "Редактирование ". $portfolio->title; ?> <i class="icofont-simple-right"></i>
             </a>
            </li>
            <li class="divider"></li>
            <!--
            <li>
              <a class="nav-list_item" href="#"> 
              <i class="icofont-settings-alt"></i>
                Настройки 
              </a>
            </li>
            -->
            <li>
              <a class="nav-list_item" href="#"> 
               <i class="icofont-exit"></i> 
                Выход
              </a>
            </li>
          </ul>
        </div>
       </div>

       <div class="col l9 s12">

    <section class="main-content">
              
      <div class="col l12 s12">
      <?php 
                   if($_POST)
                   
                   {
                    
                    
                    $portfolio->title = htmlentities($_POST["title"]);
                    $portfolio->descript = htmlentities($_POST["descript"]);
                    $portfolio->link = htmlentities($_POST["link"]); 
                   
                    $image = !empty($_FILES["image"]["name"])
                    ?  basename($_FILES["image"]["name"]) : " ";
                    $portfolio->image = $image;
                   
                    if ($portfolio->updatePotfolio()) {
                         
                   
                           echo '<script>
                            var toastHTML = "<h1> Портфолио Изменено! </h1>";
                            M.toast({html: toastHTML});
                            </script>'; 

                          echo $portfolio->uploadImgPort();  
                    }
                   
                   
                    else {
                      echo "<div class='alert-danger red z-depth-2'>
                      
                             <b>Не удалось изменить портфолио!<b>
                      
                           </div>";
                          }
                       
                   }

                 ?> 
      <div class="card hoverable">
      <div class="card-content">
    <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]. "?id={$portfolio->id}"); ?>" 
            method="post"
            enctype="multipart/form-data">

                <div class="file-field input-field">
                  <div class="btn">
                  <i class="icofont-image"></i>
                  <span>Prewiew Project</span>
                  <input type="file" name="image">
                  </div>
                   <div class="file-path-wrapper">
                    <input class="file-path validate" value="<?= $portfolio->image; ?>" type="text" placeholder="Загрузка превью проекта">
                     </div>
                  </div>

                    <div class="input-field col l12">
                    <i class="icofont-briefcase-1 prefix"></i>
                    <input type="text" value="<?= $portfolio->title; ?>" name="title">
                    <label for="">Название проекта</label>
                    </div> 

                    <div class="input-field col l12">
                    <i class="icofont-dashboard-web prefix"></i>
                    <textarea class="materialize-textarea" name="descript"><?= $portfolio->descript; ?>
                    </textarea>
                    <label for="">Описание проекта</label>
                    </div> 
                    
                    <div class="input-field col l12">
                    <i class="icofont-external-link prefix"></i>
                    <textarea class="materialize-textarea" name="link"><?= $portfolio->link; ?>
                    </textarea>
                    <label for="">Ссылка на проект</label>
                    </div> 

                    <button class="btn btn-large" type="submit"> 
                    Изменить
                    </button>
                  </form>
                </div>
                </div>

        </div>

        </section> 
       </div>
     </div>
    </div>
<!-- Materialize Bootbox -->
<script src="libs/js/mzbox.min.js"></script>


    </body>
  </html>
        