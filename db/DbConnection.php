<?php 
include_once ("../config/config.php");

class DbConnection  
{
  private $host;
  private $user;
  private $pass;
  private $db;
  private $conn;

  public function __construct()
  {
    $this->host = HOST;
    $this->user = USER;
    $this->pass = PASS;
    $this->db = DB;
  }

  public function connect()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
    return $this->conn;
  }

  public function close()
  {
    $this->conn->close();
  }


}


?>