<?php

// require_once 'resume.php';

class Skills
{

    private $skill = "skills";

    public function __construct($db){

        $this->connect = $db;
    }

    public function readSkills()
    {
       $query = "SELECT * FROM " . $this->skill . "";
       $skill = $this->connect->prepare($query);
       $skill->execute();
     
        return $skill;
    }
    
    public function addSkill()
    {
       $query = "INSERT INTO " . $this->skill . "
       (`id`, `icon`, `title`, `description`)
       VALUES (NULL, '$this->icon', '$this->title', '$this->description' )";
       
       $addskill = $this->connect->prepare($query);
   
           if($addskill->execute()) {
              return true;
           } else {
              return false;
           }
   
    }
   
    public function readOneSkill()
    {
       $query = "SELECT * FROM " . $this->skill . " WHERE id = ? LIMIT 0,1";
       $skill = $this->connect->prepare($query);
       $skill->bindParam(1, $this->id);
   
       $skill->execute();
     
       $row = $skill->fetch(PDO::FETCH_ASSOC);
   
       $this->icon = $row["icon"];
       $this->title = $row["title"];
       $this->description = $row["description"];
    }
   
    public function updateOneSkill()
    {
     $query = "UPDATE " . $this->skill . " SET 
     icon = '$this->icon', title = '$this->title', description = '$this->description'
     WHERE id = $this->id ";
    
     $stmt = $this->connect->prepare($query);
   
      if ($stmt->execute()) {
      return true;
        }
      else{
      return false;
      }     
    }

    public function deleteSkill()
 {
     // запрос MySQL для удаления
     $query = "DELETE FROM " . $this->skill . " WHERE id = ?";
     
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

?>