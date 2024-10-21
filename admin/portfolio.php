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

$title_page = htmlspecialchars($row['profession']) . ' | ' . " Проекты";

?>

<?php
include_once 'layout-head.php';
?>

<body>
     
    <div class="container-fluid">

        <div class="row">
        <div class="col s12">

          <?php
            include_once 'layout-header.php';
          ?>

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
             <a class="nav-list_item active" href="portfolio.php">
                <i class="icofont-bag-alt"></i>
                 Портфолио<i class="icofont-simple-right"></i>
             </a>
            </li>
            <li>
             <a class="nav-list_item" href="invites.php">
                <i class="icofont-ui-message"></i>
                Мои Приглашения
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

        <div class="card hoverable">
         <div class="card-content">
          <span class="card-title">Добавить Портфолио</span>

            <a href="add-portfolio.php" class="btn-floating btn-large waves-effect waves-light grey darken-4">
             <i class="material-icons">add</i>
            </a>

         </div>
       </div>
     

        </div>

        <div class="col l12 s12">
        
         <?php 
          $count = $portfolio->countPortfolio();

          if($count > 0){

                $ports = $portfolio->readPortfolio();
 
                while($port = $ports->fetch(PDO::FETCH_ASSOC))
                {
                     extract($port);

                 echo '<div class="col l4 s12">';
                 echo "<div class='card hoverable'>
                        <div class='card-image'>
                          <img src='img/works/{$image}'>";
                 echo    "<b class='card-title red-text lighten-2'>{$title}</b>
                        </div>";
                 echo  "<div class='card-content'>
                        <p> {$descript}</p>";
                 echo   "<a href='{$link}'>
                          <i class='icofont-look'></i>
                          Просмотр
                         </a>
                        </div>";
                 echo  "<div class='card-action'>
                        <a href='redact-portfolio.php?id={$id}'>
                        <i class='icofont-pencil-alt-5'></i>
                        Редактировать
                        </a>";
                 echo  "<a delete-id='{$id}' class='red-text darken-1 delete'>
                        <i class='icofont-ui-delete'></i>
                        Удалить
                        </a>
                       </div>
                   </div>";

                echo '</div>';
                }
          }
          else{
            echo '<div class="card">
                   <div class="card-content">
                    <span class="card-title">Портфолио отсутсвует</span>
                   </div>
                  </div> ';
          }
         
         ?>
        
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
           title: "Удаление Своего Проекта",
            message: "Вы уверены что хотите удалить текущий проект?",
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
                    $.post("objects/delete-portfolio.php", {
                        object_id: id
                    }, function(data) {
                        location.reload();
                    }).fail(function() {
                        alert("Невозможно удалить проект.");
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
        