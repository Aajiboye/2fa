<?php
session_start();
require 'inc/connect.php';
if(isset($_SESSION['id'])){
$query = "select * from tbl_users where fld_userid = ".$_SESSION['id'];
$profile = $conn->query($query);
while($set=$profile->fetch_assoc()){
	$fullname = $set['fld_firstname']." ".$set['fld_lastname'];
	$email = $set['fld_email'];

}
}
if(isset($_POST['logout'])){
	unset($_SESSION);
	session_destroy();
	header('location:index.php');
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
				<div class="panel-heading">Authentication Successful</div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset>
							<p>Name: <?php echo $fullname?></p>
							<p>Email: <?php echo $email?></p>
							<button type="submit" class="btn btn-primary" name="logout" style="width:100%;">Log Out</button>
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