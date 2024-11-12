<?php

require_once 'resume.php';

class User {

    private $connect;
    private $resumes = [];
    private $users = "users";

   # private $fullname;
   # private $gender;
   # private $avatar;
   # private $login;
   # private $password;
   # private $date_born;
   
    function __construct($db){
        $this->connect = $db;
      #  $this->fullname = $fullname;
      #  $this->gender = $gender;
      #  $this->avatar = $avatar;
      #  $this->login = $login;
      #  $this->password = password_hash($password, PASSWORD_DEFAULT);
      #  $this->date_born = $date_born;
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

    public function addResume($header, $experience, $skills, $education, $portfolio, $invites) {
        $resume = new Resume($header, $experience, $skills, $education, $portfolio, $invites);
        $this->resumes[] = $resume;
    }

    public function getResumes() {
        return $this->resumes;
    }

    /*
    public function getFullname() {
        return $this->fullname;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getDate_born(){
        return $this->date_born;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
   */
}
