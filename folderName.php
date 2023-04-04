<?php
include("login.php");
if (empty($_SESSION['username'])){
	header("Location:login_page1.php");
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>File Upload Form</title>
    <link rel="stylesheet" href="file_upload.css">
	<link rel="icon" href="resources/logo.jpg" type="image/x-icon">


</head>
<body>
	<div class="h1">
		<div class="h1_div">
		<h1>CREATE NEW FOLDER</h1>
		</div>

		<!-- <div class="home_div">
		<button class="button" onclick="document.location='search.php'">FILES</button>	
		</div> -->

		<div class="home_div">
		<button class="button" onclick="document.location='index.php'">HOME</button>
		
		</div>

		

	</div>


	<form method="POST" enctype="multipart/form-data" action="folder_name_upload.php">

	<?php if (isset($_GET["error"])){ ?>
			<div id="error_id" class="form_message form_message--error "><?php echo $_GET["error"]; ?></div>
	<?php } ?>

	<?php if (isset($_GET["success"])){ ?>
			<div id="success_id" class="form_message form_message--success "><?php echo $_GET["success"]; ?></div>
	<?php } ?>

	<br>
		
		<label for="folder_number">Folder Number:</label>
		<input type="text" id="folder_number" name="folder_number" required>	
        <br>
        <label for="folder_name">Folder Name:</label>
		<input type="text" id="folder_name" name="folder_name" required>	
        <br>
		<input type="submit" value="Upload">
		
		
	</form>
   
</body>
</html>