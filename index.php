<?php
//This is the index page where registered users can log in and unregisted users can be linked to register page
session_start();//session_start() helps to hold session variables which can be usedd anywhhere in the app
require 'inc/connect.php';

//once the login button is clicked tthis checks whethher the user exists by querying the database with the email and password
if(isset($_POST['login'])){
	$email=$_POST['email'];
	$password=$_POST['password'];
	//validate username and password from db
	$query = "select * from tbl_users where fld_email = '".$email."'";
	$getuser=$conn->query($query);
	if($getuser->num_rows > 0){
		$user = $getuser->fetch_assoc();
		if($user['fld_email']==$email && password_verify($password,$user['fld_password'])){
			$userid = $user['fld_userid'];
			$_SESSION['id']=$userid;
			$_SESSION['secret'] =  $user['fld_secret'];
			//firstt layer of authentication ends here, next layer is at verifylogin.php
			header('location:verifylogin.php');//the browser automatically loads verifylogin.php
		}
		else
			$message =  "Invalid Password";
		
	}
	else{
		$message =  "User Doesn't Exist";
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>2fa - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<div class='container-fluid'>
<center><h1>Two Factor Authentication System using QRCode/ Token authentication</h1></center>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">

				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button type="submit" name="login" class="btn btn-primary" style="width:100%;">Login</a></fieldset></button>
					</form>
					<?php if (isset($message))
								echo "<div class='alert alert-warning' style='margin-top:10px;'>
							      <strong>".$message."</strong>
							    </div>";?>
					<p>Don't have an account yet? Register<a href = 'register.php'> here</a></p>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	</div>

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
