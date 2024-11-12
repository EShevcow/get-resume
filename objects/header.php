<?php 

class Header {

    private $table = "resume";
    private $user = "users";
    public $id;
    public $user_id;

    function __construct($db)
    {

      $this->connect = $db;

    }

    function readInfo(){
        $query = "SELECT * FROM resume WHERE user_id = ?";
        $info = $this->connect->prepare($query);
        $info->bindParam(1, $this->user_id);
        $info->execute();
    
        return $info;
    }

      public function countResume()
        {
        $query = "SELECT id FROM resume WHERE user_id = ?" ;

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->user_id);

        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;

        }

    function updateResume(){
        $query = "UPDATE " . $this->table . " SET
        phone = '$this->phone', email = '$this->email', live_place = '$this->live_place',
        profession = '$this->profession', money = '$this->money', about = '$this->about' WHERE id = ? ";

        // подготовка запроса
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $this->id);
         // выполняем запрос
       if ($stmt->execute()) {
        return true;
       }
       else{
         return false;
       }     

    }
    

}