<?php 
 $skills = $resume->readSkills();
 $count_skills = $resume->countSkills();
?>

<section id="skills" class="skills spy">
<h3 class="page-title">
Ключевые навыки 
<span class="count">
<?php echo $count_skills; ?>
</span>
</h3>
  <div class="container">
    <div class="row">
      <div class="col s12">
      
          <div class="card-panel hoverable">
            <?php 
            if($count_skills > 0){
              while($skills_row = $skills->fetch(PDO::FETCH_ASSOC)){
     
                extract($skills_row);

                echo "<div class='chip' title='{$description}'>";
                echo " <i class='icofont-{$icon}'></i>";
                echo "{$title}";
                echo '</div>';
              }
            }
            else{
      
        echo "<div class='alert-absent'>Навыки отсутствуют 
              <i class='icofont-tools-alt-2 red-text'></i>
              </div>";
              
           }
            ?>
          </div>
        
      </div>
    </div>
  </div>
</section>