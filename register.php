<?php
//Registration page for new users
session_start();
require 'inc/connect.php';
include "vendor/autoload.php";
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_POST['register'])){
	
	 $query = "SELECT * FROM tbl_users WHERE fld_email = '".$_POST['email']."'";
  	 $cemail  = $conn->query($query);
  if($cemail->num_rows > 0){
  	$response='Account Already Exists'; 
  	
  }
  else{
  	$_SESSION['firstname']=$_POST['firstname'];
  	$firstname = test_input($_POST['firstname']);
	$lastname = test_input($_POST['lastname']);
	$email = test_input($_POST['email']);
	$password_hash = password_hash($_POST['password'], PASSWORD_BCRYPT, array("cost" => 7, "salt" => "iamnotashamedofthegospelofchristitisgodspoweruntosalvation"));
	$secretFactory = new \Dolondro\GoogleAuthenticator\SecretFactory();
	$secret = $secretFactory->create('google2fa', $_POST['firstname']);
	$savesecret =  base64_encode(serialize($secret));
	$_SESSION['secret'] =  $savesecret;
	$secretKey = $secret->getSecretKey();
    $queryinsert = "INSERT INTO tbl_users (fld_firstname, fld_lastname,fld_email, fld_password,fld_secret)
                    VALUES ('$firstname','$lastname','$email','$password_hash','$savesecret')";
    $insert = $conn->query($queryinsert);
   if ($insert === TRUE){
   	$_SESSION['id']= $conn->insert_id;
   	header('location:verify.php');
    }  
  }
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>2fa - Register</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset>
						<?php if(isset($response)){
							 echo "<div class='alert alert-danger'>
								      <strong>".$response."</strong>
								    </div>";
							}?>
						<div class="form-group">
								<input class="form-control" placeholder="First Name" name="firstname" type="text" autofocus="" required=>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Last Name" name="lastname" type="text" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="password" name="password" id="password" type="password" required>
							</div>
							<div class="control-group">
				              	<input type="checkbox" onclick="myFunction()">&nbsp;&nbsp;&nbsp;&nbsp;Show Password
				              </div>
				              <br>
							<button type="submit" class="btn btn-primary" name= "register" style="width:100%;">Register</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
<script type="text/javascript">
	function myFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>
