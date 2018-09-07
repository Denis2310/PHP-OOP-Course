<?php include("includes/admin_header.php"); ?>

<?php   if(!$session->is_signed_in())
{
    redirect("login.php");
}?>

<?php
    $photos = Photo::find_all();
?>


        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Photos
                        </h1>               
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    
                    <div class="col-md-12">

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Comments</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php

                            foreach ($photos as $photo): 

                                $photo_comments = Comment::find_the_comments($photo->id);
                                $number_of_comments = count($photo_comments);

                                ?> 

                                <tr>
                                    <td><?php echo $photo->id;  ?></td>
                                    <td><img src="<?php echo $photo->picture_path(); ?>" height=120 width=200/>

                                        <div class="pictures_link" style="padding-top: 2px;">
                                            <a href="delete_photo.php?delete=<?php echo $photo->id; ?>" class="btn btn-primary">Delete</a>
                                            <a href="edit_photo.php?edit=<?php echo $photo->id; ?>" class="btn btn-primary">Edit</a>
                                            <a href="../photo.php?view=<?php echo $photo->id; ?>" class="btn btn-primary">View</a>

                                        </div>

                                    </td>


                                    <td><?php echo $photo->filename;  ?>    </td>
                                    <td><?php echo $photo->title;     ?>    </td>
                                    <td><?php echo $photo->description; ?>  </td>
                                    <td><?php echo $photo->size;      ?>    </td>
                                    <td><a href='comment_photo.php?photo_id=<?php echo $photo->id; ?>'><?php echo $number_of_comments; ?></a> </td>
                                </tr>  

                            <?php endforeach ?>
                            
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/admin_footer.php"); ?>