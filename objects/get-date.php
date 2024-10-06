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
        return $date->format('Y ');
    }

    public function getMonth($pdate) {
        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format("m ");
    }

    public function getDay($pdate) {
        $date = DateTime::createFromFormat("Y-m-d", $pdate);
        return $date->format("d ");
    }
  }


?>