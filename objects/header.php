<?php 

class Header {

    private $table = "resume";
 #   private $user = "users";
    public $id;
    public $user_id;

    function __construct($db)
    {

      $this->connect = $db;

    }
    
   function addResume(){
    $query = "INSERT INTO resume (id, fullname, phone, user_id, email, live_place, profession, avatar, money, about)
        VALUES (NULL, $this->fullname, $this->phone, $this->user_id, $this->email, $this->live_place, 
        $this->profession, $this->avatar, $this->money, $this->about)";

      $res = $this->connect->prepare($query);
      
      $res->execute();
   
      return $res;  

   } 

    function readInfoRes(){
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
        public function updatePhoto(){
          $query = "UPDATE " . $this->table . " SET
          fullname = '$this->fullname', avatar = '$this->avatar' WHERE id = ? ";
    
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
    public function uploadAvatar()
    {
      $result_message = "";
   
       // если изображение не пустое, пробуем загрузить его
      if($this->avatar) {
   
       // функция sha1_file() используется для создания уникального имени файла
       $target_directory = "../libs/img/";
       $target_file = $target_directory . $this->avatar;
       $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
   
       // сообщение об ошибке пусто
       $file_upload_error_messages = "";
   
        // убеждаемся, что файл - изображение 
       $check = getimagesize($_FILES["avatar"]["tmp_name"]);
   
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
         .= '<script> alert("Разрешены только файлы JPG, JPEG, PNG, GIF."); </script>';
       }
   
       // убеждаемся, что файл не существует
       if (file_exists($target_file)) {
         $file_upload_error_messages 
         .= '<script> alert("Изображение уже существует. Попробуйте изменить имя файла"); </script>';
       }
        
       // убедимся, что отправленный файл не слишком большой (не может быть больше 1 МБ)
   
   
       // убедимся, что папка img существует, если нет, то создаём
       if (!is_dir($target_directory)) {
         mkdir($target_directory, 0777, true);
       }
   
        // если $file_upload_error_messages всё ещё пуст
        if (empty($file_upload_error_messages)) {
   
         // ошибок нет, пробуем загрузить файл
         if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                 // фото загружено
         } 
         else {
             $result_message .= "<div class='notif-block'>";
             $result_message .= "<div class='notif-block__wrap notif-block__danger'>";
             $result_message .= "<span class='text-body'>Невозможно загрузить фото.</span>";
             $result_message .= "<span class='text-body'>Обновите запись, чтобы загрузить фото снова.</span>";
             $result_message .= "</div></div>";
         }
        }
            // если $file_upload_error_messages НЕ пусто
        else {
   
             // это означает, что есть ошибки, поэтому покажем их пользователю
         
             $result_message = "<div class='danger'> {$file_upload_error_messages} </div>";
             $result_message .= '<script> alert("Обновите запись, чтобы загрузить фото.");</script>';
        
           }
   
   
      }
      return $result_message;
   
    }  

}