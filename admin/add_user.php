<?php include("includes/admin_header.php"); ?>

<!-- Navigation -->
  <?php include("includes/admin_navigation.php"); ?>

<?php  

if(!$session->is_signed_in()) {

    redirect("login.php");
  }
?>



<?php   //Unexpected end of file -> provjeriti
  
  if(isset($_POST['add_user'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    if(!empty($username) && !empty($password) && !empty($first_name) && !empty($last_name))
    {

      $user = new User();
      $user->username = $username;
      $user->password = $password;
      $user->first_name = $first_name;
      $user->last_name = $last_name;

      if(!empty($_FILES['user_image'])) {

        $user->upload_image($_FILES['user_image']);
      }

      if($user->save()) {

        $message= "";
        redirect("users.php"); 
      
      } else {

        $message="Something went wrong, user is not registered!";
      }



    } else {

      $message = "Fields cannot be empty";
    }

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
                        Add User
                    </h1>               
                </div>
            </div> <!-- /.row -->
            
            <div class="row">

             <form action="" method="post" enctype="multipart/form-data">
        
                <div class="col-md-6">

                  <?php echo $message; ?>

                  <div class="form-group">
                    <label for="username">Username:</label>
                		<input class="form-control" type="text" name="username">
                  </div>

                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input class="form-control" type="password" name="password">
                  </div>

                  <div class="form-group">
                		<label for="first_name">First Name:</label>
                		<input type="text" class="form-control" name="first_name">
                  </div>

                  <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="last_name">
                  </div>

                  <div class="form-group">
                    <label for="user_image">User Image:</label>
                    <input type="file" name="user_image">
                  </div>

                  <input type="submit" class="btn btn-primary pull-right" name="add_user" value="Add User">

                </div> <!-- /.col-md-6 -->

                </form>

            </div> <!-- /.row -->

        </div> <!-- /.container-fluid -->
        

    </div> <!-- /#page-wrapper -->
        

  <?php include("includes/admin_footer.php"); ?>