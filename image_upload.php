<?php
		session_start();
		$page_title='Image Upload';
		include('includes/header.html');
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
		require ('connect_db.php');
		$target_dir = "images/";#selects the folder to upload file
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);#Sets the file path
		$uploadOk = 1;#signifies success in the upload
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);#Used to check the file type
		// Check if image file is a actual image or fake image
		 {
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) 
			{
				$uploadOk = 1;
			} 
			else
			{
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) 
		{
			echo '<p>Sorry, file already exists.</p>';
			$uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) 
		{
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) 
		{
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) 
		{
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
			else {
						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
					{
						echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
						$new_book_id=$_SESSION['new_book_id'];
						echo $target_file;
						//echo $book_id;
						$q= "UPDATE books  SET book_img = '$target_file' WHERE book_id=$new_book_id";
						$r=  mysqli_query($dbc, $q);
						if($r)
						{
										echo 'Complete'; 
						}
					else 
						{
						  echo 'Error';
						}
					}
					else {
						echo "Sorry, there was an error uploading your file.";
						}
				}
		}
			echo '<p><a href="add_book.php">Add a Book</a> |
				<a href="goodbye.php">Logout</a></p>';
			echo '<p><a href= "author_page.php">Admin Area</a> </p>';
			
?>
<form action="image_upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<?php include('includes/footer.html');?>

