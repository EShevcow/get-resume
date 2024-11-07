<?php
 $studies = $resume->readEducation();
 $countedu = $resume->countEducation();
?>
<section id="stydies" class="stydi spy">

<h3 class="page-title">
Образование
<span class="count z-depth-2">
<?php echo $countedu ?>
</span>
</h3>

<div class="container">
<div class="row">

<div class="col s12">

<?php
   if($countedu > 0){
      while($edurow = $studies->fetch(PDO::FETCH_ASSOC)){
            extract($edurow);

            $begin_edu_date = $edurow['period'];
            $bed = explode("-", $begin_edu_date);
            $b_e_y = $bed[0];
            $b_e_m = $bed[1];
            $b_e_d =  $bed[2];

            $end_edu_date = $edurow['periodend'];
            $eed = explode("-", $end_edu_date);
            $e_e_y = $eed[0];
            $e_e_m = $eed[1];
            $e_e_d = $eed[2];

            echo " <h4 class='header count z-depth-2'> {$level} </h4>";
            echo "<div class='card z-depth-2 hoverable'>
                  <div class='card-content'>";
            echo "<span class='card-title'> {$institution} </span>";
            echo "<b class='exp-prof'> {$facultet} </b>";
            echo "<br>";
            echo "<b> {$specialization} </b>";
            echo "<p class='period'>";

            echo $b_e_d . "." . $b_e_m . "." . $b_e_y;
            echo " - ";
            echo $e_e_d . "." . $e_e_m . "." . $e_e_y;
          
            echo  "</p>";
            echo "</div>
                  </div>";
      }
   }
   else {
        echo "<div class='card blue-grey darken-1 z-depth-2 hoverable'>
              <div class='card-content white-text'>
              <span class='card-title'>";
        echo "Образование Отсутствует";
        echo "<i class='icofont-education red-text'></i>
              </span>";
        echo "<p>
               Скорее всего данный раздел тоже не заполнен, как и предидущий..
              </p>";
        echo "<p>
               Или соискатель имеет всего 3 класса Церковно-Приходской школы 
              </p>";
        echo "</div>
              </div>";
   }
?>
                            
</div>

</div>
</div>

</section>