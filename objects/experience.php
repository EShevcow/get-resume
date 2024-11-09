<?php


class Experience
{ 

  private $works = "works";
 

  function __construct($db)
  {

    $this->connect = $db;

  }



public function addExperience()
  {
    $query = "INSERT INTO " . $this->works . "
    (`id`, `comps`, `prof`, `descs`, `period`, `period_end`)
    VALUES (NULL,'$this->comps', '$this->prof', '$this->desc','$this->period', '$this->period_end' )";

    $expadd = $this->connect->prepare($query);

    if($expadd->execute()) {
       return true;
    } else {
       return false;
    }
}

public function readExperience()
{
    $query = "SELECT * FROM " . $this->works . " ";
    $exp = $this->connect->prepare($query);
    $exp->execute();

    return $exp;
}

public function countExperience()
{
  $query = "SELECT id FROM ". $this->works . " ";

  $stmt = $this->connect->prepare($query);
   
  $stmt->execute();

  $num = $stmt->rowCount();

  return $num;

}


public function readOneExp()
{
$query = "SELECT * FROM " . $this->works . " WHERE id = ? LIMIT 0,1";
$stmt = $this->connect->prepare($query);

$stmt->bindParam(1, $this->id);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

$this->comps = $row["comps"];
$this->prof = $row["prof"];
$this->descs = $row["descs"];
$this->period = $row["period"];
$this->period_end = $row["period_end"];


}

public function updateOneExp()
{
$query = "UPDATE " . $this->works . " SET 
comps = '$this->comps', prof = '$this->prof', descs = '$this->descs',
period = '$this->period', period_end = '$this->period_end'
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

public function deleteExp()
{
 // запрос MySQL для удаления
 $query = "DELETE FROM " . $this->works . " WHERE id = ?";
 
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