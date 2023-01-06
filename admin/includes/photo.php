<?php
class Photo extends Db_object
{
  
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', 'filename','type','size');
    public $photo_id;
    public $title;
    public $description;
    public $filename;
    public $type;  
    public $size;
    public $tmp_path;
    public $errors = array();
    public $upload_directory = "images";
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
//the function to take the file 
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
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
        }
    }
   
//function to save that file to a path
public function save()
{
    if($this->photo_id)
    {
        $this->update();
    }
    else
    {
        if (!empty($this->errors)) {
                return false;
        }
        if(empty($this->filename) || empty($this->tmp_path))
        {
                $this->errors[] = "The file was not available";
                return false;
        }
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
        if(file_exists($target_path))
        {
            $this->errors[] = "The file {$this->filename} already exists";
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

}




}




?>