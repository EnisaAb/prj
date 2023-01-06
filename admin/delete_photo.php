<?php include("includes/init.php"); 
if(!$session->is_signed_in())
{     
    redirect("login.php");
}
if(empty($_GET['id']))
{
    redirect("photos.php");
}
$photo = Photo::find_byId($_GET['id']);
if($photo)
{
    $photo->delete_photo();
    $session->message("The photo has been deleted");
    redirect("photos.php");
}
else{
    $session->message("The photo has been deleted");
    redirect("photos.php");
}
?>
