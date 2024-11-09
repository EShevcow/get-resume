<?php

require_once 'resume.php';

class User {
    private $connect;
    private $resumes = [];
    private $users = "users";

   /*
    private $firstName;
    private $lastName;
    private $login;
    private $password;
    private $birthDate;
    private $avatar;
   */
  
    function __construct($db){

        $this->connect = $db;
    }

    function readInfo(){
        $query = "SELECT * FROM " . $this->users . " ";
        $info = $this->connect->prepare($query);
        $info->execute();
    
        return $info;
    }

    public function addResume($experience, $skills, $education, $portfolio, $invites) {
        $resume = new Resume($experience, $skills, $education, $portfolio, $invites);
        $this->resumes[] = $resume;
    }

    public function getResumes() {
        return $this->resumes;
    }

    /*
    public function getFirstName() {
        return $this->firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
    */
}
