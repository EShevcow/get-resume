<?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

// получаем ID элемента
$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/skills-info.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$skills = new Skills($db);

$skills->id = $id; 

$skills->readOneSkill();

$title_page = "Редактирование навыка ".$skills->title;

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
                  <a class="nav-list_item" href="#">
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
                  <a class="nav-list_item active" href="#">
                    <i class="icofont-pencil"></i>
                     <?php echo "Редактирование навыка ". $skills->title; ?><i class="icofont-simple-right"></i>
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
              
        
              <div class="col l10 s12">

<?php 
      
      if($_POST)
      {
        $skills->icon = htmlentities($_POST["icon"]);
        $skills->title = htmlentities($_POST["title-skill"]);
        $skills->description = htmlentities($_POST["descript"]);

        if($skills->updateOneSkill())
          {
            echo '<script>
                   var toastHTML = "<h1>Ключевой навык изменен!</h1>";
                   M.toast({html: toastHTML});
                 </script>';
          }
          else {
            echo "<div class='alert-danger red z-depth-2'>Навык не был изменен!</div>";
          }
      }


    ?>
              <div class="card">
                <div class="card-content">
        <span class="card-title">Добавление навыка</span>
        <form class="row" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]). "?id={$skills->id}" ?>" method="post">
          <div class="input-field col l10 s12">
            <i class="icofont-brand-icofont prefix"></i>
            <input class="resume" type="text" name="icon" value="<?= $skills->icon; ?>">
            <label for="">Иконка навыка Icofont</label>
          </div>
          <div class="input-field col l10 s12">
            <i class="icofont-key prefix"></i>
            <input class="resume" type="text" name="title-skill" value="<?= $skills->title; ?>">
            <label for="">Ключевой Навык</label>
          </div>
          <div class="input-field col l10 s12">
            <i class="icofont-drawing-tablet prefix"></i>
            <textarea class="materialize-textarea" name="descript" ><?= $skills->description; ?></textarea>
            <label for="">Описание Навыка</label>
          </div>
          <div class="input-field col l10 s12">
            <button type="submit" class="btn btn-large waves-effect waves-light">
            Добавить
           </button>
          </div>
         
        </form>
                </div>
              </div>

          </div>

        </section>

      </div>

    </div>
  </div>

<?php
 include_once 'layout-script.php';
?>

</body>

</html> 