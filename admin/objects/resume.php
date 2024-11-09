<?php
class Resume
{
    private $connect;
    private $table = "resume";

    public $id;
    public $fullname;
    public $avatar;
    public $phone;
    public $email;
    public $account_id;
    public $live_place;
    public $profession;
    public $money;
    public $about;
    public $comps;
    public $prof;
    public $desc;
    public $period;
    public $period_end;
    public $icon;
    public $title;
    public $description;


    function __construct($db){

        $this->connect = $db;
    }

    function readInfo(){
        $query = "SELECT * FROM " . $this->table . " ";
        $info = $this->connect->prepare($query);
        $info->execute();
    
        return $info;
    }

    public function updateHome(){
      $query = "UPDATE " . $this->table . " SET
      fullname = '$this->fullname', avatar = '$this->avatar' ";

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

 public function updateResume(){
      $query = "UPDATE " . $this->table . " SET
      phone = '$this->phone', email = '$this->email', live_place = '$this->live_place',
      profession = '$this->profession', money = '$this->money', about = '$this->about' ";

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

   

 public function uploadAvatar()
 {
   $result_message = "";

    // если изображение не пустое, пробуем загрузить его
   if($this->avatar) {

    // функция sha1_file() используется для создания уникального имени файла
    $target_directory = "img/";
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
      if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
              // фото загружено
      } 
      else {
          $result_message .= "<div class='alert-danger'>";
          $result_message .= "<div>Невозможно загрузить фото.</div>";
          $result_message .= "<div>Обновите запись, чтобы загрузить фото снова.</div>";
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