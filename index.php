<?php
  
  include_once 'config/connect.php';
  include_once 'objects/resume-info.php';
  include_once 'objects/get-date.php';
  include_once 'objects/send-invite.php';

  $database = new Connect();
  $db = $database->getConnect();
 
  $resume = new Resume($db);
  $dt = new GetDate();

  $invite = new InviteSend($db);

?>

<?php 
  $items = $resume->readInfo(); 
  $row = $items->fetch(PDO::FETCH_ASSOC);
  extract($row);

  $title = "Резюме | {$profession}";
?>

<?php 
 include_once 'layout-head.php';
?>

<body>
<main>
<?php
 include_once 'layout-navbar.php';
?>

<?php 
 include_once 'section-header.php';
?>
 

<?php 
 include_once 'section-experience.php';
?>

<?php 
 include_once 'section-skills.php';
?>

<?php 
 include_once 'section-education.php';
?>

<?php 
  include_once 'section-portfolio.php';
?>
</main>

<?php
  include_once 'section-invite.php';
?>

<?php 
  include_once 'layout-footer.php';
?>

<?php 
  include_once 'other-scripts.php';
?>
</body>
</html>

