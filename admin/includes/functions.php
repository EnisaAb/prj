<?php 
//mundeson gjetjen e file nese kemi harruar ta shtojme te init.php
function classAutoLoader($class)
{
    $class = strtolower($class);
    $the_path = "includes/{$class}.php";
    if(is_file($the_path)&& !class_exists($class))
    {
        require_once($the_path);
    }
    else
    {
        die("This file name {$class}.php was not found..");
    }
}

spl_autoload_register('classAutoLoader');

function redirect($location)
{
    header("Location: $location");
}
?>