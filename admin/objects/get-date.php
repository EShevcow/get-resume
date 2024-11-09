<?php

  class GetDate
  { 

   
    public function getAge($y, $m, $d)
    {
       if($m > date('m') || $m == date('m') && $d > date('d'))
       {
          return (date('Y') - $y - 1);
       }
       else{
          return (date('Y') - $y);
       }
    }
   
    public function getYear($pdate) {
        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format('Y');
    }

    public function getMonth($pdate) {
        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format("m");
    }

    public function getDay($pdate) {
        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format("d");
    }
  
    public function calculateInterval($startDate, $endDate = null) {
      // Разбираем начальную дату
      $startParts = explode('-', $startDate);
      if (count($startParts) !== 3) {
          throw new Exception("Неверный формат начальной даты");
      }
      
      $startYear = (int)$startParts[0];
      $startMonth = (int)$startParts[1];
      $startDay = (int)$startParts[2];
  
      // Проверяем, если дата конца отсутствует, используем текущую дату
      if ($endDate === null) {
          $endDate = date('Y-m-d');
      }
  
      // Разбираем конечную дату
      $endParts = explode('-', $endDate);
      if (count($endParts) !== 3) {
          throw new Exception("Неверный формат конечной даты");
      }
  
      $endYear = (int)$endParts[0];
      $endMonth = (int)$endParts[1];
      $endDay = (int)$endParts[2];
  
      // Проверяем, не является ли год окончания меньше года начала
      if ($endYear < $startYear || ($endYear == $startYear && $endMonth < $startMonth) || ($endYear == $startYear && $endMonth == $startMonth && $endDay < $startDay)) {
          throw new Exception("Вы не можете возвращаться в прошлое!");
      }
      else if($endYear > date('Y') || ($endYear == date('Y') && $endMonth > date('m')) || ($endYear == date('Y') && $endMonth == date('m') && $endDay > date('d'))) {
          throw new Exception("Вы не можете перемещатся в будущее!");
      }
      else{
          // Создаем объекты DateTime для начальной и конечной даты
          $start = DateTime::createFromFormat('Y-m-d', "$startYear-$startMonth-$startDay");
          $end = DateTime::createFromFormat('Y-m-d', "$endYear-$endMonth-$endDay");
      }
  
    
      // Вычисляем разницу между датами
      $interval = $start->diff($end);
  
      // Если прошло меньше года, возвращаем количество месяцев
      if ($interval->y === 0) {
          return "{$interval->m} Monthes";
      }
  
      // Если прошло год или больше, возвращаем годы и месяцы
      return "{$interval->y} Years {$interval->m} Monthes";
  }
  
  }


?>