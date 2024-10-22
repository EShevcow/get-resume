<?php

 class InviteSend
{
    private $connect;
    private $table_name = "invites_short";

    // свойства обьекта
    public $id;
    public $phone;
    public $message;
    public $sendtime;

   public function __construct($db)
    {
        $this->connect = $db;
    }

   public function inviteWrite()
    {
        $query = "INSERT INTO " . $this->table_name . " 
        (`id`, `name_or_company`,`phone`,`message`, `sendtime`)
        VALUES (NULL,  '$this->name_or_company', '$this->phone', '$this->message', '$this->sendtime')";
        
        $invite = $this->connect->prepare($query);

        if($invite->execute()) {
           return true;
        } else {
           return false;
        }

    }
}

?>
