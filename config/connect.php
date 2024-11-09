<?php


 class Connect 
 {
    private $host = 'localhost';
    private $db_name = 'g97774s3_getres';
    private $username = 'g97774s3_getres';
    private $password = 'DW0!eK3F9x7A';
    public $connect;

    function getConnect()
    {
        $this->connect = null;

        try {
            $this->connect = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return $this->connect;
    }
 } 

?>
        
    
    