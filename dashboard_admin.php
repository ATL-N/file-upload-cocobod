<?php 
include("login.php");
// echo "session";
if (!isset($_SESSION['username'])){
	header("Location:login_page1.php");
	// echo "session";
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>File Upload Dashboard</title>
	<link rel="stylesheet" href="dashboard_admin.css">
	<link rel="icon" href="resources/logo.jpg" type="image/x-icon">


</head>
<body>
<div class="h1">
		<div class="h1_div">
		<h1>File Upload Dashboard</h1>
		</div>


		<div class="home_div">
		<button class="button" onclick="document.location='add_user_page.php'">ADD USER</button>	
		</div>	

		<div class="home_div">
		<button class="button" onclick="document.location='login_page1.php'">LOG OUT</button>	
		</div>	
		

	</div>
	
	<div class="container">
		<div class="card">
			<h2>Upload a File</h2>
			<p>Upload a file to the server.</p>
			<a href="uploadSelector.php">Upload a File</a>
		</div>
		<div class="card">
			<h2>View Files</h2>
			<p>View a list of uploaded files.</p>
			<a href="search_selector.php">View Files</a>
		</div>

		<div class="card">
			<h2>create new folder</h2>
			<p>Create a new folder or update </p>
			<a href="folderName.php">Add folder</a>
		</div>

		<div class="card">
			<h2>CREATE NEW VOLUME</h2>
			<p>create a new volume for existing folder</p>
			<a href="volumeNumber.php">view folders</a>
		</div>

	</div>
	<!-- <div class="back">
	</div> -->
	
</body>
</html>
