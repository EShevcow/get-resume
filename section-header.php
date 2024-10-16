<header id="home" class="intro spy"> 
 <div class="overlay">
  <div class="container">
    <div class="row">

       <div class="col l6">
        <div class="avatar">
          <img class="responsive-img materialboxed hoverable z-depth-3" src="
          <?php
             if($row['avatar'] == Null){
              echo "uploads/uefh9.png";
               }
             else{
                echo "admin/img/"."{$avatar}"; 
               }
              ?>" 
          alt="Avatar">
        </div>
        <h3 class="white-text name-user"><?php echo "{$fullname}" ?></h3>
        <h2 class="white-text profession"><?php echo "{$profession}"; ?></h2>
       </div>

       <div class="col l6 s12">
        <div class="card z-depth-3 hoverable">
          <div class="card-content">
            <span class="card-title">О Себе</span>
             <blockquote class="blue-text">
             <?php echo "{$about}"; ?> 
            </blockquote>
          </div>
        </div>
        <?php 
          $infouser = $resume->readAge();
 
          $infouser = $infouser->fetch(PDO::FETCH_ASSOC);
          $dateborn = $infouser['date_born'];
          $y = $dt->getYear($dateborn);
          $m = $dt->getMonth($dateborn);
          $d = $dt->getDay($dateborn);
          $age = $dt->getAge($y, $m, $d);
         ?> 
          <div class="card z-depth-3 hoverable"> 
            <div class="card-content">
              <span class="card-title">Основная Информация</span>
              <p class="info-item">
            <?php 
               echo $age." лет,"." родился в ".$y. " Году ";
             ?>           
             </p>
              <p class="info-item">
                <a href="mailto:<?php echo "{$email}"; ?>"><?php echo "{$email}"; ?></a>
              </p>
              <p class="info-item">
                <a href="tel:<?php echo "{$phone}"; ?>"><?php echo "{$phone}"; ?></a>
              </p>
              <p class="info-item">
               <?php echo "{$live_place}"; ?> 
              </p>
              <p class="info-item">
              <?php echo "Рассчитывает на оплату от "."{$money}"." рублей"; ?>
              </p>
            </div>
        </div>

       </div>

</div>
</div>
</div>
</header>