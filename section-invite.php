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
    $invite->name_or_company = htmlentities($_POST['fullname']);
    $invite->phone = htmlentities($_POST['phone']);
    $invite->message =  htmlentities($_POST['message']);
    $invite->sendtime = date("d-m-Y  H:i:s", time());

    if(empty($_POST['fullname'])  	||
       empty($_POST['phone'])	||
       empty($_POST['message']))
      {
        echo "<p class='alert-danger'> Пустое или некорректно заполненое поле! </p>";
        return false;
      } 

     else{

       try{

         $invite->inviteWrite(); 
         echo '<script>
                 var toastHTML = "<h1>Кандидату отправлено приглашение на интервью</h1>";
                 M.toast({html: toastHTML});
              </script>';
         echo '<div class="alert-succes"> Кандидату отправлено приглашение на интервью! </div>';

        }
       catch (Exception $e) {

        echo '<div class="alert-danger"> Ошибка приглашение не отправлено! </div>';
        
        }

      } 
  }
?>

<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST"> 
            
  <div class="input-field col l12 s12">
    <i class="icofont-businessman prefix"></i>
    <input type="text" id="lastname" name="fullname" required="requered" autocomplete>
    <label for="lastname">Ваше имя или компании</label>
  </div>

    <div class="input-field col l12 s12">
      <i class="icofont-telephone prefix"></i>
      <input type="tel" id="phone" name="phone" required="requered" autocomplete>
      <label for="phone">Контактный телефон</label>
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