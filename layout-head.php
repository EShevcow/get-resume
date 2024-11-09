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
  <link rel="stylesheet" href="libs/css/style.css">
  <link rel="stylesheet" href="libs/css/resume.css">
  <style>
    .avatar img {
	      height: 100%;
    }
    .card-info .card-content{
      padding-bottom: 0;
    }
    .send-invite{
        padding: 0;
        background-image: url(libs/img/kristopher.jpg);
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .card-content p{
        padding: 0;
      }
      .count-exp{
        font-size: 1.5em;
        color: orangered;
      }
      .exp-prof{
	      color: #42a5f5;
        font-size: 1.2em;
       }
       blockquote{
        border-color: #42a5f5;
        font-size: 1.1em;
       }
       .about blockquote{
         font-size: 1.5em;
         color: #212121;
       }
       .period{
        padding: 5px 0 10px 0;
        font-size: 1.1em;
        color: #42a5f5;
       }
       .overlay {
        min-height: 500px;
        padding: 50px 0 30px 0;
        background-color: rgba(0, 0, 0, 0.7);
       }
       .footer-copyright .row{
        margin-bottom: 0;
       }
       .live-int{
        padding-top: 10px;
      }
      /* Adaptate */
      @media screen and (max-width: 560px){
        html{
          overflow-x: hidden;
         
        }
      .brand-logo{
        margin: 10px 0 0 0;
      }
      .page-title{
        font-size: 1.5em;
      }
      .avatar img{
        width: auto;
        margin: 0px;
      }
      .card-info .card-content{
         padding-bottom: 1em;
       }
      .count{
        font: 1em sans-serif;
      }
      h1, h2,{
        text-align: center;
      }
      .profession{
        font-size: 1em;
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
