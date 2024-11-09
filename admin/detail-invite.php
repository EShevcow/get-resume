<?php

session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}

$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/invite-read.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$inv = new Invites($db);
$inv->id = $id; 

$inv->readOneInvite();

$title_page = "Приглашение от: ".$inv->name_or_company;

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
            <li>
             <a class="nav-list_item active" href="#">
                <i class="icofont-ui-message"></i>
                <?php echo "Приглашение от: ".$inv->name_or_company; ?>
                <i class="icofont-simple-right"></i>
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
          
            <p class="card-title"><?= $inv->name_or_company; ?></p>
            <p>
            <a href="tel:<?= $inv->phone; ?>"><?= $inv->phone; ?></a>
            </p>
            <p class="invite-message">
           <blockquote>
           <?= $inv->message; ?> 
          </blockquote>
          </p>  
            <span><?= $inv->sendtime; ?></span> 
          </div>
        </div>
        
   
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
            title: "Удаление Приглашения:",
            message: "Вы уверены что хотите удалить текущее приглашение?",
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
                    $.post("objects/delete-invite.php", {
                        object_id: id
                    }, function(data) {
                        location.reload();
                    }).fail(function() {
                        alert("Невозможно удалить приглашение!");
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
        