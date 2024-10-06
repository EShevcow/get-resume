<section id="portfolio" class="spy">
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

        echo "<div class='col l4 m6 s12'>
              <div class='card z-depth-1 hoverable'>
              <div class='card-image'>
              <img src='http://head-hunter.fun/admin/img/portfolio/{$image}'>";
        echo "<span class='card-title'>{$title}</span>
              </div>";
        echo "<div class='card-content'>
              <p> {$descript} </p>";
        echo "</div>";
        echo "<div class='card-action'>
              <a href='{$link}' class='btn' target='_blank'>
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

</section>