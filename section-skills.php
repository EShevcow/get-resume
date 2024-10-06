<?php 
 $skills = $resume->readSkills();
 $countsk = $resume->countSkills();
?>

<section id="skills" class="skills spy">
<div class="overlay">
<h3 class="page-title white-text">Ключевые Навыки
<span class="count"><?php echo $countsk ?></span>
</h3>  

<div class="carousel">
  
<?php 

  if($countsk > 0)
  {
    while($skrow = $skills->fetch(PDO::FETCH_ASSOC)){
     
       extract($skrow);

       echo "<div class='item wow fadeInUp'>
             <div class='inner-logo'>
             <h3 class='item-icon'>
             <i class='icofont-{$icon}'></i>
             </h3>";
       echo "<h4 class='title-item'>{$title}</h4>";
       echo "<p class='text-testimonial'>{$description}</p>";
       echo "</div>
             </div>";

      
    }
  }
  else{
      
     echo "<h4 class='title-item'>Навыки отсутствуют 
     <i class='icofont-tools-alt-2 red-text'></i>
     </h4>";
     
  }
?>

</div>

</div>
</section> 