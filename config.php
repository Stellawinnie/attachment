<?php
/*   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'attachments');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);*/
?>
<?php
class Database
{

    private $host = "localhost";
    private $db_name = "attachments";
    private $username = "root";
    private $password = "";
    public $conn;

    public function dbConnection()
 {

     $this->conn = null;
        try
  {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
   $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
  catch(PDOException $exception)
  {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>