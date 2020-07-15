<!DOCTYPE html>
<html>

<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login to Gyanith20</title>

	<?php
    session_start();
        if (isset($_SESSION['gyid'])) {
            header('location:profile.php');
        }
        if (isset($_SESSION['gyidnv'])) {
            header('location:verify.php');
        }

        $i='';
        if (isset($_POST['btn'])) {
            unset($_POST['btn']);

            $usr="gyanimzj";
            $pwd="Nitgyan90!!";

            try {
                $con=new PDO("mysql:host=www.gyanith.org;port=3306;dbname=gyanimzj_gy20", "gyanimzj_user", "Gyanith@20");

                $q="select * from users where usr=:usr and pwd=:pwd;";
                $qu=$con->prepare($q);
                $usrname=$_POST['usr'];
                $passwd=sha1($_POST['pwd']);
                $qu->bindParam(":usr", $usrname);
                $qu->bindParam(":pwd", $passwd);
                $qu->execute();
                $res=$qu->fetchAll(PDO::FETCH_ASSOC);
                if (count($res)==1) {
                    //print_r($res[0]['verified']);

                    if ($res[0]['verified']==1) {
                        $_SESSION['gyid']=$res[0]['gyid'];
                        echo "veri";
                        header('location:profile.php');
                    } else {
                        $_SESSION['gyidnv']=$res[0]['gyid'];
                        echo "nveri";
                        header('location:verify.php');
                    }
                } else {
                    unset($_POST['btn']);

                
                    $i='Invalid credentials';
                }
                //echo sha1($_POST['pwd']);
            } catch (Exception $e) {
                echo $e;
            }
        }
     ?>
</head>

<body>
	<div class="page">
		<div class="container">
			<div class="left">
				<div class="login">Login</div>
				<div class="eula">Don't have an account? <a href="signup.php">Sign Up</a></div>
			</div>
			<div class="right">
				<svg viewBox="0 0 320 300">
					<defs>
						<linearGradient inkscape:collect="always" id="linearGradient" x1="13" y1="193.49992" x2="307"
							y2="193.49992" gradientUnits="userSpaceOnUse">
							<stop style="stop-color:#ff00ff;" offset="0" id="stop876" />
							<stop style="stop-color:#ff0000;" offset="1" id="stop878" />
						</linearGradient>
					</defs>
					<path
						d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143" />
				</svg>
				<form method="post" action="login.php" autocomplete="off" class="form">
					<label for="username">Username </label>
					<input class="inp" type="text" name="usr" id="username" required>
					<label for="password">Password</label>
					<input id="password" clas="inp" type="password" name="pwd" required>
					<input type="submit" name="btn" id="submit" value="Login">
				</form>
				<div id='inv' style="color:red"><?php echo $i ?>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/login.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.js"></script>
</body>

</html>