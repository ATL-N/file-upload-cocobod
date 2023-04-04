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
	<title>View Files</title>
    <link rel="stylesheet" href="search1.css">
    <link rel="icon" href="resources/logo.jpg" type="image/x-icon">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

</head>

<?php
//database connecttion here

include("conn.php");


function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
global $folder_name;
$folder_name = "";
$table_id = validate($_GET["table_id"]);
$folder_name = validate($_GET["folder_name"]);
// $file_name = validate($_GET["filename"]);

// echo $table_id;


if(empty($table_id)) {
                    
    echo "cant delete the selected row";
    
    //   return $result;
  }

    else {
      
      $sql = "DELETE FROM files WHERE id = '$table_id' ";
      $result = mysqli_query($conn, $sql);

      if($result===TRUE){
        if ($_SESSION['username']=='admin'){
          header("Location: search_admin.php? folder_name=$folder_name");
          exit();
      }
      else{
        header("Location: search.php?folder_name=$folder_name");
        exit();
      }
        
        // echo "Record deleted successfully";
    
      } else{
        echo " file could not be deleted ";
      }
    }



?>