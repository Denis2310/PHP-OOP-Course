<?php include('includes/init.php'); ?>

<?php   

	if(!$session->is_signed_in()) {

    redirect("login.php");
	}
?>

<?php

if(!empty($_GET['delete'])) {

	$photo_id = $_GET['delete'];
	$photo = Photo::find_by_id($photo_id);
	
	if($photo) {

		$photo->delete_photo();

	} else {

		redirect('../photos.php');
	}

} else {

	redirect('../photos.php');
}

?>