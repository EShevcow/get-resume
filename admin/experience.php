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
  
  $exp->user_id = $_SESSION['id'];
  $exp->resume_id = $_SESSION['resume_id'];

  $works = $exp->readExperience();
  $count = $exp->countExperience();

  $title_page = "Опыт работы: " . $_COOKIE['prof'];
?>

<?php 
  include_once 'layouts/head.php';
?>
<body>

    <!--Start Navbar-->
    <?php 
     include_once 'layouts/navbar.php';
    ?>
    <!--/End Navbar-->

    <div class="wrapper">

        <!--Start Sidenav-->
        <aside class="column">
           
            <div class="sidenav">
                <div class="sidenav__wrap">
                    <a href="head-resume.php?id=<?= $_SESSION['resume_id'] ?>" class="sidenav__item">
                        <span class="text-label">Главная</span>
                    </a>
                    
                    <a href="#" class="sidenav__item sidenav__item_active">
                        <span class="text-label">Опыт работы</span>
                    </a>
                    <a href="#" class="sidenav__item">
                        <span class="text-label">Навыки</span>
                    </a>
                    <a href="invites.html" class="sidenav__item">
                        <span class="text-label">Образование</span>
                    </a>
                    <a href="invites.html" class="sidenav__item">
                        <span class="text-label">Приглашения</span>
                    </a>
                </div>
            </div> 

           <!--Start Ads Block-->
           <?php 
            include_once 'layouts/ads-block.php';
           ?>
           <!--/End Ads Block-->

        </aside>
        <!--/End Sidenav-->

        <main class="column">

        <div class="notif-block" id="send-notif">
            <div class="notif-block__wrap notif-block__success">
                <span class="large-icon">
                    <i class="icofont-check-circled"></i>
                </span>
                <span class="text-body">
                  Success
                </span>
            </div>
        </div>   

          <!--Start Add Work-->
          <?php 
           if($count > 0){
            echo '<div class="card-vertical">
                  <div class="card__wrap">
                  <div class="card__text-block">
                    <span class="body-text">Добавить опыт работы</span>
                   
                  <div class="card__action">
                    <a href="add-experience.php" class="btn-round round-primary">
                        <i class="icofont-plus"></i> 
                    </a>
                  </div>
                  </div>
                  </div>
                  </div>';
           }
          ?>
          
        <!--/End Add Work-->

            <!--Start Experience Block-->
            <?php 


             function printexp($works, $count, $dt){
              if($count > 0){
                while($exps = $works->fetch(PDO::FETCH_ASSOC))
                {
                     $fdate = $exps['period'];

                     extract($exps);

                     $fdt = explode("-", $period);
                     $y = $fdt['0'];
                     $m = $fdt['1'];
                     $d = $fdt['2'];

                     $edt = explode("-", $period_end);
                     $yend = $edt['0'];
                     $em = $edt['1'];
                     $ed = $edt['2'];

                echo '<div class="card-vertical">
                      <div class="card__wrap">
                      <div class="card__text-block">';
                echo "<span class='body-text'>{$comps}</span>";
                echo "<span class='pill'>
                            <span class=micro-bold>{$category}</span>
                      </span>";
                echo "<span class='body-bold get-blue-color'>
                        {$prof}
                     </span>";
                echo "<blockquote>{$descs}</blockquote>";
                echo '<span class="micro-bold get-blue-color">';
                echo $d . '.' . $m . '.' . $y . ' - ';
                      if($period_end == Null){
                        echo "По сей день(Авось и ныне там 😅)";
                        echo '</span>';
                        echo '<span class="small-bold get-count-color">';
                        echo  $dt->calculateInterval($period);
                        echo '</span>';

                      }
                      else{
                        echo $ed . '.' . $em . '.' . $yend;
                        echo '</span>';
                        echo '<span class="small-bold get-count-color">';
                              if($yend - $y < 0 || ($yend == $y && $em < $m) || ($yend == $y && $em == $m && $ed < $d)){
                                 echo '<div class="danger">Вы пытались вернутся в прошлое, но машину времени еще не изобрели! 😳 </div>';
                               }
                              elseif ($yend > date('Y') || ($yend == date('Y') && $em > date('m')) || ($yend == date('Y') && $em == date('m') && $ed > date('d'))) {
                                 echo '<div class="danger">Вы пытались отправится в будущее, но машину времени еще не изобрели! 😳 </div>';
                               }
                              else{
                                 echo $dt->calculateInterval($period, $period_end);
                               }  
                        echo '</span>';
                      }
                echo "<span class='small-bold get-count-color'>";

                          
                  
                            

                echo "</span>";

                echo '<div class="card__action">';
                echo "<a href='redact-experience.php?id_exp={$id}'>
                        <span class='body-bold get-yel-color'>
                          <i class='icofont-pencil'></i>   
                                Редактировать
                        </span>
                      </a>";
                echo " <a class='get-danger-color'>  
                        <i class='icofont-ui-delete'></i> 
                         <span class='body-bold'>Удалить</span>
                        </a>";
                echo '</div> 
                      </div>
                      </div>
                      </div>';

                }
              }
              else{
                echo '<div class="card-vertical">
                      <div class="card__wrap">
                      <blockquote>Опыт работы отсутствует!</blockquote>
                      <div class="card__text-block">
                      <span class="body-text">Добавить опыт работы</span>
                   
                      <div class="card__action modal-trigger" id="openModalBtn">
                      <a href="#" class="btn-round round-primary">
                        <i class="icofont-plus"></i> 
                      </a>
                      </div>
                      </div>
                      </div>
                      </div>';
             }
            }

            printexp($works, $count, $dt);
            ?>  

            <!--/End Experience Block-->   
          
        </main>
    </div>
  
    <?php 
     if($_POST) {
      
      $exp->comps = htmlspecialchars($_POST["comp"]);
      $exp->category = htmlspecialchars($_POST["category"]);
      $exp->prof = htmlspecialchars($_POST["prof"]);
      $exp->descs = htmlspecialchars($_POST["desc"]);
      $exp->user_id;
      $exp->resume_id;
      $exp->period = htmlspecialchars($_POST["fdate"]);
      $exp->period_end = htmlspecialchars($_POST["edate"]);
      
      try{
         $exp->addExperience();
         echo "<script>
                  setTimeout(() => {
                 $('#send-notif').slideToggle();
                  }, 3000);
              </script>";
      }
      catch (Exception $e){
        echo "<script>
               alert('Error Add Experience');
             </script>";
      }
    
     
     }
    ?>

    <!--Start Modal Window-->
    <div class="modal" id="myModal">
        <div class="modal__overlay">
         <div class="modal__wrap">
            <h3>Добавление опыта работы</h3>  
          <div class="modal__body row">
            
          <!--Start Form Add-->
           <form class="column" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            
            <div class="input-field">
                <input class="input-field__input get-input" id="txt" name="comp" type="text">
                <label class="input-field__label" for="txt">Название компании:</label>
            </div>
            <div class="input-field">
                <select class="input-field__select" name="category" id="sel1">  
                    <option value="Другое">Другое</option>
                    <option value="IT">IT</option>
                    <option value="Производство">Производство</option>
                    <option value="Торговля">Торговля</option>
                    <option value="Логистика">Логистика</option>
                    <option value="HoReCa">HoReCa</option>
                </select>
                <span class="input-field__icon">
                    <i class="icofont-rounded-down"></i>
                </span>
                <label class="input-field__label" for="sel1">Категория работы:</label>
            </div> 
            <div class="input-field">
                <input class="input-field__input get-input" id="txt" name="prof" type="text">
                <label class="input-field__label" for="txt">Профессия:</label>
            </div>
            <div class="input-field">  
                <textarea class="input-field__textarea get-textarea" id="dsc" name="desc"></textarea>
                <label class="input-field__label" for="dsc">Описание работы:</label>
            </div> 
            <div class="input-field">
                <input class="input-field__date get-input" type="date" name="start-date" id="bgn">
                <label class="input-field__label" for="bgn">Дата начала:</label>
            </div>
            <div class="input-field">
                <input class="input-field__date get-input" type="date" name="end-date" id="end">
                <label class="input-field__label" for="end">Дата окончания:</label>
            </div> 
            <div class="input-field">
                <button class="btn primary" type="submit">
                    <i class="icofont-ui-add"></i>
                    <span class="body-bold">Добавить</span>
                    
                </button>
            </div>
           </form>
           <!--/End Form Add-->

           <!--Start Ads Block-->
           <?php 
            include 'layouts/ads-block.php';
           ?>
           <!--/End Ads Block-->

          </div>
          <div class="modal__footer">
           <button class="btn primary modal-close">    
             <span class="body-bold">Close</span>
             <i class="icofont-close"></i>
           </button>
          </div>
         </div>   
        </div>
       </div>  
    <!--/End Modal Window-->

      <!--Start Linq Scripts-->
      <?php 
       include_once 'layouts/scripts.php';
      ?>
  
      <!--/End Linq Scripts-->
</body>
</html>
