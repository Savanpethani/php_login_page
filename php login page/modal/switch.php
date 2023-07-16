<?php
require_once "../class/register.php";

$db_handle = new dataconnection();
if(isset($_REQUEST["action"])){

	$action=$_REQUEST["action"];
}else{
	$action= '';
}

	
	
	switch ($action) {
		case 'register':
			
			if (isset($_POST['register-submit'])) {
				$uname = $_POST['username'];
				$c_psd = $_POST['confirm-password'];
				
				$email = $_POST['email'];	
						
				$psd =md5( $_POST['password']);
				if($email=='' || $psd == '' || $uname == '' ){
					header("Location: ../view/register.php?msg= please fill all details");die;
				}
				if($_POST['password'] != $c_psd){
					header("Location: ../view/register.php?msg= match the passwords");die;
				}

				$reg = new register();
			$tempname = $_FILES["uploaded"]["tmp_name"]; 
			
			$filename = pathinfo($_FILES['uploaded']['name'], PATHINFO_FILENAME);
			$extend = pathinfo($_FILES['uploaded']['name'], PATHINFO_EXTENSION);
			$imgname=$filename."_". rand(11111,99999).".".$extend;
			
			$target_path = "../profile_image/";  
			$target_path = $target_path.basename( $imgname);   
			
			if (move_uploaded_file($tempname, $target_path)) {

				echo "Image uploaded successfully";
				
				
				$check=$reg->check($email);
				if ($email==$check) {

					header("location: ../view/register.php?msg= user aleardy exists");die;
					
				}
							
				else{
				$insertId = $reg->adduser($uname, $email, $psd,$imgname);
				}

	
			} else{  
				echo "Sorry, file not uploaded, please try again!";  die;
			} 
				
				
				if (empty($insertId)) {
					$response = array(
						"message" => "Problem in Adding New Record"
						
					);
				} else {
					$response = array(
						"message" => "updated"
					);
					$_SESSION['login']=$uname;
					header ("Location: ../view/dashboard.php");
					
					
			}
			 
			
			header("Location: ../index.php");
			}

			break;
			
		
		case 'login':

			if (isset($_POST['login-submit'])) {
				
				$uname = $_POST['username'];									
				$psd = $_POST['password'];
				$reg = new register();
				
				if($uname == "" || $psd == ""){
					header("Location: ../index.php?msg=Please Enter Your username and password!"); die;
				}

				$result =$reg->getuser($uname, $psd);
				
				if ($result=="No") {
					$response = array(
						"message" => "invalid"
						
					);
					
					$_SESSION['login']='';
					
					header("Location: ../index.php?msg=Invalid Username and Password!");
									
				} else {
					
					$response = array(
						"message" => "hello"
					);

					if(isset($_POST['remember'])){
						// echo "remember me checked"; die;
						setcookie("username", $uname, time() + (86400 * 30) ,'/'); 
						setcookie("dbpsd", $psd, time() + (86400 * 30), '/');
						// echo $_COOKIE['uname']." / ".$_COOKIE['psd']; die;
					}
					else{
						
						unset($_COOKIE['username']);
						setcookie('username', '', time() - 3600, '/'); 
						unset($_COOKIE['dbpsd']);
						setcookie('dbpsd', '', time() - 3600, '/');
					}
					
					
					$_SESSION['login']=$uname;
					require_once('../view/dashboard.php');
					

				}
				
				break;
			}

			case 'logout':

				unset($_SESSION['login']);
				// echo $_COOKIE['uname']." / ".$_COOKIE['psd']; die;
				header("Location: ../index.php"); 
				break;

			case 'changepass':

				$dbpsd = md5($_POST["cpsd"]);
				
				$reg = new register();
				$status = $reg->uppassword($_SESSION['login'],$dbpsd);
				
				if( $status == "updated"){
					unset($_SESSION['login']);
					unset($_SESSION['response']);
					header("Location: ../index.php");
					

					
					alert('updated');
					
				}
				else{
					echo "error";
				}
				break;

			case 'change_profile':

				
								
				
				
				$reg = new register();
				$email = $reg->getmail($_SESSION['login']);
				$tempname = $_FILES["uploaded"]["tmp_name"]; 
			
			$filename = pathinfo($_FILES['uploaded']['name'], PATHINFO_FILENAME);
			$extend = pathinfo($_FILES['uploaded']['name'], PATHINFO_EXTENSION);
			$imgname2=$filename."_". rand(11111,99999).".".$extend;
			
			$target_path = "../profile_image/";  
			$target_path = $target_path.basename( $imgname2);  

			if (move_uploaded_file($tempname, $target_path)) {

				$p_img = $reg->getimgname($email);
				
				$upload = $reg->updateprofile($email,$imgname2);
				
				if($upload=='updated'){
					echo "Image uploaded successfully";
					   
					    
					  
					if(unlink("../profile_image/".$p_img)){
						
						header("Location: ../index.php?msg=profile updated");
					}
						
					

				}

			}
			break;

		
		default:
			# code...
			break;
	}
	?>