<?php 
class User extends Db_object{
  //======PROPERTIES======
  protected static $db_table = "users";
  protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name','user_image');
  public $id;
  public $username;
  public $first_name;
  public $last_name;
  public $password;
  public $user_image;
  public $upload_directory="images";
  public $image_placeholder = "https://via.placeholder.com/50.png";
  public $type;  
  public $size;
  public $tmp_path;
  public $errors = array();
  public $upload_errors = array(
      UPLOAD_ERR_OK            => "There is no error",
      UPLOAD_ERR_INI_SIZE      => "The uploaded file esceeds the upload_max filsize directive",
      UPLOAD_ERR_FORM_SIZE     => "The uploaded file esceeds the MAX_FILE_SIZE  directive",
      UPLOAD_ERR_PARTIAL       => "The file was onlt partically uploaded",
      UPLOAD_ERR_NO_FILE       => "NO file was uploaded",
      UPLOAD_ERR_NO_TMP_DIR    => "Missing a temporary folder",
      UPLOAD_ERR_CANT_WRITE    => "Failed to write file to disk",
      UPLOAD_ERR_EXTENSION     => "A php extension dtopped the filr upload"

  );

    //======METHODDS=======

  public function placeholders()
  {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS .$this->user_image;
  }

  public static function verify_user($username,$password)
  {
      global $database;
      $username = $database->escape($username);
      $password = $database->escape($password);
      $sql = "SELECT * FROM ".self::$db_table ." WHERE username='{$username}' AND password='{$password}' LIMIT 1";
      $the_result_array = self::find_this_query($sql);
      return !empty($the_result_array) ? array_shift($the_result_array) : false;

  }
  public function set_file($file)
  {
    //error checking
    if(empty($file) || !$file || !is_array($file))
    {
        $this->errors[] = "There was no file uploaded here";
        return false;
    }
    else if($file['error']!=0)
    {
        $this->errors[] = $this->upload_errors[$file['error']];
        return false;
    } 
    else 
    {
        //if there is no error then we assign the values
        $this->user_image = basename($file['name']);
        $this->tmp_path = $file['tmp_name'];
        $this->type     = $file['type'];
        $this->size     = $file['size'];
    }
  }
  public function save_photo()
  {
    if (!empty($this->errors))
    {
      return false;
    }
    if(empty($this->user_image) || empty($this->tmp_path))
    {
      $this->errors[] = "The file was not available";
      return false;
    }
    $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->user_image;
    if(file_exists($target_path))
    {
      $this->errors[] = "The file {$this->user_image} already exists";
      return false;
    }
    if(move_uploaded_file($this->tmp_path,$target_path))
    {
      if($this->create())
      {
        unset($this->tmp_path);
        return true;
      }
    }
    else 
    {
      $this->errors[] = "The file directory probably does not have premission";
      return false;
    }
    
  }
  public function delete_photo()
  {
      if($this->delete())
      {
              $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory. DS.$this->user_image;
              return unlink($target_path) ? true : false;
             
      }
      else
      {
              return false;
      }
  }

  public function ajax_save_user_image($user_image,$user_id)
  {
      global $database;
      $user_image       = $database->escape($user_image);
      $user_id          = $database->escape($user_id);
      $this->user_image = $user_image;
      $this->id         = $user_id;
      $sql="UPDATE " . self::$db_table . " SET user_image='{$this->user_image}' 
      WHERE id={$this->id}";
      $update_image = $database->query($sql);
      echo $this->placeholders();
  }

   

   
  
  


}




?>