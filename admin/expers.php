<?php 
   
   session_start();
   if (!$_SESSION['id']) {
      header('Location: index.php');
  }

  include_once '../config/connect.php';
  include_once '../objects/user.php';
  include_once '../objects/header.php';
  include_once '../objects/experience.php';
  include_once '../objects/get-date.php';

  $database = new Connect;
  $db = $database->getConnect();

  $user = new User($db, $fullname, $gender, $avatar, $login, $password, $dateborn);
  $exp = new Experience($db);
  $dt = new GetDate();
  $exp->resume_id = $_COOKIE['resume_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../libs/icofont/icofont.min.css">
    <title>Document</title>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="profile.php">Home</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
  </nav>

<div class="container">
  <div class="row">
   <div class="col l12">
  

   <?php 
     $works = $exp->readExperience();
     $count = $exp->countExperience();
     function printexp($works, $count){
      if($count > 0){
        while($exps = $works->fetch(PDO::FETCH_ASSOC))
        {
             extract($exps);
  
          echo '<div class="card">
                 <div class="card-content">';
          echo "<b class='card-title'> {$comps} </b>";
          echo "<h5 class=''>
                  {$prof}
                </h5>";
          echo "<p class=''>
                 {$descs}
                </p>
               <br>";
          echo '<span class="" >';
          echo "{$period}"." - ";
               if($exps['period_end'] == Null)
               {
                echo "По сей день(Авось и ныне там 😅)";
                echo "<br>
                      <h6>
                      <b class='purple-text lighten-3'>";
                echo "</b>
                      </h6>";
               }
  
               else {
                echo "{$period_end}";
                echo "<br>
                      <h6>";
                    
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
            <a delete-id='{$id}' class=''>
            <i class='icofont-ui-delete'></i>
              Удалить
            </a>
          </div>
        </div>
      </div>
    </div>";
        
        }
      }
      else{
       echo '<blockquote>Опыт работы отсутствует!</blockquote>';
      }
     }
     $strrl = printexp($works, $count);
     $user->addResume(null, $strrl, null, null, null, null);

     foreach($user->getResumes() as $resume){
          echo $resume->getExperience();
     }
   ?> 
</div>
</div>
</div>

<script src="../libs/js/jquery.js"></script> 
<script src="../libs/js/materialize.min.js"></script> 
<script src="../libs/js/script.js"></script> 
</body>
</html>