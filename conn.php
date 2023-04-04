<?php

$hname = "localhost";
$username = "root";
$password = "";

$dbname = "file_upload";

$conn = mysqli_connect($hname, $username, $password, $dbname);


if (!$conn){
    echo "connection failed";
}


?>