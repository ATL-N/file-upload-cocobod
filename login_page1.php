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


    <h3>Login</h3>
     <!-- <hr /> -->
     <div class="form_div">
    <form method="post" action="login.php">
    <?php if (isset($_GET["error"])){ ?>
        <div id="error_id" class="form_message form_message--error "><?php echo $_GET["error"]; ?></div>
    <?php } ?>
        <label for="username">Employee ID:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit" name="loginBtn" id="loginBtn">Login</button>
    </form>
</div>

    </div>


    </span>
  </div>


</body>
</html>