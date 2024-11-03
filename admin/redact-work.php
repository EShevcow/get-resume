<?php 

session_start();
 if (!$_SESSION['user']) {
    header('Location: index.php');
 }


$id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID."); 

   require_once 'config/connect.php';
   include_once 'objects/resume.php';
   include_once 'objects/experience.php';

   $database = new Connect();
   $db = $database->getConnect();

   
   $resume = new Resume($db);
   $exp = new Experience($db);

   // устанавливаем свойство ID для чтения
   $exp->id = $id; 

   $exp->readOneExp(); 

   $title_page = "Работа в компании: " . " $exp->comps;";
 
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
              <a class="nav-list_item active" href="#">
               <i class="icofont-pencil"></i>
                 Редактирование <?php echo $exp->comps;  ?>   
                 <i class="icofont-simple-right"></i> 
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
 #  $resume->id = $id;
   $exp->comps = $_POST["comp"];
   $exp->prof = $_POST["prof"];
   $exp->descs = $_POST["desc"];
   $exp->period = $_POST["fdate"];
   $exp->period_end = $_POST["edate"];

   if($exp->updateOneExp())
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
    
     
<form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$exp->id}"); ?>" 
       method="post" >
           <div class="input-field col l10 s12">
          <i class="icofont-company prefix"></i>
          <input type="text" class="resume" value="<?= $exp->comps; ?>" name="comp">
          <label for="">Название компаннии</label>
       </div>
       <div class="input-field col l10 s12">
          <i class="icofont-worker prefix"></i>
          <input type="text" class="resume" value="<?= $exp->prof; ?>" name="prof">
          <label for="">Должность</label>
       </div>
       <div class="input-field col l10 s12">
          <i class="icofont-card prefix"></i>
          <textarea class="materialize-textarea" name="desc"><?= $exp->descs; ?></textarea>
          <label for="">Краткое Описание</label>
      </div>
      <div class="input-field col l10 s12">
          <i class="icofont-calendar prefix"></i>
          <input type="date" class="resume" value="<?= $exp->period; ?>" name="fdate">
          <label for="">Дата начала работы</label>
      </div>
      <div class="input-field col l10 s12">
         <i class="icofont-ui-calendar prefix"></i>
         <input type="date" class="resume" value="<?= $exp->period_end; ?>" name="edate" >
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
