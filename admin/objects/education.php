<?php


class Education {
     
    private $edu = "education";
  

    public function __construct($db){

        $this->connect = $db;
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

    public function addEducation(){

        $query = "INSERT INTO" . $this->edu . "(`id`, `level`, `institution`, `facultet`, `specialization`, `period`, `periodend`)" . "
        VALUES (NULL, '$this->level', '$this->institution', '$this->facultet', '$this->specialization','$this->period', '$this->periodend')";
      
        $res = $this->connect->prepare($query);
      
        if($res->execute()) {
            return true;
         } else {
            return false;
         }
      }

      public function readOneEducation()
      {
         $query = "SELECT * FROM " . $this->edu . " WHERE id = ? LIMIT 0,1";
         $stmt = $this->connect->prepare($query);
         
         $stmt->bindParam(1, $this->id);
         $stmt->execute();
     
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
         $this->level = $row["level"];
         $this->institution = $row["institution"];
         $this->facultet = $row["facultet"];
         $this->specialization = $row["specialization"];
         $this->period = $row["period"];
         $this->periodend = $row["periodend"];
          
      }

      public function updateOneEducation()
      {
         $query = "UPDATE " . $this->edu . " SET 
         level = '$this->level', institution = '$this->institution', facultet = '$this->facultet',
         period = '$this->period', periodend = '$this->periodend'
         WHERE id = $this->id ";
         // подготовка запроса
         $stmt = $this->connect->prepare($query);
     
         // выполняем запрос
        if ($stmt->execute()) {
          return true;
        }
        else{
          return false;
       }     
      }

      public function deletEducation()
      {
          // запрос MySQL для удаления
          $query = "DELETE FROM " . $this->edu . " WHERE id = ?";
          
          $stmt = $this->connect->prepare($query);
          $stmt->bindParam(1, $this->id);
     
          if ($result = $stmt->execute()) {
             return true;
          } 
          else {
             return false;
          }
      }

}

