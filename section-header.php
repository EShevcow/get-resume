<?php 
          $infouser = $resume->readAge();
 
          $infouser = $infouser->fetch(PDO::FETCH_ASSOC);
          $dateborn = $infouser['date_born'];
          $y = $dt->getYear($dateborn);
          $m = $dt->getMonth($dateborn);
          $d = $dt->getDay($dateborn);
          $age = $dt->getAge($y, $m, $d);
?> 
<header id="home" class="intro spy"> 
 
  <div class="container">
    <div class="row">
    <div class="col l12 s12 card-info"> 
    <div class="card horizontal hoverable z-depth-3">
      <div class="card-image avatar">
        <img class="responsive-img materialboxed " src="
        <?php
             if($row['avatar'] == Null){
              echo "uploads/uefh9.png";
               }
             else{
                echo "admin/img/"."{$avatar}"; 
               }
        ?>" alt="Avatar">
      </div>
      <div class="card-stacked">
        <div class="card-content">
        <h3 class="name-user"><?php echo "{$fullname}" ?></h3>
             <?php 
            #  echo '<p class="info-item">'; 
              echo $age." лет,"." родился в ".$y. " Году ";
            #  echo '</p>';
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
              <blockquote>
              <?php echo "{$about}"; ?> 
              </blockquote>
        </div>
       
      </div>
      </div>
      </div>
    
</header>