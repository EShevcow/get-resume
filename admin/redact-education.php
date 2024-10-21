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
include_once 'objects/education.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$educat = new Education($db);

// устанавливаем свойство ID товара для чтения
$educat->id = $id; 

$educat->readOneEducation(); 

$title_page = "Редактирование заведеня: " .  $educat->institution;

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
             <a class="nav-list_item active" href="#">
               <i class="icofont-pencil"></i>
                 Редактирование:  <?php echo $educat->institution;?>
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
           <span class="card-title">Добавить Образование</span>

         <?php 
         if($_POST){

          $educat->level = $_POST['level'];
          $educat->institute = $_POST['inst'];
          $educat->facultet = $_POST["facult"];
          $educat->special = $_POST["special"];
          $educat->period = $_POST["fdate"];
          $educat->periodend = $_POST["edate"];

          try{
             $educat->updateOneEducation();
             echo '<script>
                      var toastHTML = "<h1>Учебное заведение добавлено!</h1>";
                      M.toast({html: toastHTML});
                  </script>';
          }
          catch (Exception $e){
            echo "<div class='alert-danger red'>Учебное заведение не было добавлено!</div>";
          }
          
         }
         ?>
           
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]). "?id={$educat->id}" ?>" method="POST">
            <p class='level'><?= $educat->level; ?>  </p>
              <div class="input-field">
               
              <select name="level">
                <option value="<?= $educat->level; ?>" selected><?= $educat->level; ?></option>
                <option value="Среднее Специальное">Среднее Специальное</option>
                <option value="Неоконченное Высшее">Неоконченное Высшее</option>
                <option value="Высшее Бакалавр">Высшее Бакалавр</option>
                <option value="Высшее Магистратура">Высшее Магистратура</option>
                <option value="Высшее Специальное">Высшее Специальное</option>
                <option value="Аспирантира и выше">Аспирантира и выше</option>
                </select> 
                <label for="">Уровень Образования</label>
              </div>

                <div class="input-field">
                  <i class="icofont-university prefix"></i>
                  <input class="resume" type="text" name="inst"  value="<?= $educat->institution; ?>" autocomplete>
                  <label for="">Учебное Заведение</label>
                </div>
                <div class="input-field">
                  <i class="icofont-book-alt prefix"></i>
                  <input class="resume" type="text" name="facult"  value="<?= $educat->facultet; ?>" autocomplete>
                  <label for="">Факультет</label>
                </div>
                <div class="input-field">
                  <i class="icofont-worker prefix"></i>
                  <input class="resume" type="text" name="special"  value="<?= $educat->specialization; ?>" autocomplete>
                  <label for="">Специальность</label>
                </div>
                <div class="input-field">
                  <i class="icofont-calendar prefix"></i>
                  <input class="resume" type="date" value="<?= $educat->period; ?>" name="fdate"   autocomplete>
                  <label for="">Дата начала обучения</label>
              </div>
              <div class="input-field">
                 <i class="icofont-ui-calendar prefix"></i>
                 <input class="resume" type="date" value="<?= $educat->periodend; ?>" name="edate"   autocomplete>
                <label for="">Дата окончания</label>
              </div>
              <button type="submit" class="btn btn-large waves-effect waves-light">
                <i class="icofont-ui-add"></i>
                Добавить
              </button>
            </form>

         
          </div>
        </div>
     

        </div>

        <div class="col l12 s12">
         
         
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
            message: "Вы уверены что хотите удалить текущее место работы ?",
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
                    $.post("delete-exp.php", {
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
        