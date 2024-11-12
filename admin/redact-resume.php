<?php 

  
  session_start();
  if (!$_SESSION['id']) {
     header('Location: index.php');
  }

  // получаем ID пользователя
  $id = isset($_GET["id"]) ? $_GET["id"] : die("ERROR: отсутствует ID.");

  include_once '../config/connect.php';
  include_once '../objects/user.php';
  include_once '../objects/header.php';
  include_once '../objects/experience.php';
  include_once '../objects/get-date.php';

  $database = new Connect;
  $db = $database->getConnect();

  $user = new User($db);
  $exp = new Experience($db);
  $dt = new GetDate();
  $hd = new Header($db);

  $user->id = $_SESSION['id'];
  $hd->user_id = $_SESSION['id'];
  $hd->id = $id;
  $user->readOneUser();
  $title_page = "Страница " . $user->fullname;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../libs/icofont/icofont.min.css">
    <title><?php echo $title_page; ?></title>
    <style>
      body{
        background: lavender;
      }
      img{
        max-height: 200px;
      }  
    </style>
</head>
<body>
<script src="../libs/js/jquery.js"></script> 
<script src="../libs/js/materialize.min.js"></script> 
<script src="../libs/js/script.js"></script> 

<div class="container">
<div class="row">
<div class="col l12">
<?php 

$resums = $hd->readInfo();
$count = $hd->countResume();
echo $count;

function redactResume($resums, $count, $hd){
   if($count > 0){
   while($resums = $resums->fetch(PDO::FETCH_ASSOC)) {
    if($_POST){
 
 
      $hd->phone = htmlentities($_POST["phone"]);
      $hd->email = htmlentities($_POST["email"]);
      $hd->live_place = htmlentities($_POST["live_place"]);
      $hd->profession = htmlentities($_POST["profession"]);
      $hd->money = htmlentities($_POST["money"]);
      $hd->about = htmlentities($_POST['about']);
     
     
      if ($hd->updateResume()) {
     
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

          extract($resums);

echo "<form action=" . htmlspecialchars($_SERVER["PHP_SELF"]. "?id={$id}") . ' method="POST">';

 echo '<div class="input-field col l10 s12">
       <i class="icofont-worker prefix"></i>';
echo "<input class='resume' type='text' value='{$profession}' name='profession'>";
echo '<label for="">Целевая Профессия</label>
</div>
<div class="input-field col l10 s12">
 <i class="icofont-telephone prefix"></i>';
echo "<input class='resume' type='tel' value='{$phone}' name='phone'>";
echo '<label for="">Номер телефона</label> 
</div>
<div class="input-field col l10 s12">
 <i class="icofont-email prefix"></i>';
echo "<input class='email-input' type='email' value='{$email}' name='email'>";
echo '<label for="">Email</label>  
</div>
<div class="input-field col l10 s12">
 <i class="icofont-money-bag prefix"></i>';
echo "<input class='resume' type='number' value='{$money}' name='money'>";
echo '<label for="">Зарплатные ожидания</label>  
</div>
<div class="input-field col l10 s12">
 <i class="icofont-map-pins prefix"></i>';
echo "<input class='resume' type='text'  value='{$live_place}' name='live_place'>";
echo '<label for="">Место жительства</label>
</div>
<div class="input-field col l10  s12">
 <i class="icofont-comment prefix"></i>';
echo "<textarea class='materialize-textarea' name='about'>{$about}</textarea>";
echo'<label for="" class="">О себе</label>
</div>
               
<button type="submit" class="btn btn-large waves-effect waves-light">
  <i class="icofont-save"></i> 
    Сохранить
</button> 
               
</form> ';

   }
  } 
  else {
    echo '<blockquote>Резюме пользователя отсутствуют!</blockquote>';
  }
}
$res = redactResume($resums, $count, $hd);
$user->addResume($res, null, null, null, null, null);

foreach ($user->getResumes() as $resume) {
    echo $resume->getHeader();
}
?>


</div>
</div>
</div>



</body>
</html>