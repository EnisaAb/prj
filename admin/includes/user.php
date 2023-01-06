<?php 
class User extends Db_object{
    //======PROPERTIES======
    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;

    //======METHODDS=======

  

    public static function verify_user($username,$password)
    {
        global $database;
        $username = $database->escape($username);
        $password = $database->escape($password);
        $sql = "SELECT * FROM ".self::$db_table ." WHERE username='{$username}' AND password='{$password}' LIMIT 1";
        $the_result_array = self::find_this_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;

    }

   

   
  
  


}




?>