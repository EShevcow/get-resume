<?php

/*
session_start();
if (!$_SESSION['user']) {
header('Location: index.php');
}
*/

require_once 'config/connect.php';
include_once 'objects/resume.php';
include_once 'objects/get-date.php';
include_once 'objects/experience.php';

$database = new Connect;
$db = $database->getConnect();

$resume = new Resume($db);
$res = $resume->readInfo();

$exp = new Experience($db);

?>

<?php

$row = $res->fetch(PDO::FETCH_ASSOC);
extract($row);

$title_page = "Опыт работы";

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
                  <a class="nav-list_item active" href="#">
                    <i class="icofont-brand-wordpress"></i>
                    Опыт работы <i class="icofont-simple-right"></i>
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
                  <a class="nav-list_item" href="#">
                    <i class="icofont-bag-alt"></i>
                    Портфолио
                  </a>
                </li>
                <li>
                  <a class="nav-list_item" href="#">
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

          <?php  

          $dt = new GetDate();

          $experinces = $exp->readExperience();
          $count = $exp->countExperience();
          ?>   
            <section class="main-content">
              
        
              <div class="col l12 s12">

               <div class="card">
                  <div class="card-content">
                    <span class="card-title">Добавить Опыт работы</span>
                    <a href="add-work.php" class="btn-floating btn-large blue waves-effect"><i
                        class="material-icons">add</i></a>
                  </div>
               </div> 

 <?php 
 if($count > 0){
  while($exp = $experinces->fetch(PDO::FETCH_ASSOC)){

    $podate = $exp['period'];
    $endate = $exp['period_end'];

    $y = $dt->getYear($podate);
    $m = $dt->getMonth($podate);
    $d = $dt->getDay($podate);
    $yeval = $dt->getAge($y, $m, $d);
    $mval = (12 - $m) + date('m');
    
    $endt = explode("-", $endate);
    $yend = $endt[0];
    $endmonth = $endt[1];
    $endday = $endt[2];
    
    $endmval = $endmonth - $m;

     extract($exp);

  echo '<div class="card hoverable">
         <div class="card-content">';
  echo "<b class='card-title'> {$comps} </b>";
  echo "<h5>
          {$prof}
        </h5>";
  echo "<blockquote>
         {$descs}
        </blockquote>
       <br>";
  echo '<span class="red-text accent-2" >';
  echo "{$period}"." - ";
       if($exp['period_end'] == Null)
       {
        echo "По сей день(Авось и ныне там 😅)";
        echo "<br>
              <h6>
              <b class='purple-text lighten-3'>";
        echo $yeval." Years " . $mval . " Monthes";
        echo "</b>
              </h6>";
       }

       else {
        echo "{$period_end}";
        echo "<br>
              <h6>
              <b class='purple-text lighten-3'>";
        echo   $yend - $y ." Years " . $endmval . " Monthes";
        echo "</b>
              </h6>";

      }
  echo "</span>";
       
  echo "</span>
  </div>";

echo "<div class='card-action'>
    <a href='redact-work.php?id={$id}'>
    <i class='icofont-pencil-alt-5'></i>
      Редактировать
    </a>
    <a delete-id='{$id}' class='red-text lighten-2 delete'>
    <i class='icofont-ui-delete'></i>
      Удалить
    </a>
  </div>
</div>"; 
  }
 }
 else{
  echo '<div class="card">
          <div class="card-content">
              <span class="card-title">Опыт работы отсутсвует</span>
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
                    $.post("objects/delete-exp.php", {
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