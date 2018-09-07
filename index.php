<?php include("includes/header.php"); ?>

<?php
    
    $page = !empty($_GET['page'])? (int)$_GET['page'] : 1;
    $items_per_page = 4;
    $items_total_count = Photo::count();

    $paginate = new Paginate($page, $items_per_page, $items_total_count);

    $sql = "SELECT * FROM photos ";
    $sql .= "LIMIT {$items_per_page} ";
    $sql .= "OFFSET {$paginate->offset()}";

    $photos = Photo::find_by_query($sql);
?>


    <!-- Navigation -->
<?php include("includes/navigation.php"); ?>

    <!-- Page Content -->
    <div class="container">
        
        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-10 col-md-offset-1"> 

            <div class="thumbnails row">

            <?php

                if($photos) {
                foreach ($photos as $photo): 

            ?>

                 <div class="col-md-3 col-sm-4">


                    <a class="thumbnail" href="photo.php?view=<?php echo $photo->id; ?>">

                        <img class="img-responsive home-page-photo" src="admin/<?php echo $photo->picture_path(); ?>">

                    </a>

                </div>

            <?php

                endforeach;
            } else {

                echo "<h2 class='text-center'> No images uploaded! </h2>";
            }

            ?>

            </div>
    
            <div class="row">

                <ul class="pagination">

                <?php
                    
                    if($paginate->pages_total() > 1) {

                        if($paginate->has_next()) {

                            echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                        }


                    for($i = 1; $i <= $paginate->pages_total(); $i++) {


                        if($i == $paginate->current_page) {

                            echo "<li class='active'><a href='index.php?page=$i'> $i </a></li>";
                        } else {

                              echo "<li><a href='index.php?page=$i'> $i </a></li>";                          
                        }


                    }



                        if($paginate->has_previous()) {

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
