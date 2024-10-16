<?php
  
  class Portfolio
  {
     private $connect;
     private $portfolio = "portfolio";
     
     public $id;
     public $title;
     public $descript;
     public $link;
     public $image;

   public function __construct($db)
     {

        $this->connect = $db;
     }

   public function readPortfolio()
    {
        $query = "SELECT * FROM " . $this->portfolio . "";
        $port = $this->connect->prepare($query);
        $port->execute();
    
        return $port;
    }

   public function readOnePortfolio()
   {
        $query = "SELECT * FROM " . $this->portfolio . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->connect->prepare($query);
    
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $row["title"];
        $this->descript = $row["descript"];
        $this->link = $row["link"];
        $this->image = $row["image"];
   }
   
   public function updatePotfolio()
   {

    $query = "UPDATE " . $this->portfolio . " SET  title = '$this->title',
    descript = '$this->descript', link = '$this->link', image = '$this->image' WHERE id = $this->id ";

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

   public function addPortfolio()
    {
        $query = "INSERT INTO " . $this->portfolio . "
        (`id`, `title`, `descript`, `link`, `image`)
        VALUES (NULL, '$this->title', '$this->descript', '$this->link', '$this->image')";

        $addport = $this->connect->prepare($query);

        if($addport->execute()) {
           return true;
        } else {
           return false;
        }
    }

    public function countPortfolio()
    {
      $query = "SELECT id FROM ". $this->portfolio . " ";
    
      $stmt = $this->connect->prepare($query);
       
      $stmt->execute();
    
      $num = $stmt->rowCount();
    
      return $num;
    
    }

    public function deletePort()
    {
        
        $query = "DELETE FROM " . $this->portfolio . " WHERE id = ? ";

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($result = $stmt->execute()) {
           return true;
        } 
        else {
           return false;
        }
    }
   

    public function uploadImgPort()
    {
      $result_message = "";
   
       // если изображение не пустое, пробуем загрузить его
      if($this->image) {
   
       // функция sha1_file() используется для создания уникального имени файла
       $target_directory = "img/works/";
       $target_file = $target_directory. $this->image;
       $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
   
       // сообщение об ошибке пусто
       $file_upload_error_messages = "";
   
        // убеждаемся, что файл - изображение 
       $check = getimagesize($_FILES["image"]["tmp_name"]);
   
       if ($check !== false) {
         // отправленный файл является изображением
       } 
       else {
         $file_upload_error_messages .= "<div>Отправленный файл не является изображением.</div>";
       }
       
       // проверяем, разрешены ли определенные типы файлов
       $allowed_file_types = array("jpg", "jpeg", "png", "gif");
   
       if (!in_array($file_type, $allowed_file_types)) {
         $file_upload_error_messages 
         .= '<script> M.toast({html: "Разрешены только файлы JPG, JPEG, PNG, GIF."}) </script>';
       }
   
       // убеждаемся, что файл не существует
       if (file_exists($target_file)) {
         $file_upload_error_messages 
         .= '<script> M.toast({html: "Изображение уже существует. Попробуйте изменить имя файла"}) </script>';
       }
        
       // убедимся, что отправленный файл не слишком большой (не может быть больше 1 МБ)
   
   
       // убедимся, что папка img существует, если нет, то создаём
       if (!is_dir($target_directory)) {
         mkdir($target_directory, 0777, true);
       }
   
        // если $file_upload_error_messages всё ещё пуст
        if (empty($file_upload_error_messages)) {
   
         // ошибок нет, пробуем загрузить файл
         if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                 // фото загружено
         } 
         else {
             $result_message .= "<div class='alert-danger'>";
             $result_message .= "<b>Невозможно загрузить фото.</b> <br>";
             $result_message .= "<b>Обновите запись, чтобы загрузить фото снова.</b>";
             $result_message .= "</div>";
         }
        }
            // если $file_upload_error_messages НЕ пусто
        else {
   
             // это означает, что есть ошибки, поэтому покажем их пользователю
         
             $result_message = "<div class='alert-danger red z-depth-2'> {$file_upload_error_messages} </div>";
             $result_message .= '<script> M.toast({html: "Обновите запись, чтобы загрузить фото."})</script>';
        
           }
   
   
      }
      return $result_message;
   
    }
  
  }


?>