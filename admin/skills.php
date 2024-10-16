<?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/skills-info.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$skills = new Skills($db);

?>

<?php

$row = $res->fetch(PDO::FETCH_ASSOC);
extract($row);

$title_page = "Ключевые навыки";

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

        <div class="row">
          <div class="col l3">
            <div class="nav-panel hoverable">

              <div class="avatar">
                <img src="<?php echo "img/" . "{$avatar}" ?>" alt="Avatar" class="circle responsive-img">
              </div>

              <p class="user_title">
                <?php echo "{$fullname}" ?>
              </p>
              <hr>
              <ul class="nav-list ">
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
                  <a class="nav-list_item active" href="skills.php">
                    <i class="icofont-key"></i>
                    Ключевые навыки <i class="icofont-simple-right"></i>
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
              
        
              <div class="col s12">
              <table class="responsive-table centered white z-depth-2">
        <thead>
          <tr>
              <th>Иконка</th>
              <th>Навык</th>
              <th>Описание</th>
              <th>Редактировать</th>
              <th>Удалить</th>
          </tr>
        </thead> 

        <tbody> 
       

       <?php 

          $rows = $skills->readSkills();

          while($row = $rows->fetch(PDO::FETCH_ASSOC))
          {
                extract($row);

                echo " <tr>
                        ";

         echo "<td>
                <h5>    
                  <i class='icofont-{$icon}'></i>
                </h5> 
               </td> ";
                echo " <td><b> {$title}</b></td>";
                echo " <td><p> {$description}</p></td>";
                echo "<td>
              <a href='redact-skill.php?id={$id}' class='btn-small btn'>
                <i class='icofont-edit-alt'></i>
              </a> 
            </td>";
            echo "<td>
              <a delete-id='{$id}' class='btn-small btn red delete'>
              <i class='icofont-ui-delete'></i>
              </a> 
            </td>
          </tr>";

          }

       ?>
                  
        <tr>
          <td>
           <a href="add-skill.php" class="btn-floating btn-large waves-effect waves-light modal-trigger lime darken-1">
             <i class="icofont-ui-add"></i>
           </a>
         </td>
         <td colspan="2">
            <h5 class="orange-text darken-2">Добавить Ключевой Навык</h5>
         </td>
        </tr>   
          
        </tbody>
      </table>

          </div>

        </section>

      </div>

    </div>
  </div>

<?php
 include_once 'layout-script.php';
?>

  <script>
    // JavaScript для удаления товара
    $(document).on("click", ".delete", function() {
        const id = $(this).attr("delete-id");

        mzbox.confirm({
           title: "Удаление Навыка Работы",
            message: "Вы уверены что хотите удалить навык ?",
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
                    $.post("objects/delete-skill.php", {
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