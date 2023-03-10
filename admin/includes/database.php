<?php
require_once("new_config.php");
class Database
{
    public $connection;
    public $db;
    function __construct()
    {
       $this->db= $this->open_db_connection();
    }
    public function open_db_connection()
    {
        // $this->connection=mysqli_connect('localhost','root','','gallery');
         $this->connection=new mysqli('localhost','root','','gallery');
         if($this->connection->connect_errno)
         {
            die("Database connection failed" . $this->connection->connect_error);
         }
        return $this->db;
    }
    public function query($sql)
    {
        $result = $this->db->query($sql);
        $this->confirm($result);
        return $result;
    }
    private function confirm($result)
    {
        if(!$result)
        {
            die("Query failed" .$this->db->error);
        }
    }
    public function escape($string)
    {
       return $this->db->real_escape_string( $string);
    }
    public function the_insert_id()
    {
        return $this->db->insert_id;
    }

   
}
$database = new Database();
?>