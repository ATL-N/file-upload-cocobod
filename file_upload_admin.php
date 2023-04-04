
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
		<h1>File Upload Form</h1>
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='search_selector.php'">FILES</button>	
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='dashboard_admin.php'">HOME</button>
		
		</div>

		

	</div>


	<form method="POST" enctype="multipart/form-data" action="upload2.php">
		<label for="file">Select a file to upload:</label>
		<input type="file" id="file" name="file" required>

		<br>
		<label for="folder_name">Folder Name:</label>
		<input type="text" id="folder_name" name="folder_name" required>	

		<br>
		<label for="folder_number">Folder Number:</label>
		<input type="text" id="folder_number" name="folder_number" required>	

		<br>
		<label for="reference_number">Reference Number:</label>
		<input type="number" id="reference_number" name="reference_number" class=number required>
		<!-- <br>
		<label for="department">Department:</label>
		<select name="department" id= "department"> 
			<option value=""></option>
			<option value="sales">sales</option>
			<option value="marketing">marketing</option>
			<option value="hr">hr</option>
			<option value="finance">finance</option>
		</select> -->
						
		<br>
		<label for="description">Description:</label>
		<textarea id="description" name="description"></textarea>
		<br>
		<input type="submit" value="Upload">
	</form>

</body>
</html>