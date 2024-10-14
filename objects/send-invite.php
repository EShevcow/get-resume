<?php

 class InviteSend
{
    private $connect;
    private $table_name = "invites";

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

   public function inviteWrite()
    {
        $query = "INSERT INTO " . $this->table_name . " 
        (`id`, `company`, `manager`, `number`, `email`, `message`, `sendtime`)
        VALUES (NULL,  '$this->company', '$this->manager', '$this->number',  '$this->email',  '$this->message', '$this->sendtime')";
        
        $invite = $this->connect->prepare($query);

        if($invite->execute()) {
           return true;
        } else {
           return false;
        }

    }
}

?>
