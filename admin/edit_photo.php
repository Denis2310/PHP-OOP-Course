<?php include("includes/admin_header.php"); ?>

<!-- Navigation -->
    <?php include("includes/admin_navigation.php"); ?>

<?php  

if(!$session->is_signed_in()) {

    redirect("login.php");
  }
?>

<?php
  
  if(isset($_GET['edit'])) {

    $photo_id = $_GET['edit'];
    $photo = Photo::find_by_id($photo_id);
    
    if(!$photo) { die("Error: " . $database->connection); }

  } else {

    redirect("photos.php");
  }

?>

<?php
  
  if(isset($_POST['update'])) {

    $photo_title = $_POST['title'];
    $photo_description = $_POST['description'];

    $photo->title = $photo_title;
    $photo->description = $photo_description;

    if($photo->save()) { 

      $message = "Photo updated. <a href = 'photos.php'>View All Photos</a>"; 

    } else { $message = ""; }

  } else {

    $message = "";
  }

?>
      <div id="page-wrapper">


        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit photo
                        <small> <?php echo $photo->title; ?> </small>
                    </h1>               
                </div>
            </div> <!-- /.row -->
            
            <div class="row">

             <form action="" method="post">
        
                <div class="col-md-6">

                  <?php echo $message; ?>

                  <div class="form-group">
                    <label for="title">Title:</label>
                		<input class="form-control" type="text" name="title" value="<?php echo $photo->title; ?>">
                  </div>
                <!--
                  <div class="form-group">
                		<label for="caption">Caption:</label>
                		<input class="form-control" type="text" name="caption">
                  </div>
                -->
                  <div clas="form-group">
                		<label for="description">Description:</label>
                		<textarea class="form-control" name="description" cols="30" rows="5"><?php echo $photo->description; ?></textarea>
                  </div>

                </div> <!-- /.col-md-6 -->

                <div class="col-md-4 col-md-offset-1" >
                    <div  class="photo-info-box">

                        <div class="info-box-header">
                            <h4 class="text-center"><strong>Details</strong></h4>
                        </div>

                        <div class="inside"  style="margin-top: 20px;>
                          	<div class="box-inner">
                              	<p class="text ">
                                	Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                              	</p>
                              	<p class="text">
                                	Filename: <span class="data"><?php echo $photo->filename; ?></span>
                              	</p>
                             	<p class="text">
                              		File Type: <span class="data"><?php echo $photo->type; ?></span>
                             	</p>
                             	<p class="text">
                               		File Size: <span class="data"><?php echo $photo->size; ?></span>
                             	</p>
                          	</div>

                            <hr>

                          	<div class="info-box-footer clearfix" style="margin-top: 20px;">

                            	<div class="info-box-delete pull-left">
                                	<a  href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg "> Delete </a>   
                            	</div>

                            	<div class="info-box-update pull-right ">
                                	<button type="submit" name="update" class="btn btn-primary btn-lg "> Update </button>
                            	</div>  
                               
                        	</div>
                        </div>          
                    </div>
                </div>

                </form>

            </div> <!-- /.row -->

        </div> <!-- /.container-fluid -->
        

    </div> <!-- /#page-wrapper -->
        

  <?php include("includes/admin_footer.php"); ?>

