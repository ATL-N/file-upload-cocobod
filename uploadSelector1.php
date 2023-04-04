
<!-- SELECT CONCAT(folder_number,'/',reference_number) as unique_reference FROM files;
UPDATE files SET unique_reference=CONCAT(folder_number,'/',reference_number);

 -->

<?php

session_start();
include("conn.php");



    if (isset($_POST['folder_name'])){
        
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $folder_name = validate($_POST["folder_name"]);

        // $sql = "SELECT * FROM folder ORDER BY table_id DESC, folder_name ASC";


        $sql = "SELECT * FROM folder WHERE folder_name='$folder_name' ORDER BY table_id DESC, folder_name ASC";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)>0){
            $folder_number = $row['folder_number'];
        }

        if ($_SESSION['username']=='admin'){
            header("Location: file_upload.php? folder_name=$folder_name & folder_number=$folder_number");
            exit();
        }
        else{
            header("Location: file_upload.php? folder_name=$folder_name & folder_number=$folder_number");
            exit();
        }
    
    }



?>
    