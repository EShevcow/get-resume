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

$title_page = htmlspecialchars($row['profession']) . ' | ' . ' Добавление навыка';

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
                  <a class="nav-list_item" href="skills.php">
                    <i class="icofont-key"></i>
                    Ключевые навыки 
                  </a>
                </li>
                <li>
                  <a class="nav-list_item active" href="#">
                    <i class="icofont-ui-add"></i>
                     Добавление навыка <i class="icofont-simple-right"></i>
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

        if($skills->addSkill())
          {
            echo '<script>
                   var toastHTML = "<h1>Ключевой навык добавлен!</h1>";
                   M.toast({html: toastHTML});
                 </script>';
          }
          else {
            echo "<div class='alert-danger red z-depth-2'>Навык не был добавлен!</div>";
          }
      }


    ?>
              <div class="card">
                <div class="card-content">
        <span class="card-title">Добавление навыка</span>
        <form class="row" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
          <div class="input-field col l10 s12">
            <i class="icofont-brand-icofont prefix"></i>
            <input class="resume" type="text" name="icon">
            <label for="">Иконка навыка Icofont</label>
          </div>
          <div class="input-field col l10 s12">
            <i class="icofont-key prefix"></i>
            <input class="resume" type="text" name="title-skill">
            <label for="">Ключевой Навык</label>
          </div>
          <div class="input-field col l10 s12">
            <i class="icofont-drawing-tablet prefix"></i>
            <input class="resume" type="text" name="descript">
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