<?php include("includes/init.php"); 
if(!$session->is_signed_in())
{     
    redirect("login.php");
}
if(empty($_GET['id']))
{
    redirect("comments.php");
}
$comments = Comment::find_byId($_GET['id']);
if($comments)
{
    $comments->delete();
    $session->message("The comment has been deleted");
    redirect("comments.php");
}
else{
    $session->message("The comment has been deleted");
    redirect("comments.php");
}
?>
