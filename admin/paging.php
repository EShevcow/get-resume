<?php
  
  echo "<ul class='pagination'>";

  // button for first page
  if ($page > 1) {
    echo "<li>
    <a href='{$page_url}'><i class='icofont-simple-left'></i></a>
    </li>";
  }

  // подсчёт всех invites в БД, чтобы подсчитать общее количество страниц
  $total_pages = ceil($total_rows / $records_per_page);

  // диапазон ссылок для показа
  $range = 1;

  // отображаем ссылки на "диапазон страниц" вокруг "текущей страницы"
  $initial_num = $page - $range;
  $condition_limit_num = ($page + $range)  + 1;

  for ($x = $initial_num; $x < $condition_limit_num; $x++) {

    // убедимся, что "$x больше 0" И "меньше или равно $total_pages"
    if (($x > 0) && ($x <= $total_pages)) {

        // текущая страница
        if ($x == $page) {
            echo "<li class='active z-depth-2'>
                  <a class='waves-effect' href='#'>$x </a>
                  </li>";
        }
  
        // НЕ текущая страница
        else {
            echo "<li><a class='waves-effect' href='{$page_url}page=$x'>$x</a></li>";
        }
    }
}

// ссылка по последнюю страницу
if ($page < $total_pages) {
    echo "<li><a href='{$page_url}page={$total_pages}' title='Перейти к последней странице из {$total_pages}'>";
        echo "<i class='icofont-simple-right'></i>";
    echo "</a></li>";
}

echo "</ul>";

?>