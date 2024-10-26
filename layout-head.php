<!doctype html>
<html lang="en">
<head> 
  <title><?php echo $title ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="libs/img/icon.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="libs/icofont/icofont.css">
  <link rel="stylesheet" href="libs/css/materialize.min.css">
  <link rel="stylesheet" href="libs/css/animate.css">
  <link rel="stylesheet" href="libs/carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="libs/css/style.css">
  <style>
     @font-face {
        font-family: Arial, Helvetica, sans-serif;
        src: url(libs/fonts/arial.ttf);
       }
       main{
        font-family: Arial, Helvetica, sans-serif;
       }
  blockquote{
    border-color: royalblue;
  }
  .alert-danger{
    padding: 10px 5px 10px 10px;
	  margin: 15px 0 10px 0;
    text-transform: capitalize;
    font-size: 1.5em;
	  border-radius: 3px;
	  box-shadow: #212121 3px;
    color: white;
	  background: red;
    font-weight: bold;
  }
  .alert-succes{
 	padding: 15px 10px 15px 15px;
	margin: 1em 0 1em 0;
  border-radius: 3px;
  text-transform: capitalize;
  font-size: 1.5em;
	color: white;
	background: yellowgreen;
  font-weight: bold;
  }
  .character-counter{
    color: white;
    font-size: 1em!important;
    font-weight: bold;
  }
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
<!-- Jquery Library -->
<script src="libs/js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<!-- Materialize Js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
