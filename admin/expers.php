<?php 
  
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

   <?php 

    $user_info = $user->readInfo();
    $count_users = $user->countAll();

    function printuser($user_info, $count_users){
      if($count_users > 0){
        while($nfo = $user_info->fetch(PDO::FETCH_ASSOC)){
           extract($nfo);

           echo '<div>';
           echo "<img src='../libs/img/{$avatar}' alt='avatar'>";
           echo "<h3>{$fullname}</h3>";

           if($gender == "man"){
               echo '<b>Мужчина</b>';
           }
           else{
               echo '<b>Женщина</b>';
           }
           echo "<p>{$login}</p>";
           echo "<p>{$date_born}</p>";

           echo '</div>';
        }
      }
      else{
        echo "<h1>Нет зарегистрированных пользователей</h1>";
      }
    }
    
    printuser($user_info, $count_users);

   ?>

   <?php 
     $works = $exp->readExperience();

     function printexp($works){
        while($exps = $works->fetch(PDO::FETCH_ASSOC))
        {
             extract($exps);
  
          echo '<div class="row">
                 <div class="">
                 <div class="card">
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
     $strrl = printexp($works);
     $user->addResume(null, $strrl, null, null, null, null);

     foreach($user->getResumes() as $resume){
          echo $resume->getExperience();
     }
   ?> 
</body>
</html>