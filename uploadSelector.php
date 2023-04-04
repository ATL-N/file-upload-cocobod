<?php
include("login.php");
if (empty($_SESSION['username'])){
	header("Location:login_page1.php");
	exit;
}

$hname = "localhost";
$username = "root";
$password = "";

$dbname = "file_upload";

$conn = mysqli_connect($hname, $username, $password, $dbname);


if (!$conn){
    echo "connection failed";
}
 




global $result;
$sql = "SELECT * FROM folder GROUP BY folder_name ORDER BY  folder_name ASC, table_id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title>File Upload SELECTOR</title>
    <link rel="stylesheet" href="file_upload.css">
	<link rel="icon" href="resources/logo.jpg" type="image/x-icon">


</head>
<body>
	<div class="h1">
		<div class="h1_div">
		<h1>File Upload folder selector</h1>
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='search_selector.php'">VIEW FILES</button>	
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='index.php'">HOME</button>
		
		</div>

		

	</div>


	<form method="POST" enctype="multipart/form-data" action="uploadSelector1.php">
		Select folder to upload files into:
		<label for="folder_name">Folder Name:</label>
		<select name="folder_name" id = "folder_name" required> 
			<option value=""></option>
            <?php 
            global $result;

            while ($row = mysqli_fetch_assoc($result)){
                $table_id = $row['table_id'];
                $folder_number = $row['folder_number'];
                $folder_name = $row['folder_name'];
                echo $folder_name;
            ?>

            <option value="<?php echo $folder_name; ?>"><?php echo $folder_name; ?></option>;
            <?php } ?>

        <br>
		<input type="submit" value="Upload">
		
		
	</form>
   
</body>
</html>