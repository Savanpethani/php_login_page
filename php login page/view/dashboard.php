<?php require_once ("../controller/dataconnection.php");
require_once "../class/register.php";
require_once "../modal/switch.php";?>


<?php

if($_SESSION['login'] != '')
{
$login='yes';
echo $login;
echo "welcome to dashboard ".$_SESSION['login'];
}
else{
     header("Location: ../index.php"); 
}

?>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<style>
  body {
    padding-top: 90px;
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

</style>

<script>
	$(function() {

$('#login-form-link').click(function(e) {
	$("#login-form").delay(100).fadeIn(100);
	 $("#register-form").fadeOut(100);
	$('#register-form-link').removeClass('active');
	$(this).addClass('active');
	e.preventDefault();
});
$('#register-form-link').click(function(e) {
	$("#register-form").delay(100).fadeIn(100);
	 $("#login-form").fadeOut(100);
	$('#login-form-link').removeClass('active');
	$(this).addClass('active');
	e.preventDefault();
});

});

</script>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
        welcome to dashboard
		</div>
	</div>
	<div>
		<form action="../modal/switch.php?action=changepass" method="post">
			username = <?php echo $_SESSION['login'];  ?> <br>
			email = <?php 
			$reg = new register();
			$email = $reg->getmail($_SESSION['login']);
			echo $email;
			
			$loc = $reg->getimg($email);
			
			?>
			<br>
			<img src="../profile_image/<?php echo $loc; ?>" width=100px>
			<br>

			<div><img src="profile_image/'.$loc.'" alt=""></div>
			<input type="text" placeholder="change password"  name="cpsd" id="cpsd">
			<input type="submit" value="change password">
 		</form>
	</div>
	
	<div>
	<form action="../modal/switch.php?action=change_profile" method="post" enctype="multipart/form-data">
	<?php 
			$reg = new register();
			$email = $reg->getmail($_SESSION['login']);

			?>
			<input type="file"  id="file" tabindex="2" class="form-control" name="uploaded" id="uploaded">
			<input type="submit" name="change_profile" id="change_profile" value="change_profile">

</form>
		
		

	
	</div>
			
	<div>
		
	<a href="../modal/switch.php?action=logout">log out</a>

	</div>
	
		
	

	<script>
		alert('<?php echo $response['message']; ?>');
	</script>