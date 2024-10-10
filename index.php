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

<style>
/* Adaptate */
@media screen and (max-width: 560px){
	.brand-logo{
		margin: 10px 0  0 0;
	}
    .page-title{
        font-size: 1.5em;
    }
	.avatar{
		display: flex;
		align-items: center;
		justify-content: center;
	}
	
	h1, h2, h3{
		text-align: center;
	}
	.profession{
		font-size: 3em;
	}
}
</style>

<!--Linq Jquery library-->
<script src="libs/js/jquery.js"></script>
<!--Materialize Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<body>

<?php
 include_once 'layout-navbar.php';
?>

<?php 
 include_once 'section-header.php';
?>
 
<main>

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

<?php
  include_once 'section-invite.php';
?>

</main>

<?php 
  include_once 'layout-footer.php';
?>

<?php 
  include_once 'other-scripts.php';
?>

</body>
</html>
