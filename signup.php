<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/signup.css" />
	<link rel="shortcut icon" href="images/img_0.png">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<title>Gyanith '20 - Sign Up</title>

	
	<style>
		@keyframes fadeIn {
			from {
				opacity: 0;
			}
			to {
				opacity: 1;
			}
			}
		#back_button{
			position: absolute;
			top:5.5%;
			left: 5%;
			color: white;
			font-size: 35px;
			z-index: 1;
			}
	</style>
    <script type="text/javascript">
        
        function check(){
            console.log('called');
            if($('#p2').val()!="")
            {
            if($('#p1').val()==$('#p2').val()){
                //$('#reg').removeAttr('disabled');
                $('#err').html('<p style="color:green">Passwords match</p>')
                
            }else{
                //$('#err').val("passwords don't match");
                console.log('not matching');
                $('#err').html('<p style="color:red">Passwords dont match</p>')
            }
        }
        }
    </script>
    <?php
    session_start();
    $err='';
    if(isset($_SESSION['gyid']))
        header('location:profile.php');
    if(isset($_SESSION['gyidnv']))
            header('location:verify.php');

    if(isset($_POST['reg'])){
        try{
            $con=new PDO("mysql:host=www.gyanith.org;port=3306;dbname=gyanimzj_gy20","gyanimzj_user","Gyanith@20");
            $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $r=$con->prepare("select count(gyid) from users where email=:mail or usr=:usr;");
            $r->bindParam(":mail",$_POST['email']); $r->bindParam(":usr",$_POST['usr']);
            $r->execute();
            $v=$r->fetchAll();
            
            if($v[0][0]==0){


                $qu=$con->query("select gyid from users order by gyid desc limit 1");
                $c=(int)substr($qu->fetchAll()[0]['gyid'],2)+1;
                //echo $c;
                $gid = "GY".str_pad((string)$c,4,"0",STR_PAD_LEFT);
                $pwd=sha1($_POST['pswd1']);

                try{
                    $code=bin2hex(random_bytes(6));
                    //$iq="insert into users values('gy002','s','s',123,'f','n',09,'m',0,NULL)";
                $iq="insert into users(gyid,name,usr,pwd,email,clg,phno,gender,verified,token) values('$gid','{$_POST['pname']}','{$_POST['usr']}','$pwd','{$_POST['email']}','{$_POST['clg']}','{$_POST['phone']}','{$_POST['gdr']}',0,'$code')";
                //echo $iq;
                $r=$con->query($iq);
                $_SESSION['gyidnv']=$gid;
                
                $mail="Welcome {$_POST['pname']}\nThanks for signing up for Gyanith 20.\nUse the link https://gyanith.org/verify.php?code=$code&gyid=$gid to complete registration\n\n\nIt is to inform you that you have to carry a valid identity proof, preferably college id along with a xerox copy of it.\n\n\nThe Schedule of Gyanith is available at http://gyanith.org/sch.pdf";
                mail($_POST['email'],"Gyanith 20 Onboard",$mail);

                header('location:verify.php');
                
                }catch(Exception $e){
                    echo $e->getMessage();
                    $err="Error adding user !";
                }
                
                    
                



            }else{
                $err="User already registered !";
            }



        }catch(Exception $e){
            echo $e;
        }
        

    }

    ?>
</head>
<body>
<a href="index2.html"><i class="fas fa-arrow-left" id="back_button"></i></a>
<div class="area" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
    </div>
<div class = "page">
  <div class="container">
    <div class="left">
      <div class="login">Sign Up</div>
      <div class="eula">Already have an account? <a href="http://localhost/Gyanith2020/login.php">Login</a></div>
    </div>
    <div class="right">
      <form method="post" action="signup.php" autocomplete="off" class ="form">
        
        <div class = "input-box">
			<br>
            
            <input  type="text" name="pname" required>
            <label for="name">Name</label>
        </div>

        <div class = "input-box">
			<br>
            <input  type="text" name="usr" required>
            <label for="username">Username</label>
        </div>

        <div class = "input-box">
			<br>
            <input type="text" name="clg" required>
            <label for="collegename">College name</label>
        </div>

        <div class = "radio">
        	Gender:<input type="radio" class="radio" style="vertical-align: middle; margin: 10px;" name="gdr" value="m" checked>Male
               	   <input type="radio" class="radio" style="vertical-align: middle; margin: 10px;"name="gdr" value="f">Female
		</div>

        <div class = "input-box">
			<br>
            <input  type="email" name="email"  required>
            <label for="email">Email</label>
        </div>

        <div class = "input-box">
			<br>
            <input type="password" name="pswd1" id="p1" required onchange="check()" >
            <label for="email">Password</label>
        </div>

        <div class = "input-box">
			<br>
            <input type="password" name="pswd2" id="p2"  required onkeyup="check()" > 
            <label for="password">Confirm password</label>
        </div>

        <div class = "input-box">
			<br>
            <input  type="text" name="phone"  pattern="^[1-9][0-9]{9}$" required maxlength="10"><br>
            <label for="pno">Phone number</label>
        </div>
          <div class = "input-box" id="err">
           
        </div>

        <br><button type = "submit" name = "reg">Sign up</button>
	 </form>
	 <div id ='inv' style="color:red"><?php echo $err ?></div>
    </div>
  </div>
</div>
<script type="text/javascript" src="js/login.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.js"></script>
<script src="js/jquery-2.1.1.js"></script>
<script>
$(document).ready(function(){
				$('body').css('display', 'none');
				$('body').fadeIn(1000);
	
			});
</script>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>