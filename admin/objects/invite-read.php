<?php

class Invites
{
  private $connect;
  private $table = "invites";

   // свойства обьекта
   public $id;
   public $company;
   public $manager;
   public $number;
   public $email;
   public $message;
   public $sendtime;

  public function __construct($db)
    {
          $this->connect = $db;
    }
   
  public function readInvites($from_record_num, $records_per_page)
  {
    $query = "SELECT * FROM " . $this->table . "  
   ORDER BY id DESC LIMIT {$from_record_num}, {$records_per_page} ";
    
    $invite = $this->connect->prepare($query);
    $invite->execute();

    return $invite;

  }
 

   public function countInvites(){
     $query = "SELECT id FROM " . $this->table . " ";
     
     $stmt = $this->connect->prepare($query);

     $stmt->execute();

     $num = $stmt->rowCount();

     return $num;
  }

 public function readOneInvite()
 {
    $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
    $stmt = $this->connect->prepare($query);
    
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->company = $row["company"];
    $this->manager = $row["manager"];
    $this->number = $row["number"];
    $this->email = $row["email"];
    $this->message = $row["message"];
    $this->sendtime = $row["sendtime"];
   
 }

 public function deleteInvite()
 {
     // запрос MySQL для удаления
     $query = "DELETE FROM " . $this->table . " WHERE id = ?";
     
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