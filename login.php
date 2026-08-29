<?php 
include('crud_conn_files/server.php');
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<title>CTG Limited: Login</title>
</head>
<body>
	<h1>Commodity Trading Group Limited</h1>
	<div class="logo_section">
		<a href="index.php"><img src="icons/4_ctg_logo.png" alt="CTG Logo"></a>
	</div>
	<div class="header">
		<h2>CTG: IMS Login</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Enter Username</label>
			<input type="text" name="username" id="myInput">
		</div>
		<div class="input-group">
			<label>Enter Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
	  <select class="opt" name="role">
	    <option value="0">User Role</option>
	    <option value="System Administrator">System Administrator</option>
	    <option value="Production Manager">Production Manager</option>
	    <option value="Warehouse Manager">Warehouse Manager</option>
	    <option value="Wholesaler">Wholesaler</option>
	  </select>
	  </div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>
			<button type="reset" class="btn" value="Reset">Clear</button>
		</div>
	</form>

	<div class="footer">
	    <p>CTG Limited</p>  
	    <p>Copyright&nbsp;&copy; 2024</p>         
	    <p>All Rights Reserved</p>
    </div>

    <div class="footer-box">
    <ul class="footer-social">
      <li><a href="http://facebook.com"><img src="icons/facebook-icon.png" alt="Facebook"></a></li>
      <li><a href="https://whatsapp.com/"><img src="icons/whatsapp-icon.png" alt="WhatsApp"></a></li>
      <li><a href="http://instagram.com"><img src="icons/instagram-icon.png" alt="Instagram"></a></li>
      <li><a href="https://telegram.org/"><img src="icons/telegram-icon.png" alt="Telegram"></a></li>
    </ul>    
  	</div>
</body>
</html>