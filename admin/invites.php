  <?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/core.php';
include_once 'objects/invite-read.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$inv = new Invites($db);
$rows = $inv->readInvites($from_record_num, $records_per_page);
$num = $inv->countInvites();

?>

<?php

$row = $res->fetch(PDO::FETCH_ASSOC);
extract($row);

$title_page = htmlspecialchars($row['profession']) . ' | ' . " Мои приглашения";

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
                    <a class="nav-list_item" href="home.php">
                     Главная
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="experience.php">
                     Опыт работы
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="skills.php">
                      Ключевые навыки
                    </a>
                  </li>
                  <li>
                    <a class="nav-list_item" href="education.php">
                     Образование
                    </a>
                  </li>
                  <li>
                   <a class="nav-list_item" href="portfolio.php">
                       Портфолио
                   </a>
                  </li>
                  <li>
                   <a class="nav-list_item" href="invites.php">
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
             <a class="nav-list_item active" href="invites.php">
                <i class="icofont-ui-message"></i>
                Мои Приглашения <i class="icofont-simple-right"></i>
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
          <span class="card-title">Список приглашений</span> 
         </div>
       </div>
     
    
      <?php

        if($num > 0){

         echo '<table class="centered striped white z-depth-2">
               <thead>
               <tr>
               <th>Компания</th>
               <th>Менеджер</th>
               <th>Телефон</th>
               <th>Почта</th>
               <th>Время</th>
               <th>Просмотр</th>
               <th>Удалить</th>
               </tr>
               </thead>
               <tbody>';

          while ($row = $rows->fetch(PDO::FETCH_ASSOC))
         {
           extract($row); 

           echo "<tr>";
           echo "<td>{$company}</td>";
           echo "<td>{$manager}</td>";
           echo "<td>{$number}</td>";
           echo "<td>{$email}</td>";
           echo "<td>{$sendtime}</td>";

           echo "<td>
                  <a href='detail-invite.php?id={$id}' class='btn btn-small'>
                    <i class='icofont-look'></i>
                  </a>
                </td>";

           echo "<td>
                 <a delete-id='{$id}' class='btn-small btn red delete'>
                 <i class='icofont-ui-delete'></i>
                 </a>
               </td>";

          
         }

         echo '</tbody>
               </table>';  
          if($num > $records_per_page){
            // страница, на которой используется пагинация
            $page_url = "invites.php?";

            // подсчёт всех записей в базе данных, чтобы подсчитать общее количество страниц
            $total_rows = $num;

             // пагинация
             include_once 'paging.php';  
          }
       

        }
        else {

        echo "<div class='card'>
               <div class='card-content'>
                <p class='card-title'><b>Приглашения отсутствуют<b></p>
               </div>
             </div>";
                
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
        