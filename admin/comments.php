<?php include("includes/header.php"); 
if(!$session->is_signed_in())
{     
    redirect("login.php");
}

$comments = Comment::find_all();

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SB Admin</a>
            </div>
            <?php include "includes/top_nav.php" ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include "includes/left_nav.php" ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Comments
                    </h1>
                    <p class="bg-success"><?php  echo $message ?></p>
                   <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Photo Id</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                 </tr>

                            </thead>
                            <tbody>
                                <?php foreach($comments as $comment): ?>
                                <tr>
                                <td><?php echo $comment->id ?></td>
                                <td><?php echo $comment->photo_id ?></td>
                                 <td><?php echo $comment->author; ?>
                                 <div class="actions_link">
                                    <a href="delete_comment.php?id=<?php echo $comment->id ?>">Delete</a>
                                 </div></td>
                                    <td><?php echo $comment->body; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                   </div> 


                </div>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>