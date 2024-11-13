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

  $user = new User($db);
  $exp = new Experience($db);
  $dt = new GetDate();
  $hd = new Header($db);

  $user->id = $_SESSION['id'];
  $hd->user_id = $_SESSION['id'];
  $user->readOneUser();
  $title_page = "Страница " . $user->fullname;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
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
    <div class="container">
        <div class="row">
            <div class="col l12">
                        <div class="card horizontal">
                <div class="card-image">
                    <img src="../libs/img/<?= $user->avatar; ?>">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="card-title"><?= $user->fullname; ?></div>
                    <p><?= $user->login; ?></p>
                    <p><?= $user->date_born; ?></p>
                    </div>
                    <div class="card-action">
                    <a href="#">This is a link</a>
                    </div>
                </div>
             </div>   
          </div>
        </div>
    </div>
<div class="container">
<div class="row">
<div class="col l12">
<?php 

$resums = $hd->readInfo();
$count = $hd->countResume();
echo $count;

function printResums($resums, $count ){
   if($count > 0){
   while($resums = $resums->fetch(PDO::FETCH_ASSOC)) {

          extract($resums);

          echo '<div class="card horizontal">';
          echo '<div class="card-image">';
          echo "<img src='../libs/img/{$avatar}'>";
          echo '</div>';
          echo '<div class="card-stacked">';
          echo '<div class="card-content">';
          echo "<div class='card-title'>{$profession}</div>";
          echo "<p>{$email}</p>";
          echo "<p>{$phone}</p>";
      #    echo "<blockquote>{$about}</blockquote>";
          echo '</div>';
          echo '<div class="card-action">';
          echo "<a href='redact-resume.php?id={$id}'>This is a link</a>";
          echo '</div>';
          echo '</div>';
          echo '</div>';
   }
  } 
  else {
    echo '<blockquote>Резюме пользователя отсутствуют!</blockquote>';
  }
}
$res = printResums($resums, $count);
$user->addResume($res, null, null, null, null, null);

foreach ($user->getResumes() as $resume) {
    echo $resume->getHeader();
}
?>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>