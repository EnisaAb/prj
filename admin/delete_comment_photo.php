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
    $session->message("The comment has been deleted");
    $comments->delete();
    redirect("comment_photo.php?id={$comments->photo_id}");
}
else{
    $session->message("The comment has been deleted");
    redirect("comment_photo.php?id={$comments->photo_id}");
}
?>
