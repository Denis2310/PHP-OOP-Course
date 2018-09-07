<?php include("includes/admin_header.php"); ?>

 <?php   
 if(!$session->is_signed_in()) {

    redirect("login.php");
 } 
?>

        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>


<?php

    if(isset($_GET['delete'])) {

        $comment = Comment::find_by_id($_GET['delete']);

        if($comment) {

            $comment->delete();
        }
    }

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Comments
                        </h1>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Body</th>
                                    <th>For Photo</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                    $comments = Comment::find_all();

                                    if($comments) {

                                       foreach ($comments as $comment) {

                                        $photo = Photo::find_by_id($comment->photo_id);
                                        $path = $photo->picture_path();
                                        echo "<tr>";
                                        echo "<td> $comment->id </td>";
                                        echo "<td> $comment->author </td>";
                                        echo "<td> $comment->body </td>";
                                        echo "<td><a href='../photo.php?view={$photo->id}'><img src='{$path}' height=120 width=200/></a></td>";
                                        echo "<td> <a onclick=\" javascript: return confirm('Are you sure you want to delete this comment?');\" href='comments.php?delete=$comment->id'>Delete</a></td>";
                                        echo "</tr>";
                                       } 
                                    }
                                    

                                 ?>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/admin_footer.php"); ?>