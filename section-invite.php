<section id="contacts" class="send-invite spy">

<div class="overlay">
<div class="container">
<div class="row">

<div class="col s12">

<h3 class="page-title white-text">
           Пригласить на собеседование
</h3>

<?php 

if($_POST)
  {
    $invite->company = htmlentities($_POST['company']);
    $invite->manager = htmlentities($_POST['fullname']);
    $invite->number = htmlentities($_POST['phone']);
    $invite->email =  htmlentities($_POST['email']);
    $invite->message =  htmlentities($_POST['message']);
    $invite->sendtime = date("d-m-Y  H:i:s", time());

    if(empty($_POST['company'])  	||
       empty($_POST['fullname']) 	||
       empty($_POST['phone'])	||
       empty($_POST['message']) ||
      !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
      {
        echo "<p class='red white-text'> Empty Or Invalid Field </p>";
        return false;
      } 

      if($invite->inviteWrite())
        {
        echo '<script>
                var toastHTML = "<h1>Кандидат приглашен на собес!</h1>";
                M.toast({html: toastHTML});
              </script>';
        }
      else {
             echo '<h1>
                   <span style="color:red">   Error! Invite has not sended! </span>
                   </h1> ';
        }
  }
?>

<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST"> 
            
<div class="input-field col l6 s12">
<i class="icofont-company prefix"></i>
<input type="text" id="firstname" name="company" required="requered" autocomplete="off">
<label for="firstname">Название вашей компании</label>
</div>

<div class="input-field col l6 s12">
<i class="icofont-businessman prefix"></i>
<input type="text" id="lastname" name="fullname" required="requered" autocomplete="off">
<label for="lastname">Ваше полное имя</label>
</div>
           
<div class="input-field col l12 s12">
<i class="icofont-telephone prefix"></i>
<input type="tel" id="phone" name="phone" required="requered" autocomplete="off">
<label for="phone">Контактный телефон</label>
</div>

<div class="input-field col l12 s12">
<i class="icofont-email prefix"></i>
<input type="email" id="email" name="email" required="requered" autocomplete="off">
<label for="email">Контактный email</label>
</div>
            
<div class="input-field col s12">
<i class="icofont-comment prefix"></i>
<textarea id="message" class="materialize-textarea" name="message" data-length="300" required="requered" autocomplete="off" style="height: 44px;"></textarea>
<label for="message">Сопроводительное сообщение</label>
</div>
           
<div class="send-block center-align"> 
<button class="btn btn-large send" type="submit">Пригласить
<i class="icofont-paper-plane"></i>
</button>
<input class="btn btn-large" type="reset" value="сбросить">
</div>

</form>

</div>

</div>
</div>
</div>
</section>      