<?php 

/*
session_start();
 if (!$_SESSION['user']) {
    header('Location: index.php');
 }
*/

   $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID."); 

   require_once 'config/connect.php';

   $database = new Connect();
   $db = $database->getConnect();

   include_once 'objects/resume.php';
   $resume = new Resume($db);

   // устанавливаем свойство ID товара для чтения
   $resume->id = $id; 

   $resume->readOneExp(); 

   $title_page = "Работа в компании: " . " $resume->comps;";
 
?>
<?php 

   $res = $resume->readInfo();
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
          </div>
     
    
     <div class="row">
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
               <i class="icofont-pencil"></i>
                 Редактирование <?php echo $resume->comps;  ?>   
                 <i class="icofont-simple-right"></i> 
              </a>
            </li>
          </ul>
          <hr>
          <ul>
            <li>
              <a class="exit" href="#"> 
              <i class="icofont-settings-alt"></i>
                Настройки 
              </a>
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
 #  $resume->id = $id;
   $resume->comps = $_POST["comp"];
   $resume->prof = $_POST["prof"];
   $resume->descs = $_POST["desc"];
   $resume->period = $_POST["fdate"];
   $resume->period_end = $_POST["edate"];

   if($resume->updateOneExp())
   {
     echo '<script>
            var toastHTML = "<h1>Опыт работы обновлен!</h1>";
            M.toast({html: toastHTML});
          </script>';
   }
   else {
     echo "<div class='alert-danger red'>Опыт не был обновлен!</div>";
   }
 } 
?>
        <section class="main-content">
              
          <div class="col s12 l6">

            <div class="card hoverable">
                <div class="card-content row">
                    <span class="card-title">Редактирование Опыта Работы</span>
    
     
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$resume->id}"); ?>" 
       method="post" >
           <div class="input-field col l10 s12">
          <i class="icofont-company prefix"></i>
          <input type="text" class="resume" value="<?= $resume->comps; ?>" name="comp">
          <label for="">Название компаннии</label>
       </div>
       <div class="input-field col l10 s12">
          <i class="icofont-worker prefix"></i>
          <input type="text" class="resume" value="<?= $resume->prof; ?>" name="prof">
          <label for="">Должность</label>
       </div>
       <div class="input-field col l10 s12">
          <i class="icofont-card prefix"></i>
          <textarea class="materialize-textarea" name="desc"><?= $resume->descs; ?></textarea>
          <label for="">Краткое Описание</label>
      </div>
      <div class="input-field col l10 s12">
          <i class="icofont-calendar prefix"></i>
          <input type="date" class="resume" value="<?= $resume->period; ?>" name="fdate">
          <label for="">Дата начала работы</label>
      </div>
      <div class="input-field col l10 s12">
         <i class="icofont-ui-calendar prefix"></i>
         <input type="date" class="resume" value="<?= $resume->period_end; ?>" name="edate" >
        <label for="">Дата окончания</label>
      </div>
      <div class="input-field col l6">
       <button type="submit" class="btn btn-large waves-effect waves-light">
       изменить
        
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
