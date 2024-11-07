<section id="portfolio" class="portfolio spy">
<?php $countpotfolio = $resume->countPort(); ?>
<h3 class="page-title">
Портфолио
<span class="count">
<?php echo $countpotfolio; ?>
</span>
</h3>

<div class="container">
<div class="row">
 
<?php 

 $portfolios = $resume->readPortfolio();

 if($countpotfolio > 0){

    while($prow = $portfolios->fetch(PDO::FETCH_ASSOC))
    {
        extract($prow);

        if($countpotfolio < 2)
        {
          echo '<div class="col s12">';
        }
        elseif($countpotfolio <3){
          echo '<div class="col l6 s12">';
        }
        else{
          echo '<div class="col l4 s12">';
        }
       
 
          echo"
              <div class='card z-depth-1 hoverable'>
              <div class='card-image'>
              <img class='materialboxed' src='admin/img/works/{$image}'>";
          echo "<span class='card-title'>{$title}</span>
              </div>";
          echo "<div class='card-content'>
                 <blockquote> {$descript} </blocquote>";
          echo "</div>";
          echo "<div class='card-action'>
              <a href='{$link}' class='btn btn-large' target='_blank'>
              <i class='icofont-look'></i>
              просмотр
              </a>";
          echo "</div>  
               </div>
              </div>";
    }
 }
 else{
   echo '<div class="col s12">
        <h2 class="header">get-resume.pw</h2>
        <div class="card horizontal default-portfolio">
          <div class="card-image">
            <img src="libs/img/right-image.jpg">
          </div>';
   echo '<div class="card-stacked">
            <div class="card-content">
              <p>Действующий сайт на котором вы сейчас находитесь. 
                <br>
                Других примеров работ пока нет..
              </p>
            </div>';
   echo '<div class="card-action">
              <a class="nav-link" href="#home">просмотр</a>
            </div>';
   echo '</div>
        </div>
      </div>';
 }
?>
      
</div>
</div>
<div class="container">
    <div class="row">
     <span class="print-date"></span> 
    </div>
</div>
</section>