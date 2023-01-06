<?php include("includes/init.php"); 
if(!$session->is_signed_in())
{     
    redirect("login.php");
}
if(empty($_GET['id']))
{
    redirect("users.php");
}
$user = User::find_byId($_GET['id']);
if($user)
{
    $user->delete_photo();
    $session->message("The user has been deleted");
   
    redirect("users.php");
}
else{
    $session->message("The user has been deleted");
    redirect("users.php");
}
?>
