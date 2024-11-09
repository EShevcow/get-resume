<?php

class Resume
{
   
    private $connect;
    private $user = "users";
    private $table = "resume";
    private $works = "works";
    private $skill = "skills";
    private $edu = "education";
    private $portfolio = "portfolio";

    public function __construct($db){

        $this->connect = $db;
    }
    
    public function readAge(){
       $query = "SELECT * FROM " . $this->user . " ";
       $stmt = $this->connect->prepare($query);
       $stmt->execute();
    
       return $stmt;
    }

    public function readInfo(){
        $query = "SELECT * FROM " . $this->table . " ";
        $info = $this->connect->prepare($query);
        $info->execute();
    
        return $info;
    }

    public function readExperience()
    {
        $query = "SELECT * FROM " . $this->works . " ";
        $exp = $this->connect->prepare($query);
        $exp->execute();
    
        return $exp;
    }

    public function countExp(){
        $query = "SELECT id FROM " . $this->works . " ";
        
        $stmt = $this->connect->prepare($query);
   
        $stmt->execute();
   
        $num = $stmt->rowCount();
   
        return $num;
     }
    
     public function readPortfolio()
     {
        $query = "SELECT * FROM " . $this->portfolio . "";
        $port = $this->connect->prepare($query);
        $port->execute();
        
        return $port;
     }

     public function countPort(){
        $query = "SELECT id FROM " . $this->portfolio . " ";
        
        $stmt = $this->connect->prepare($query);
   
        $stmt->execute();
   
        $num = $stmt->rowCount();
   
        return $num;
     }

    public function readSkills()
     {
        $query = "SELECT * FROM " . $this->skill . "";

        $skill = $this->connect->prepare($query);

        $skill->execute();
  
        return $skill;
    }

    public function countSkills(){
        $query = "SELECT id FROM " . $this->skill . " ";
        
        $stmt = $this->connect->prepare($query);
   
        $stmt->execute();
   
        $num = $stmt->rowCount();
   
        return $num;
     }

    public function readEducation(){
        $query = "SELECT * FROM ". $this->edu ." ";

        $stmt = $this->connect->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    
    public function countEducation(){
        $query = "SELECT id FROM " . $this->edu . " ";
        
        $stmt = $this->connect->prepare($query);
   
        $stmt->execute();
   
        $num = $stmt->rowCount();
   
        return $num;
    }
}
?>