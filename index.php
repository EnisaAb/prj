<?php include("includes/header.php"); ?>

<?php
$page = !empty($_GET['page']) ? $_GET['page'] : 1;
$items = 3;
$items_total = Photo::count_all();
$photos = Photo::find_all();
$paginate = new Paginate($page,$items,$items_total);
$sql = "SELECT * FROM photos LIMIT {$items} OFFSET {$paginate->offset()}" ;
$photos = Photo::find_this_query($sql);


?>
<div class="row">
    <div class="col-md-12">
        <div class="thumbnails row">
            <?php foreach ($photos as $photo):?>
                <div class="col-xs-6 col-md-3">
                    <a class="thumbnail" href="photo_specific.php?id=<?php echo $photo->id; ?>">
                        <img class="img-responsive home_page_photo" src="admin/<?php echo $photo->pictures_path(); ?>" alt="">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <ul class="pagination">
                <?php
                if ($paginate->page_total() > 1)
                {
                    if ($paginate->has_next()) 
                    {
                        echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                    }
                    ?>
                   
                    
                <?php
                for ($i = 1; $i <= $paginate->page_total(); $i++)
                {
                    if($i==$paginate->current_page)
                    {
                        echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                    else
                    {
                        echo "<li ><a href='index.php?page={$i}'>{$i}</a></li>"; 
                    }
                }
                ?>
                <?php
                    if ($paginate->has_previous())
                    {
                        echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                    }
                }
                 ?>
            
                
            </ul>
        </div>
    </div>    
</div>  
               
               
        <!-- /.row -->
<?php include("includes/footer.php"); ?>
