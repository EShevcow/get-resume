  <?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/education.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$educat = new Education($db);

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
              <a class="nav-list_item active" href="education.php">
                <i class="icofont-university"></i>
               Образование<i class="icofont-simple-right"></i>
              </a>
            </li>
            <li>
             <a class="nav-list_item" href="portfolio.php">
                <i class="icofont-bag-alt"></i>
                 Портфолио
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
           <span class="card-title">Добавить Образование</span>
            
  <a href="add-education.php" class="btn-floating btn-large waves-effect waves-light grey darken-4">
    <i class="material-icons">add</i>
  </a>
            
          </div>
        </div>
     

        </div>

        <div class="col l12 s12">
         
        <?php 
        
        $count = $educat->countEducation();
        $edulust = $educat->readEducation();

        if($count > 0){
          while($result = $edulust->fetch(PDO::FETCH_ASSOC)){
             extract($result);

             echo '<div class="card hoverable">';
             echo '<div class="card-content">';
             echo "<p class='level'> {$level} </p>";
             echo "<span class='card-title'> {$institution} </span>";
             echo "<b class='exp-prof'> {$facultet} </b>";
             echo '<br>';
             echo "<b> {$specialization} </b>";
             echo "<p class='year-count'>{$period} - {$periodend} </p>";
             echo '</div>';

             echo "<div class='card-action'>
                   <a href='redact-education.php?id={$id}'>
                   <i class='icofont-pen-alt-4'></i>
                    Редактировать
                   </a>
                   <a delete-id='{$id}' class='red-text delete'>
                   <i class='icofont-ui-delete'></i>
                    Удалить
                   </a>
                   </div>";

             echo '</div>';
          }
        }
        else{
           echo '<div class="card">
                 <div class="card-content">
                 <span class="card-title">Образование отсутсвует</span>
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
        