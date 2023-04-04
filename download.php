
<?php
//database connecttion here

include("conn.php");




if (isset($_GET["file"]) && !empty($_GET["file"])) {
//   $conn = mysqli_connect("localhost", "username", "password", "database");
  $file = mysqli_real_escape_string($conn, $_GET["file"]);
  $sql = "SELECT * FROM files WHERE description LIKE '%$search%' OR reference_number LIKE '%$search%' OR filename LIKE '%$search%'";
  $result = mysqli_query($conn, $sql);
  if ($row = mysqli_fetch_assoc($result)) {
    $filepath = "uploads/" . $row["filename"];
    header("Content-Type: application/octet-stream");
    header("Content-Disposition: attachment; filename=\"$file\"");
    readfile($filepath);
  } else {
    echo "File not found.";
  }
} else {
  echo "Invalid request.";
}
?>
