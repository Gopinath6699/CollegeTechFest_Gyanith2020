
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Result</title>


	<?php
	session_start();
 
	if(!(isset($_POST['id']) && isset($_POST['data']) && isset($_SESSION['gyid']) && isset($_POST['ename']) && isset($_POST['price'])))
		die('invalid details');

try{
	include 'connect.php';
	$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
	$tid=bin2hex(random_bytes(6));
	$eid=$_POST['id'];
	$res='Registration completed successfully';

		$a=json_decode($_POST['data'],true);
		foreach ($a as $v) {
			$gid=$v['gyid'];

			$s="select * from transactions where (gyid='{$gid}' and eid=$eid)";
			$q=$con->prepare($s);
			$q->execute();
			$r=$q->fetchAll(PDO::FETCH_ASSOC);
			if(count($r)==0){

			// $s="insert into transactions(t_id,gyid,eid) values('{$tid}','{$gid}',$eid)";
			
			// $su=$con->query($s);
			// if(!$su){
			// 	echo $su;
			// 	$res='failed';
			// 	break;}

		}else{
			
			$res='user(s) already registered';
			break;
		}
		}

	if($res!='user(s) already registered'){
		foreach ($a as $v) {
			$gid=$v['gyid'];
			

			$s="insert into transactions(t_id,gyid,eid) values('{$tid}','{$gid}',$eid)";
			
			$su=$con->query($s);
			if(!$su){
				echo $su;
				$res='failed';
				break;}

		
		}
	}



		



		
}catch(Exception $e){
	die("cannot access db");
}



?>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<style type="text/css">
@import url("https://fonts.googleapis.com/css?family=Montserrat:700");


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






body{
	padding:10px 10px 10px 10px;
	color: white;
	background-color: #0040C1;
	font-family: 'Montserrat',sans-serif;
	height: 100vh;
	width: 100vw;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
}


.bt{
	display: inline-block;
	padding: 10px 10px 10px 10px;
	border-radius: 5px;
	border: 2px solid white;
	background-color: none;
	color: white;
	margin-top: 10px;
	margin-bottom:10px;
}

.bt:hover{
	display: inline-block;
	padding: 10px 10px 10px 10px;
	background-color: white;
	color: #0040C1;
	margin-top: 10px;
	cursor: pointer;
}

.inner{
	z-index: 100;
	height: 50vh;
	min-height: 320px;
	background-color: white;
	display: inline-flex;
	flex-direction: column;
	color: #0040C1;
}

.inner span{
	color: black;
}

.inner h3{
	margin: 0px;
	padding: 3vh 15px 3vh 15px;
	background-color: #ececec;
}


.mem{
	padding: 15px;
	font-size: 1.2em;
	font-family: 'PT Sans',cursive;
	color:#888888;

}

.info{
	margin: 10px;
	font-family: 'PT Sans',cursive;
	color: white;
	font-size: 12pt;
}

</style>


</head>
<body>
<div class="cube"></div>
<div class="cube"></div>
<div class="cube"></div>
<div class="cube"></div>
<div class="cube"></div>




<?php  

echo "<h1>$res</h1><br>";
if($res=='Registration completed successfully'){
echo "<div class='inner'>";
echo "<h3>Event/Workshop name: <span>{$_POST['ename']}</span><br>";
echo "Registration Id: <span>$tid</span></h3>";
echo "<div class='mem'>";
echo "<h4>Member list<h4>";
echo "<ol>";

	foreach ($a as $v) {
		echo "<li>{$v['usr']} ({$v['gyid']})</li>";
	}
	echo "</ol>";

	
}

?>
</div>

</div>
<?php
if($eid!=15 && $eid!=14 && $eid!=13 &&  $eid!=11 && $eid!=12){
?>
<div class="info">
	*Please note that this registration is valid<br> only if you have successfully completed registration<br> on college fever website
</div>
<?php
}
if($eid!=15 && $eid!=14 && $eid!=13 &&  $eid!=11 && $eid!=12)
{?>
<span onclick="location.href='instructions.php'" class="bt">Make Payment</span>
<?php 
}
else if($eid!=11 && $eid!=12){
	?>
	
<span onclick="location.href='https://imojo.in/NITPY'" class="bt">Make Payment</span>
<?php 
}
else
{   
    if($eid==11)
    {
	?>
	<span onclick="location.href='https://www.payumoney.com/paybypayumoney/#/8FD8EB8BA611C9F68D59D2B04359E19F'" class="bt">Make Payment</span>
	
	<?php } if($eid==12){
	 ?>
    <span onclick="location.href='https://www.payumoney.com/paybypayumoney/#/5B68B1AEBF4BF1A63FD0F38CD4B8E05B'" class="bt">Make Payment</span>
    
    <?php } } ?>
</body>
</html>