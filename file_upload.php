<?php
//database connecttion here
include("login.php");
if (empty($_SESSION['username'])){
	header("Location:login_page1.php");
	exit;
}

include("conn.php");


$folder_name=$_GET['folder_name'];
$folder_number=$_GET['folder_number'];
// echo $folder_name;

$sql = "SELECT * FROM files WHERE folder_number = '$folder_number' ORDER BY reference_number DESC LIMIT 1";
$result = mysqli_query($conn, $sql);



function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  
$ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;  

$sysinfo = php_uname('n');
// echo $sysinfo;






if (mysqli_num_rows($result)>0){
	$row = mysqli_fetch_assoc($result);
	$last_reference = $row['reference_number'];
	$last_reference_show = $last_reference;
}

else{
	$last_reference = 0;
	$last_reference_show = "none";
	// echo "empty folder";
}

	$last_reference_int = (int)$last_reference;

	$next_reference = $last_reference_int + 1;

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
		<h1>File Upload Form</h1>
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='search_selector.php'">view FILES</button>	
		</div>

		<div class="home_div">
		<button class="button" onclick="document.location='index.php'">HOME</button>
		
		</div>

		

	</div>


	<form method="post" enctype="multipart/form-data" action="">
	<div class="select_folder_div">
      <button class="button" id="button_select" onclick="document.location='uploadSelector.php'">change folder</button>
    
  </div>
  <br>
	

	

		<label class="label" for="file">Select a file to upload:</label>
		<input type="file" id="file" name="file" accept="application/pdf"  required>
		<!-- ,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document -->
		<!-- <br> -->
		<div class="folder_details">
			<div class="folder_n">
				<label class="label" for="folder_name">Folder Name:</label>
				<input type="text" id="folder_name" name="folder_name" value="<?php echo $folder_name; ?>" required readonly >	
			</div>

			<div class="folder_n1">
				<label class="label" for="folder_number">Folder Number:</label>
				<input type="text" id="folder_number" name="folder_number" value="<?php echo $folder_number; ?>" required readonly>	
			</div>
		
			</div>
		<!-- <br> -->
		<div class="folder_details">
			<div class="folder_n">
				<label class="label hidden" for="last_reference">Last reference:  </label>
				<!-- <label class="label1"><?php echo $last_reference; ?></label> -->
				<input type="text" id="last_reference" name="last_reference" value="<?php echo $last_reference_show; ?>" class=number min="1" required readonly>
			</div>

			<div class="folder_n1">
				<label class="label" for="reference_number">Reference Number:</label>
				<input type="number" id="reference_number" name="reference_number" value="<?php echo $next_reference; ?>" class=number min="1" required>
			</div>
		</div>

		<!-- <br> -->
		<label class="label" for="dispatch_date">Dispatch Date:</label>
		<input type="date"  id="dispatch_date" name="dispatch_date" class=number required>
		
		<br>
		<label class="label" for="description">Description:</label>
		<textarea id="description" name="description"></textarea>
		<br>
		<input type="submit" onclick="" value="Upload" id="Upload" name="Upload">
	</form>



<?php


function createConfirmationbox($message, $url){ ?>
  <script>
      alert("<?php echo $message;?>")
      document.location = "<?php echo $url;?>";
      console.log("loaded");
	//   header("location:file_upload.php?folder_name=$folder_name&folder_number=$folder_number";)
      
        
  </script>



<?php
}
?>
<?php



// Check if the form has been submitted
if (isset($_POST['Upload'])) {

  // Set the reference number and upload directory
  $reference_number = $_POST["reference_number"];
  $dispatch_date = $_POST["dispatch_date"];
  $user_PC = get_current_user();
  // echo "user: ";
  // echo $user_PC;

  $ref_no = "";
  // $upload_dir = "uploads/";
  $upload_dir = "/opt/lampp/htdocs/";

  // Get file information
  $file_name = $_FILES["file"]["name"];
  $file_tmp_name = $_FILES["file"]["tmp_name"];
  $file_size = $_FILES["file"]["size"];
  $file_error = $_FILES["file"]["error"];

  // Check if the file was uploaded without errors
  if ($file_error === UPLOAD_ERR_OK) {

    // Move the uploaded file to the designated directory
    move_uploaded_file($file_tmp_name, $upload_dir . $file_name);

    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $folder_name = mysqli_real_escape_string($conn, $_POST["folder_name"]);
    $folder_number = mysqli_real_escape_string($conn, $_POST["folder_number"]);
    $unique_reference = $folder_number.'/'.$reference_number;

	$sql1 = "SELECT * FROM files WHERE unique_reference='$unique_reference'";
	$result = mysqli_query($conn, $sql1);

	if (mysqli_num_rows($result)<1){

      $sql = "INSERT INTO files (filename, folder_name, folder_number, reference_number, unique_reference, description, dispatch_date, user_pc ) 
              VALUES ('$file_name', '$folder_name', '$folder_number', '$reference_number', '$unique_reference', '$description', '$dispatch_date', '$user_PC')";
      mysqli_query($conn, $sql);


      // header("Location: file_upload.php?success=$file_name uploaded successfully & folder_name=$folder_name & folder_number=$folder_number");
      $message = "file uploaded successfully";
      $url = "file_upload.php?folder_name=$folder_name&folder_number=$folder_number";
	  createConfirmationbox($message, $url);
	}
    else{
		$message = "file already exist";
		$url = "file_upload.php?folder_name=$folder_name&folder_number=$folder_number";
		createConfirmationbox($message, $url);
	}



  } else {

    // Output an error message
    // header("Location: file_upload.php?error=Error uploading file:  $file_error & folder_name=$folder_name & folder_number=$folder_number");
    
    $message = "error uploading file";
    $url = "file_upload.php?folder_name=$folder_name&folder_number=$folder_number";
    createConfirmationbox($message, $url);
  }

}
?>



</body>
</html>

