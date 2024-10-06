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

            echo " <h4 class='header count z-depth-2'> {$level} </h4>";
            echo "<div class='card z-depth-2 hoverable'>
                  <div class='card-content'>";
            echo "<span class='card-title'> {$institution} </span>";
            echo "<b class='exp-prof'> {$facultet} </b>";
            echo "<br>";
            echo "<b> {$specialization} </b>";
            echo "<p>{$period} - {$periodend}</p>";
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