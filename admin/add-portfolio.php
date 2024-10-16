  <?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/portfolio-info.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$portfolio = new Portfolio($db);

?>

<?php

$row = $res->fetch(PDO::FETCH_ASSOC);
extract($row);

$title_page = htmlspecialchars($row['profession']) . ' | ' . "Образование";

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
                <i class="icofont-ui-add"></i>
                Добавление портфолио <i class="icofont-simple-right"></i>
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
                    ?  basename($_FILES["image"]["name"]) : "";
                    $portfolio->image = $image;
                   
                    try {
                         
                          $portfolio->addPortfolio();
                           echo '<script>
                            var toastHTML = "<h1> Портфолио Добавлено! </h1>";
                            M.toast({html: toastHTML});
                            </script>'; 

                            echo $portfolio->uploadImgPort();  
                    }
                   
                   
                    catch (Exception $e) {
                      echo "<div class='alert-danger z-depth-2'>
                             <b>Не удалось Добавить портфолио!<b>
                           </div>";
                          }
                       
                   }

                 ?> 
      <ul class="collapsible">
    <li>
      <div class="collapsible-header">
      <i class="icofont-database-add"></i>
      <span>Добавить Портфолио</span>
      </div>
      <div class="collapsible-body grey lighten-5">
      <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
            method="post"
            enctype="multipart/form-data">

                <div class="file-field input-field">
                  <div class="btn">
                  <i class="icofont-image"></i>
                  <span>Prewiew Project</span>
                  <input type="file" class="resume" name="image">
                  </div>
                   <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Загрузка превью проекта">
                     </div>
                  </div>

                    <div class="input-field col l12">
                    <i class="icofont-briefcase-1 prefix"></i>
                    <input type="text" class="resume" name="title">
                    <label for="">Название проекта</label>
                    </div> 

                    <div class="input-field col l12">
                    <i class="icofont-dashboard-web prefix"></i>
                    <input type="text" class="resume" name="descript">
                    <label for="">Описание проекта</label>
                    </div> 
                    
                    <div class="input-field col l12">
                    <i class="icofont-external-link prefix"></i>
                    <input type="text" class="resume" name="link">
                    <label for="">Ссылка на проект</label>
                    </div> 

                    <button class="btn btn-large" type="submit">
                    <i class="icofont-ui-add"></i>   
                    Добавить
                    </button>
                  </form>

                  </div>
                 </li>
                 </ul>    
     

        </div>

        </section> 
       </div>
     </div>
    </div>
<!-- Materialize Bootbox -->
<script src="libs/js/mzbox.min.js"></script>
<script>
    // JavaScript для удаления товара
    $(document).on("click", ".delete", function() {
        const id = $(this).attr("delete-id");

        mzbox.confirm({
           title: "Удаление Места Работы",
            message: "Вы уверены что хотите удалить текущее место учебы ?",
            buttons: {
                   ok: {
                      label: 'OK',
                      default: true
    
                },
                cancel: {
                    label: " Нет",
                   
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post("objects/delete-education.php", {
                        object_id: id
                    }, function(data) {
                        location.reload();
                    }).fail(function() {
                        alert("Невозможно удалить.");
                    });
                }
                else {
                  alert("В следующий раз точчно удалим!('_')");
                }
            }
        });

        return false;
    });
</script>

    </body>
  </html>
        