<?php

class Resume {

  private $header;
  private $experience;
  private $skills;
  private $education;
  private $portfolio;
  private $invites;

  public function __construct($header, $experience, $skills, $education, $portfolio, $invites) {
      $this->header = $header;
      $this->experience = $experience;
      $this->skills = $skills;
      $this->education = $education;
      $this->portfolio = $portfolio;
      $this->invites = $invites;
  }
  public function getHeader(){
    return $this->header;
  }

  public function getExperience() {
      return $this->experience;
  }

  public function getSkills() {
      return $this->skills;
  }

  public function getEducation() {
      return $this->education;
  }

  public function getPortfolio() {
      return $this->portfolio;
  }

  public function getInvites() {
      return $this->invites;
  }

  public function setHeader($header){
     $this->header = $header;
  }

  public function setExperience($experience) {
      $this->experience = $experience;
  }

  public function setSkills($skills) {
      $this->skills = $skills;
  }

  public function setEducation($education) {
      $this->education = $education;
  }

  public function setPortfolio($portfolio) {
      $this->portfolio = $portfolio;
  }

  public function setInvites($invites) {
      $this->invites = $invites;
  }
}


?>