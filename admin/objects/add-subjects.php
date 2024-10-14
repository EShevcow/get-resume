<?php

require_once 'resume.php';

class AddSubjects extends Resume
{ 

  private $works = "works";
  private $edu = "educats";

  function __construct($db)
  {

    $this->connect = $db;

  }



public function addExperience()
  {
    $query = "INSERT INTO " . $this->works . "
    (`id`, `comps`, `prof`, `descs`, `period`, `period_end`)
    VALUES (NULL,'$this->comps', '$this->prof', '$this->desc','$this->period', '$this->period_end' )";

    $expadd = $this->connect->prepare($query);

    if($expadd->execute()) {
       return true;
    } else {
       return false;
    }
}



}