<?php 

/*
session_start();
 if (!$_SESSION['user']) {
    header('Location: index.php');
 }
*/

  require_once 'config/connect.php';
  include_once 'objects/resume.php';
  include_once 'objects/add-subjects.php';

  $database = new Connect;
  $db = $database->getConnect();

  $resume = new Resume($db);
  $items = $resume->readInfo();

  $addexp = new AddSubjects($db);

?>

<?php 
  
  $row = $items->fetch(PDO::FETCH_ASSOC);
  extract($row);  

  $title_page = htmlspecialchars($row['profession']) . " | Добавление Опыта работы";

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
              <a class="nav-list_item active" href="#">  
              <i class="icofont-ui-add"></i>         
           Добавление Опыта работы <i class="icofont-simple-right"></i>
              </a>
            </li>
            <li class="divider">
            </li>
            <li>
              <a class="exit" href="#"> 
               <i class="icofont-exit"></i> 
                Выход
              </a>
            </li>
          </ul>
        </div>
       </div>

       <div class="col l9 s12">
       <?php 

if($_POST)
 {
    // установим значения свойствам товара
   $addexp->comps = $_POST["comp"];
   $addexp->prof = $_POST["prof"];
   $addexp->desc = $_POST["desc"];
   $addexp->period = $_POST["fdate"];
   $addexp->period_end = $_POST["edate"];

   if($addexp->addExperience())
   {
     echo '<script>
            var toastHTML = "<h1>Опыт работы добавлен!</h1>";
            M.toast({html: toastHTML});
          </script>';
   }
   else {
     echo "<div class='alert-danger'>Опыт не был добавлен!</div>";
   }
 } 
?>
        <section class="main-content">
              
          <div class="col s12 l6">

  <div class="card hoverable">
   <div class="card-content">
    <span class="card-title">Добавление Опыта работы</span>
    <form 
       action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" 
       method="post"  >
       <div class="input-field col l8 s12">
          <i class="icofont-company prefix"></i>
          <input type="text" class="resume" name="comp">
          <label for="">Название компании</label>
       </div>
       <div class="input-field col l8 s12">
          <i class="icofont-worker prefix"></i>
          <input type="text" class="resume" name="prof">
          <label for="">Должность</label>
       </div>
       <div class="input-field col l8 s12">
          <i class="icofont-card prefix"></i>
          <textarea class="materialize-textarea" name="desc"></textarea>
          <label for="">Краткое Описание</label>
      </div>
      <div class="input-field col l8 s12">
          <i class="icofont-calendar prefix"></i>
          <input type="date" class="resume" name="fdate">
          <label for="">Дата начала работы</label>
      </div>
      <div class="input-field col l8 s12">
         <i class="icofont-ui-calendar prefix"></i>
         <input type="date" class="resume"name="edate" >
        <label for="">Дата окончания</label>
      </div>
      <button type="submit" class="btn btn-large waves-effect waves-light">
        Добавить
        <i class="icofont-ui-add"></i>
      </button>
      </form>
             
                </div>
              </div>

          </div> 

        </section> 

       </div>

     </div>
    </div>

    </body>
  </html>
        