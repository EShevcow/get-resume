<?php 

/*
session_start();
 if (!$_SESSION['user']) {
    header('Location: index.php');
 }
*/

  require_once 'config/connect.php';
  include_once 'objects/resume.php';

  $database = new Connect;
  $db = $database->getConnect();

  $resume = new Resume($db);
  $items = $resume->readInfo();

?>

<?php 
  
  $row = $items->fetch(PDO::FETCH_ASSOC);
  extract($row);  

  $title_page = htmlspecialchars($row['profession']);

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
<img src="<?php echo "img/"."{$avatar}" ?>" alt="Avatar" class="circle responsive-img">          
</div>

<p class="user_title"><?php echo "{$fullname}" ?></p>
<hr>

<ul  class="nav-list ">
  <li>
   <a class="nav-list_item active" href="#">
   <i class="icofont-search-property"></i>
    Главная <i class="icofont-simple-right"></i>
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
  <li class="divider"></li>
  <li>
   <a class="nav-list_item" href="#"> 
   <i class="icofont-settings-alt"></i>
    Настройки 
  </a>
 </li>
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
<div class="col s12 l6">
 
<div class="card hoverable">
<div class="card-content">

<?php 
  
  if($_POST){

    $resume->fullname = htmlentities($_POST["fullname"]);
    $avatar = !empty($_FILES["avatar"]["name"])
    ?  basename($_FILES["avatar"]["name"]) : "";
    $resume->avatar = $avatar;

    if ($resume->updateHome()) {

       echo '<script>
               var toastHTML = "<h1> Аватар изменен! </h1>";
               M.toast({html: toastHTML});
              </script>'; 
     
       echo $resume->uploadAvatar();      
      }
     
      // Если не удается обновить аватар
      else {
        echo "<div class='alert-danger z-depth-2'>
        
               <b> Аватар не был обновлен!<b>
        
             </div>";
            }

  }
?>

<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
      method="POST" 
      enctype="multipart/form-data">
 
<div class="file-field input-field">
 <img src="<?php echo "img/"."{$avatar}" ?>" alt="" class="responsive-img">
 <a href="#">
<input type="file" name="avatar">
<?php 
  if($row['avatar'] == Null){
            echo "<b>Загрузить Фото Профиля</b>";
          } 
          else{
            echo "";
          }
 ?>

</a>
</div>
                        
<div class="input-field">
<i class="icofont-user-alt-4 prefix"></i>
<input class="name-user" type="text" value="<?php echo "{$fullname}" ?>" name="fullname">
<label for="" >Полное имя</label>
</div>
<button type="submit" class="waves-effect waves-light btn">
<i class="icofont-save"></i>
   Сохранить
</button>
                     
</form>
</div>
</div>
 
<div class="card hoverable">
<div class="card-content">
<span class="card-title"><?php echo "{$profession}" ?></span>
 <a href="mailto:<?php echo "{$email}" ?>"><?php echo "{$email}" ?></a>
 <br>
<a href="tel:<?php echo "{$phone}" ?>"><?php echo "{$phone}" ?></a>
</div>
<div class="card-action">
                    
 <a class="btn" href="redact-resume.php">
  <i class="icofont-pen-alt-4"></i> 
    Редактировать
</a>
</div>
</div>
 
</div>  
</section> 
</div>

</div>

</div>
</div>
</div>

<!--JavaScript at end of body for optimized loading-->
<script src="libs/js/materialize.min.js"></script>
<!-- Custom script -->
<script src="libs/js/script.js"></script>

</body>
</html>