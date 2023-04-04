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
	<title>File Upload Form</title>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="resources/logo.jpg" type="image/x-icon">

</head>
<body>

<div class="back">
  <div class="back1">
  </div>



  <div class="div-center">


    <div class="content">


    <h3>ADD USER</h3>
     <!-- <hr /> -->
     <div class="form_div">
    <form method="post" action="add_user.php">
    <?php if (isset($_GET["error"])){ ?>
        <div id="error_id" class="form_message form_message--error "><?php echo $_GET["error"]; ?></div>
    <?php } ?>

    <label for="username">Employee ID:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="username">User Email:</label>
        <input type="email" name="user_email" id="user_email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit" name="submit">ADD USER</button>
    </form>
</div>

    </div>


    </span>
  </div>


</body>
</html>