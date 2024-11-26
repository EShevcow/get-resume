<?php

class User {

    private $connect;
   # private $resumes = [];
    private $users = "users";

    function __construct($db){
        $this->connect = $db;
    }

    function readInfo(){
        $query = "SELECT * FROM " . $this->users . " ";
        $info = $this->connect->prepare($query);
        $info->execute();
    
        return $info;
    }

    public function readOneUser()
        {
        $query = "SELECT * FROM " . $this->users . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->fullname = $row["fullname"];
        $this->gender = $row["gender"];
        $this->avatar = $row["avatar"];
        $this->login = $row["login"];
        $this->date_born = $row["date_born"];


    }

    public function countAll(){
        $query = "SELECT id FROM " . $this->users . " ";
        
        $stmt = $this->connect->prepare($query);
   
        $stmt->execute();
   
        $num = $stmt->rowCount();
   
        return $num;
     }

}
