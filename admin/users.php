<?php include("includes/admin_header.php"); ?>

 <?php   
 if(!$session->is_signed_in()) {

    redirect("login.php");
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
                            Users
                        </h1>

                        <a href="add_user.php" class="btn btn-primary" style='margin-bottom: 10px;'>Add User</a>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                    $users = User::find_all();

                                    foreach($users as $user) {

                                        echo "<tr>";
                                        echo "<td> {$user->id} </td>";
                                        echo "<td> {$user->username} </td>";
                                        echo "<td> {$user->first_name} </td>";
                                        echo "<td> {$user->last_name} </td>";
                                        echo "<td> <img src='../user_images/{$user->user_image}' height=100 width=150> </td>";
                                        echo "<td> <a href='edit_user.php?edit=$user->id'>Edit</a> </td>";
                                        echo "<td> <a href='users.php?delete=$user->id'>Delete</a> </td>";
                                        echo "</tr>";
                                    }

                                ?>

                                <?php

                                    if(isset($_GET['delete'])) {

                                        $user_id = $_GET['delete'];
                                        $user = User::find_by_id($user_id);

                                        if($user->delete()) { redirect("users.php"); }
                                       
                                    }

                                ?>

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