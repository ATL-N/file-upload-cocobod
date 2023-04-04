<?php
//database connecttion here
include("conn.php");



// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Set the reference number and upload directory
  $reference_number = $_POST["reference_number"];
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

    // Insert file information into the database
    // $conn = mysqli_connect("localhost", "username", "password", "database");
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $folder_name = mysqli_real_escape_string($conn, $_POST["folder_name"]);
    $folder_number = mysqli_real_escape_string($conn, $_POST["folder_number"]);

    

      $sql = "INSERT INTO files (filename, folder_name, folder_number, reference_number,  description) VALUES ('$file_name', '$folder_name', '$folder_number', '$reference_number', '$description')";
      mysqli_query($conn, $sql);

      // Output a success message
      header("Location: search_admin.php? ref_no=$ref_no");
      // echo "File uploaded successfully.";
      // echo($folder_name);
  

  } else {

    // Output an error message
    echo "Error uploading file: " . $file_error;

  }

}

