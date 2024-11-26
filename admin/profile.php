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

  $user->id =  $_SESSION['id'];
  $hd->user_id = $_SESSION['id'];
  $user->readOneUser();
  $title_page = $user->fullname . " |" . " Список резюме";
?>

<?php 
  include_once 'layouts/head.php';
?>

    <!--Start Navbar-->
    <nav class="navbar header-nav"> 
        <div class="navbar__wrap">   
         <a href="#" class="brand-logo ">
          <img src="../libs/img/logo.png" alt="Logo">
         </a>
          <ul class="navbar__menu">
            <li>
                <a href="../config/logout.php">
                    <i class="icofont-exit"></i>  
                    Exit
                </a>
            </li>
          </ul>
          <ul class="navbar-toggle">
            <li>
                <a href="#">
                    <i class="icofont-exit"></i>  
                    Exit
                </a>
              </li>
          </ul>
          <a class="navbar-burger" href="#">
            <i class="icofont-navigation-menu"></i>
          </a>
        </div> 
       </nav>
       <!-- /End Navbar -->

  <div class="wrapper-left">

        <!-- Start Main Content -->
        <main class="column">
           
            <!--Start Breadcrumb Nav-->
            <?php 

              $dtb = explode("-", $user->date_born);
              $y_b = $dtb[0];
              $m_b = $dtb[1];
              $d_b = $dtb[2];
              $age_user = $dt->getAge($y_b, $m_b, $d_b);

              if($user->gender == 'man'){
                   $gender = 'Мужчина';
              }
              else{
                 $gender = 'Женщина';
              }

            ?>
            <!--/End Breadcrumb Nav-->

            <!--Start Profile Head-->
            <div class="card-vertical">
                <div class="card__wrap">
                
                    <div class="card__text-block">
                        <span class="body-text"><?= $user->fullname; ?></span>
                        <span class="text-small">
                        <?= $user->login; ?>
                        </span>
                        <span class="text-small">
                        <?= $gender ?>
                        </span>
                        <span class="text-small">
                        <?= $age_user . ' лет,' . ' родился в ' . $y_b . ' году' ; ?>
                        </span>
                        <!--
                    <div class="card__action">
                        <a href="#">
                          <span class="body-bold">
                          
                            <i class="icofont-gear"></i>
                         </span>
                        </a>
                    </div>
                    -->
                 </div>
               </div>
            </div>
            <!--/End Profile Head-->

            <!--Start Resume Items-->
            <?php 

             $resums = $hd->readInfo();
             $count = $hd->countResume();

    function printResums($resums, $count){
             if($count > 0){
                while($headr = $resums->fetch(PDO::FETCH_ASSOC)){

                    extract($headr);
                    
                    echo '<div class="card-horizontal">';
                    echo '<div class="card__wrap">';
                    echo "<a href='redact-photo.php?id=$id' class='tooltip-bottom' data-tooltip='Изменить фото'>";
                    echo '<div class="card__image avatar" >';
                    echo "<img src='../libs/img/{$avatar}' alt='Avatar'>
                           </div>
                           </a>";
                    echo '<div class="card__text-block">';
                    echo "<span class='body-text'>{$profession}</span>";
                    echo "<span class='text-small'>{$email}</span>";
                    echo "<span class='text-small'>{$phone}</span>";
                    echo '<div class="card__action">';
                    echo "<a class='btn primary' href='head-resume.php?id={$id}'>";
                    echo '<span class="body-bold">
                            Редактировать разделы резюме
                            <i class="icofont-arrow-right"></i>    
                          </span>
                          </a>';
                    echo "<a class='btn secondary get-border get-color' href='redact-info-resume.php?id={$id}'>";
                    echo  '<span class="body-bold">Редактировать информацию</span>
                            <i class="icofont-pencil"></i>
                            </a>';
                    echo "</div> 
                          </div>
                          </div>
                          </div>";
                  
                }
             }
             else{

                echo '<div class="card-vertical">
                <div class="card__wrap">
                <blockquote>Резюме пользователя отсутствуют!</blockquote>
                    <div class="card__text-block">
                       <div class="body-text">Добавить резюме</div>
                    <div class="card__action">
                        <button class="btn-round round-primary modal-trigger" id="openModalBtn">
                            <i class="icofont-plus"></i> 
                        </button>
                     </div>
                  </div>
                </div>
              </div>';
             }
            }
        
           printResums($resums, $count);
           
        ?>
         
            
        </main>
        <!--/End Main Content-->

        <!--Start Aside & Ads-->
        <aside class="column">
<?php 
if($count > 0){
    echo ' <div class="card-vertical">
                <div class="card__wrap">
                
                    <div class="card__text-block">
                       <div class="body-text">Добавить резюме</div>
                    <div class="card__action">
                        <button class="btn-round round-primary modal-trigger" id="openModalBtn">
                            <i class="icofont-plus"></i> 
                        </button>
                    </div>
                 </div>
               </div>
            </div>';
}
?>
           

            <!--Start Ads Block-->
            <?php 
             include_once 'layouts/ads-block.php';
            ?>
            <!--/End Ads Block-->

        </aside>
        <!--/End Aside -->
        </div>
<?php 
  if($_POST){

    $hd->profession = $_POST['profession'];
    $hd->fullname = "Add";
    $hd->phone = $_POST['phone'];
    $hd->email = $_POST['email'];
    $hd->money = $_POST['money'];
    $hd->live_place = $_POST['live_place'];
    $hd->about = $_POST['about'];
    $hd->user_id;
    $hd->avatar = "Avatar.jpg";

    try{
       $hd->addResume();
       echo "<script>
              alert('Резюме успешно добавлено!')
             </script>";
    }
    catch (Exception $e){
       echo "<script>
              alert('Не удалось добавить резюме!')
             </script>";
    }
     
  }
?>

 <!--Start Modal Add Resume --> 
 <div class="modal" id="myModal">
    <div class="modal__overlay">
     <div class="modal__wrap">
        <h3>Добавление резюме</h3> 
      <div class="modal__body row">

        <!--Start Form Add-->
        <form class="column" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="input-field">
                <input class="input-field__input" id="prof" name="profession" type="text">
                <label class="input-field__label" for="prof">Целевая профессия</label>
            </div>
            <div class="input-field">
                <input class="input-field__input" id="phone" name="phone" type="tel">
                <label class="input-field__label" for="phpne">Номер телефона</label>
            </div>
            <div class="input-field">
                <input class="input-field__input" id="email" name="email" type="email" value=" <?= $user->login; ?>">
                <label class="input-field__label" for="email">Email</label>
            </div>
            <div class="input-field">
                <input class="input-field__input" id="mn" name="money" type="number">
                <label class="input-field__label" for="mn">Зарплатные ожидания</label>
            </div>
            <div class="input-field">
                <input class="input-field__input" id="lp" name="live_place" type="text">
                <label class="input-field__label" for="lp">Место жительства</label>
            </div>
            <div class="input-field">  
                <textarea class="input-field__textarea" name="about" placeholder="Коротко о себе"></textarea>
                <label class="input-field__label" for="about">О себе</label>
            </div> 
            <div class="card__action">
                <button class="btn primary">
                    <i class="icofont-plus"></i>
                    <span class="body-bold">Добавить</span>
                </button> 
            </div>
        </form> 
        <!--/End Form Add-->

        <!--Start Ads Block-->
        <div class="get-ads">
            <div class="wireimage">
                <div class="image__wrap">
                   <img src="../libs/img/keyboard.jpg" alt="Image">
                </div>
               </div> 
           </div>
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
<!--/End Maodal Add Resume-->      

 <!--Start Linq Scripts-->
<?php 
 include_once 'layouts/scripts.php';
?>
 <!--/End Linq Scripts-->
</body>
</html>
