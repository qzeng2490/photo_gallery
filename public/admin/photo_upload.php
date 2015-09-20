

<?php
require_once('../../includes/initialize.php');
require_once 'google/appengine/api/cloud_storage/CloudStorageTools.php';
use google\appengine\api\cloud_storage\CloudStorageTools;
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	



	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])) {
		$photo = new Photograph();
		$options = [ 'gs_bucket_name' => 'qiang2015' ];
		$upload_url = CloudStorageTools::createUploadUrl('photo_upload.php',$options);

		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);
		if($photo->save()) {
			// Success
      		$session->message("Photograph uploaded successfully.");
			redirect_to('list_photos.php');
		} else {
			// Failure
      $message = join("<br />", $photo->errors);
		}
	}
	
?>

<?php include_layout_template('admin_header.php'); ?>

	<h2>Photo Upload</h2>

	<?php echo output_message($message); ?>
  <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    <p><input type="file" name="file_upload" /></p>
    <p>Caption: <input type="text" name="caption" value="" /></p>
    <input type="submit" name="submit" value="Upload" />
  </form>
  

<?php include_layout_template('admin_footer.php'); ?>
		
