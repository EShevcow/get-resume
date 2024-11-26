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
    $query = "INSERT INTO" . $this->works . "
    (id, comps, prof, category, descs, user_id, resume_id, `period`, period_end)
    VALUES (NULL, $this->comps, $this->prof, $this->category, $this->descs, $this->user_id, $this->resume_id, $this->period, $this->period_end)";

    $res = $this->connect->prepare($query);
 
    #$res->execute();

    #return $res;

    if($res->execute()) {
      return true;
   } else {
      return false;
   }

}

public function readExperience()
{
    $query = "SELECT * FROM works WHERE user_id = ? AND resume_id = ? ";
    $exp = $this->connect->prepare($query);
    $exp->bindParam(1, $this->user_id);
    $exp->bindParam(2, $this->resume_id);
    $exp->execute();

    return $exp;
}

public function countExperience()
{
  $query = "SELECT id FROM works WHERE user_id = ? AND resume_id = ? ";

  $stmt = $this->connect->prepare($query);
  $stmt->bindParam(1, $this->user_id);
  $stmt->bindParam(2, $this->resume_id);
  $stmt->execute();

  $num = $stmt->rowCount();

  return $num;

}


public function readOneExp()
{

 $query = "SELECT * FROM " . $this->works . " WHERE id = ? AND user_id = ? AND resume_id = ?  LIMIT 0,1";
 $stmt = $this->connect->prepare($query);

 $stmt->bindParam(1, $this->id);
 $stmt->bindParam(2, $this->user_id);
 $stmt->bindParam(3, $this->resume_id);
 $stmt->execute();

 $row = $stmt->fetch(PDO::FETCH_ASSOC);

 $this->comps = $row["comps"];
 $this->prof = $row["prof"];
 $this->descs = $row["descs"];
 $this->category = $row['category'];
 $this->period = $row["period"];
 $this->period_end = $row["period_end"];

}

public function updateOneExp()
{
$query = "UPDATE " . $this->works . " SET 
comps = '$this->comps', prof = '$this->prof', category='$this->category', descs = '$this->descs',
period = '$this->period', period_end = '$this->period_end'
WHERE id = $this->id AND user_id = $this->user_id AND resume_id = $this->resume_id";
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