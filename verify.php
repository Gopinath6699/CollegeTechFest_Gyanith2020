<!DOCTYPE html>
<html>
<head>
	<title>Verify your account</title>
	
	<?php
	session_start();
	if(isset($_SESSION['gyid']))
		header('location:profile.php');
	// if(!isset($_SESSION['gyidnv']))
	// 	header('location:login.php');
	include 'connect.php';

	if(isset($_GET['code']) && isset($_GET['gyid'])){
		try{
			
			$q=$con->prepare("select token from users where gyid=:gyid");
			$q->bindParam(":gyid",$_GET['gyid']);
			$q->execute();
			$r=$q->fetchAll();
			if(count($r)!=1)
				die('invalid gyid !');
			if($_GET['code']==$r[0]['token']){
				$q=$con->prepare("update users set verified=1 where token=:token");
				$q->bindParam(":token",$_GET['code']);
				$r=$q->execute();
				if($r==1){
					unset($_SESSION['gyidnv']);
					$_SESSION['gyid']=$_GET['gyid'];

					

					$succ="<h4>Your account has been verified successfully<h4><br><a href=
					profile.php>Go to profile</a>";
					include 'vsucc.php';
					die();
				}
				else{
					die("Verification failed. Retry");
				}
			}
			else{
				die('invalid credentials');
			}

			
		}catch (Exception $e){
			echo "not connected to db";
		}
	}

	if(isset($_POST['logout'])){

				unset($_POST);
				unset($_SESSION['gyidnv']);
				session_destroy();
				header('location:login.php');
			}


	if(isset($_POST['resend'])){
		try{

			if(!isset($_SESSION['gyidnv']))
				header('location:login.php');
				
				$q=$con->query("select email,gyid,name,token from users where gyid='{$_SESSION['gyidnv']}'");
				$r=$q->fetchAll();



				$code=$r[0]['token'];
				$pname=$r[0]['name'];
				$gid=$r[0]['gyid'];
				
				$h= "Content-type:text/html;charset=UTF-8";
				$mail="<h2>Welcome $pname </h2>Thanks for signing up for Gyanith 20. <a href='https://gyanith.org/verify.php?code=$code&gyid=$gid'>Click here</a> to complete registration.<br/><h4>Download the Gyanith 20 app from playstore to unlock exciting features</h4>";
				mail($r[0]['email'],"Gyanith 20 Onboard",$mail,$h);
				echo "<script>alert('Activation link has been sent to your mail')</script>";
			}catch(Exception $e){
				echo "Error resending activation link !";
			}
	}


	try{

			if(!isset($_SESSION['gyidnv']))
				header('location:login.php');
			

			$q="select verified from users where gyid=:gyid";
			$qu=$con->prepare($q);
			
			$qu->bindParam(":gyid",$_SESSION['gyidnv']);
			$qu->execute();
			$res=$qu->fetchAll(PDO::FETCH_ASSOC);
			if(count($res)==1 ){
				//print_r($res[0]['verified']);

				if($res[0]['verified']==1){
				
				$_SESSION['gyid']=$res[0]['gyid'];
				unset($_SESSION['gyidnv']);
				header('location:profile.php');
			}}

		}catch(Exception $e){
				die("unknown error !");
		}



	 ?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style type="text/css">
	@import url("https://fonts.googleapis.com/css?family=Montserrat:700");
	body{
		padding-left: 10%;
		padding-right: 10%;
		height: 100vh;
		display: flex;
		justify-content: center;
		align-items:center;
		background-color: #0040C1;
		font-family: 'Montserrat',sans-serif;
		color: white;
	}
	.cube {
  position: absolute;
  top: 80vh;
  left: 45vw;
  width: 10px;
  height: 10px;
  border: solid 1px #003298;
  -webkit-transform-origin: top left;
          transform-origin: top left;
  -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
          transform: scale(0) rotate(0deg) translate(-50%, -50%);
  -webkit-animation: cube 12s ease-in forwards infinite;
          animation: cube 12s ease-in forwards infinite;
}
.cube:nth-child(2n) {
  border-color: #0051f4;
}
.cube:nth-child(2) {
  -webkit-animation-delay: 2s;
          animation-delay: 2s;
  left: 25vw;
  top: 40vh;
}
.cube:nth-child(3) {
  -webkit-animation-delay: 4s;
          animation-delay: 4s;
  left: 75vw;
  top: 50vh;
}
.cube:nth-child(4) {
  -webkit-animation-delay: 6s;
          animation-delay: 6s;
  left: 90vw;
  top: 10vh;
}
.cube:nth-child(5) {
  -webkit-animation-delay: 8s;
          animation-delay: 8s;
  left: 10vw;
  top: 85vh;
}
.cube:nth-child(6) {
  -webkit-animation-delay: 10s;
          animation-delay: 10s;
  left: 50vw;
  top: 10vh;
}

@-webkit-keyframes cube {
  from {
    -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
    opacity: 1;
  }
  to {
    -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
    opacity: 0;
  }
}

@keyframes cube {
  from {
    -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
            transform: scale(0) rotate(0deg) translate(-50%, -50%);
    opacity: 1;
  }
  to {
    -webkit-transform: scale(20) rotate(960deg) translate(-50%, -50%);
            transform: scale(20) rotate(960deg) translate(-50%, -50%);
    opacity: 0;
  }
}

.bt{
	outline: none;
	display: inline-block;
	padding: 10px 10px 10px 10px;
	border-radius: 5px;
	border: 2px solid white;
	background-color: transparent;
	color: white;
}

.bt:hover{
	outline: none;
	display: inline-block;
	padding: 10px 10px 10px 10px;
	background-color: white;
	color: #0040C1;
}

</style>

	








</head>
<body>

	<div >
	<h2>Verify your account to continue</h2>
	<p>An email containing activation link has been sent to your email</p>
	<br>

	<form action="" method="post">
		<input type="submit" name="resend" value="Resend activation link"class="bt">
	</form>
	<br>
	


	
	</div>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>



	
	

</body>
</html>