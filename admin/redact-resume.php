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

  $title_page = "Редактирование резюме: ".htmlspecialchars($row['profession']);

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
   <a class="nav-list_item" href="home.php">
   <i class="icofont-search-property"></i>
    Главная
  </a>
 </li>
  <li>
   <a class="nav-list_item active" href="#">
    Редактирование резюме <i class="icofont-simple-right"></i> 
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

<span class="card-title">Редактирование резюме</span>
<?php
 
 if($_POST){
 
 
 $resume->phone = htmlentities($_POST["phone"]);
 $resume->email = htmlentities($_POST["email"]);
 $resume->live_place = htmlentities($_POST["live_place"]);
 $resume->profession = htmlentities($_POST["profession"]);
 $resume->money = htmlentities($_POST["money"]);
 $resume->about = htmlentities($_POST['about']);


 if ($resume->updateResume()) {

   echo '<script>
         var toastHTML = "<h1> Резюме обновлено! </h1>";
         M.toast({html: toastHTML});
         </script>'; 
    
 }

 // Если не удается обновить резюме, сообщим об этом пользователю
 else {
   echo "<div class='alert-danger red z-depth-2'>
   
          <b>Профиль не был обновлен!<b>
   
        </div>";
       }
     } 
 ?>
<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
      method="POST">

<div class="input-field col l10 s12">
 <i class="icofont-worker prefix"></i>
<input class="resume" type="text" value="<?php echo "{$profession}" ?>" name="profession">
<label for="">Целевая Профессия</label>
</div>
<div class="input-field col l10 s12">
 <i class="icofont-telephone prefix"></i>
<input class="resume" type="tel" value="<?php echo "{$phone}" ?>" name="phone">
<label for="">Номер телефона</label> 
</div>
<div class="input-field col l10 s12">
 <i class="icofont-email prefix"></i>
<input class="email-input" type="email" value="<?php echo "{$email}" ?>" name="email">
<label for="">Email</label>  
</div>
<div class="input-field col l10 s12">
 <i class="icofont-money-bag prefix"></i>
<input class="resume" type="number" value="<?php echo "{$money}" ?>" name="money">
<label for="">Зарплатные ожидания</label>  
</div>
<div class="input-field col l10 s12">
 <i class="icofont-map-pins prefix"></i>
<input class="resume" type="text"  value="<?php echo "{$live_place}" ?>" name="live_place">
<label for="">Место жительства</label>
</div>
<div class="input-field col l10  s12">
 <i class="icofont-comment prefix"></i>
 <textarea class="materialize-textarea" name="about"><?php echo "{$about}" ?></textarea>
 <label for="" class="">О себе</label>
</div>
               
<button type="submit" class="btn btn-large waves-effect waves-light">
  <i class="icofont-save"></i> 
    Сохранить
</button> 
               
</form> 

</div>
</div> 
</div>
</section> 

</div>
</div>
</div>

<!-- Custom script -->
<script src="js/script.js"></script>
</body>
</html>
        