<?php


 class Connect 
 {
    private $host = 'localhost';
    private $db_name = 'getresume';
    private $username = 'root';
    private $password = 'twerk153e';
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
        
    
    