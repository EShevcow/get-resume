<section id="experience" class="experience spy">
<?php $num = $resume->countExp(); ?>
<h3 class="page-title">Опыт Работы
<span class="count"><?php echo $num; ?></span>
</h3> 

<div class="container">
<div class="row">
<div class="col l12">

<?php 

  $exps = $resume->readExperience();

  if($num > 0){
    while($exp = $exps->fetch(PDO::FETCH_ASSOC))
    {
        $fromdate = $exp['period'];
        $enddate = $exp['period_end'];
        $sdt = explode("-", $fromdate);
        $y = $sdt[0];
        $m = $sdt[1];
        $d = $sdt[2];

        $yeval = $dt->getAge($y, $m, $d);
        $mval = (12 - $m) + date('m');
         if($mval == 12){
            $yeval ++;
            $mval = 0;
         }
        
        $endwork = explode("-", $enddate);
        $yend = $endwork[0];
        $endmonth = $endwork[1];
        $endday = $endwork[2];
  
        $endmval = $endmonth - $m;
  
        extract($exp);

        echo '<div class="card z-depth-2 hoverable">
              <div class="card-content">';
        echo "<span class='card-title'> {$comps} </span>";
        echo "<b class='exp-prof'> {$prof} </b>";
        echo "<blockquote> {$descs} </blockquote>";
        echo "<span class='period'>";
        echo $d. '.' . $m . '.' . $y." - ";
          if($exp['period_end'] == Null)
            {
             echo "До сих пор там"; 
             echo "</span>";
             echo "<br>";
             echo "<p class='count-exp'>";
             echo $dt->calculateInterval($fromdate);
             echo "</p>";
            
            }
          else {
             echo $endday . '.' . $endmonth . '.' . $yend;
             echo "</span>";
             echo "<br>
                   <p class='count-exp'>";
                     if($yend - $y < 0 || ($yend == $y && $endmonth < $m) || ($yend == $y && $endmonth == $m && $endday < $d)){
                       echo '<div class="alert-danger">Отправляюсь в прошлое чтобы скорректировать свой опыт работы! 😂</div>';
                     }
                     else if($yend > date('Y') || ($yend == date('Y') && $endmonth > date('m')) || ($yend == date('Y') && $endmonth == date('m') && $endday > date('d'))){
                       echo '<div class="alert-danger">Путешествую в будущее чтобы увидеть вкатился я в айти или нет! 😂</div>';
                     }
                     else{
                       echo $dt->calculateInterval($fromdate, $enddate);
                     }
              echo "</p>";
             
         }

     echo "</div>
     </div>";

    }
  }
  else{
    echo '<div class="card blue-grey darken-1 z-depth-2 hoverable">
          <div class="card-content white-text">
          <span class="card-title">';
    echo  "Опыт Работы Отсутствует";
    echo '<i class="icofont-warning yellow-text"></i>
          </span>';
    echo "<p>
           Возможно данный раздел еще не заполнен...
         </p>";
    echo "<p>
           Но скорее всего соискатель на протяжении многих лет обивает пороги различных
           Веб-студий, по всей Москве, чтобы хоть куда-нибудь устроится 
          </p>";
    echo '</div>
        </div>';
     
  }
?>
      
</div>
</div>
</div> 

</section> 