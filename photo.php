<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>


<?php 

    if(empty($_GET['view'])) {

        redirect ("index.php");
    }

    $photo = Photo::find_by_id($_GET['view']);

?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
                <div class="col-md-10 col-md-offset-1">
                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Photo Author</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Time of photo creation</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/images/<?php echo $photo->filename; ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"> <?php echo $photo->description; ?> </p> 
               

                <hr>

                <!-- Blog Comments -->




                <!-- Comments Form -->

                <?php

                    if(isset($_POST['submit_comment'])) {

                        $comment_author = $_POST['author'];
                        $comment_body = $_POST['body'];
                        
                        if(!empty($comment_author) && !empty($comment_body)) {

                            $comment = Comment::create_comment($photo->id, $comment_author, $comment_body);
                            
                            if($comment) {

                                $comment->save();
                                $message = "Comment saved in database.";

                            } else {

                                $message = "There was some problems saving.";
                            }

                        } else {

                            $message = "Fields cannot be empty.";
                        } 

                    } else {

                        $message = "";
                    }

                ?>

                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post" action="">
                        <?php echo $message; ?>
                        <div class="form-group">
                            <label for="author">Author:</label>
                            <input type="text" class="form-control" name="author">
                        </div>


                        <div class="form-group">
                            <label for="body">Comment:</label>
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" name="submit_comment">Submit</button>

                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->

                <?php

                $comments = Comment::find_the_comments($photo->id);

                if($comments) {

                    foreach($comments as $comment) {

                ?>

                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="medi-object" src="https://via.placeholder.com/75x75"/>
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">
                            <strong><?php echo $comment->author; ?></strong> <small>Date</small>
                        </h4>

                        <?php echo $comment->body; ?>
                    </div>
                </div>

                <?php

                    }

                }

                 ?>

            </div>                        
                </div>
                <!-- Blog Post -->



        </div>
        <!-- /.row -->

        <?php include "includes/footer.php"; ?>