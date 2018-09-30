<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link href="css/core.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div class="login_box_wraper clearfix">
		<div class="login_box_wrap">
			<form class="form-horizontal" id="loginFrm" name="loginFrm" action="logon.php">
				<div class="control-group">
					<!-- 			<label class="control-label" for="loginName">Display Name</label> -->

					<input type="text" id="loginName" name="loginName" placeholder="User Name">

				</div>
				<div class="control-group">
					<!-- 			<label class="control-label" for="loginPassword">Display Name</label> -->

					<input type="text" id="loginPassword" name="loginPassword" placeholder="Pasword">
				</div>
				<div class="control-group">
					<button type="submit" class="btn">Login</button>
				</div>
			</form>	
		</div>
	</div>
</body>
</html>