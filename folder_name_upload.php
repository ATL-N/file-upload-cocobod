<?php
//database connecttion here
include("conn.php");



if (isset($_POST['folder_number']) && isset($_POST['folder_name'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    

    $folder_number = validate($_POST["folder_number"]);
    $folder_name = validate($_POST["folder_name"]);

    echo $folder_number;
    echo $folder_name;





   

    
        $sql1 = "SELECT * FROM folder WHERE folder_number='$folder_number' OR folder_name='$folder_name'";
        $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1)>0){
                header("Location: folderName.php? error=folder number OR name already exist");

                echo '<script type="text/javascript">

                        window.onload = function () { confirm("Folder already in the data"); }

                    </script>';
                echo "";
            }
            else{
                $sql = "INSERT INTO folder (folder_number, folder_name) 
                        VALUES ('$folder_number', '$folder_name')";
                $result = mysqli_query($conn, $sql);
                
                if ($result){
                    $sql = "UPDATE files SET unique_reference=CONCAT(folder_number,'/',reference_number)";
                    mysqli_query($conn, $sql);
                    header("Location: folderName.php? success=file uploaded succesfully");
                    // echo "name uploaded successfully.";
                    
                }
                else{
                    header("Location: folderName.php? error=error uploading file");
                    echo "name not uploaded.";
                }
  
    }

   
    



    // session_start();
    // header("Location: folderName.php?");
    // exit();
                }







?>
    


