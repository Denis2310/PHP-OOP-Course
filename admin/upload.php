<?php require_once("includes/admin_header.php"); ?>
    
 <?php   
 if(!$session->is_signed_in()) {

    redirect("login.php");
 } 
?>

<?php

//Zakomentirao pa ako bude greška to je to
//$message="";
if(isset($_POST['submit'])) {

    $photo = new Photo();
    $photo->set_file($_FILES['file_upload']);
    
    if($photo->save()) {

        $message = "Photo uploaded succesfully. <a href='photos.php'>View All Photos</a>";
    
    } else {

        //$message = join("<br>", $photo->errors);
        $message = $photo->errors;
    }

} else {

    $message = "";
}


?>
        <!-- Navigation -->
        <?php include("includes/admin_navigation.php"); ?>



        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Upload
                        </h1>
                        
                        <div class="col-md-6">
                            <?php echo $message; ?>
                            <form action="upload.php" method="post" class="form-group" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="title">Photo title:</label>
                                <input type="text" name="title" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Photo description:</label>
                                <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="file_upload">Choose Image:</label>
                                <input type="file" name="file_upload">
                            </div>                            

                            <button class="btn btn-primary" type="submit" name="submit"> Upload </button>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/admin_footer.php"); ?>