<?php
//database connecttion here

include("conn.php");


// Check if the form has been submitted(login post)
if (isset($_POST['submit'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $user_email = validate($_POST['user_email']);
    // $user_type = validate($_POST['user_type']);
    $password = validate($_POST['password']);


  // Check if the username and password match a user in the database
    if (empty($username) or empty($password) or empty($user_email)){
        header("Location: add_user_page.php?error=User id or passwword or email is required");
        exit();
        }
    
        
    else{
        $sql1 = "SELECT * FROM users WHERE username='$username' || email='$user_email'";
        $result1 = mysqli_query($conn, $sql1);

            if (mysqli_num_rows($result1)>0){
                echo "account already exist";
            }
            else{
                $sql = "INSERT INTO users (username, password, email) 
                VALUES ('$username', '$password', '$user_email')";
                $result = mysqli_query($conn, $sql);
                
                if ($result){

                    echo "data uploaded successfully";
                    
                }
                else{
                    echo "big error made";
                }

    }
    }
}

else{
    echo "else executed";
}
?>