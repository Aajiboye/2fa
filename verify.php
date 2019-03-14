<?php
session_start();
require 'inc/connect.php';
include "vendor/autoload.php";
if (isset($_SESSION['secret']))
{
	$secret=unserialize(base64_decode($_SESSION['secret']));
	$qrImageGenerator = new \Dolondro\GoogleAuthenticator\QrImageGenerator\GoogleQrImageGenerator();
	$img =$qrImageGenerator->generateUri($secret);
}
if(isset($_POST['verify'])){
	$code=$_POST['code'];
	$secret=unserialize(base64_decode($_SESSION['secret']));
	$secretKey = $secret->getSecretKey();
	$googleAuthenticator = new \Dolondro\GoogleAuthenticator\GoogleAuthenticator();
	//$googleAuth->authenticate($secretKey, $code);
	
	    if ($googleAuthenticator->authenticate($secretKey, $code)) {
	    	unset($_SESSION['secret']);
	        header('location:profile.php');
	    } else {
	        $response = "This code was invalid";

	    }
}	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>2fa - Verify </title>
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
				<div class="panel-heading"><center>Scan Barcode</center></div>
				<p><center>Hello <?php if (isset($_SESSION['firstname'])){echo $_SESSION['firstname'];} ?>, Kindly visit play store to download Google Authenticator Application in order to register your device by scanning this QR Code</center></p>
				<div class="panel-body">
					<form role="form" method="POST" action="verify.php">
						<fieldset>
							<?php 
							if(isset($img)){						
								echo '<center><img src="'.$img.'"></center><br><br>
								<div class="form-group">
								<input class="form-control" placeholder="6 digit code" name="code" type="text" autofocus="" required>
							</div><br>
								';
								}
								if(isset($response)){
									echo '<div class="alert alert-danger">
								      <strong>'.$response.'</strong>
								    </div>';
								}
							

				          	?>
				         <button type="submit" class="btn btn-primary" name= "verify" style="width:100%;">Verify</button>
					</fieldset>	
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>
