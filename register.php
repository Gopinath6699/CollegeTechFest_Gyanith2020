<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

	


	<?php  
	session_start();
	if(!isset($_SESSION['gyid']))
		header('location:login.php');
	if(!isset($_GET['id']) && !isset($_GET['ptps']))
		die('Invalid event details !');

    echo "registration unavailable";

	if(isset($_GET['cnf']))
		echo '<span style="color:red">User already registered</span>';

	try{
		include 'connect.php';
		if($_GET['type']=='w')
		$q=$con->prepare("select * from events where wid=:id");
		else if($_GET['type']=='e')
			$q=$con->prepare("select * from events where eid=:id");
		else
			$q=$con->prepare("select * from events where id=:id");
		$q->bindParam(":id",$_GET['id']);
		$q->execute();
		$res=$q->fetchAll(PDO::FETCH_ASSOC);
		

	if(count($res)!=1)
		die('invalid event id !');

	$_GET['id'] = $res[0]['id'];
	$en=$res[0]['name'];
	$ec=$res[0]['cost'];
	

	$u=$con->prepare("select usr,gyid from users where gyid<>'{$_SESSION['gyid']}'");
	$u->execute();
	$ub=$u->fetchAll(PDO::FETCH_ASSOC);
	if(!isset($_GET['ptps']))
		$_GET['ptps']=1;
	echo "<script>  var gyids=".json_encode(array_values($ub))."; var ptps=".$_GET['ptps']."</script>";

	$a=explode(",",$ec);

		foreach ($a as $key => $value) {
			
			if($value==$_GET['ptps']){
				$c=$a[$key+1];
				break;
			}
		}
		if(!isset($c))
		{
			$c = 1;
			//die('invalid ptps');
		}

	}catch(Exception $e){
		die('cannot access db');
	}


	?>



	<script type="text/javascript">
		
		var count=1
		var filled=[]		


		function remove(g) {
				let o=filled.find(f=>f.gyid===g)
				filled.splice(filled.indexOf(o),1)
				count-=1

				console.log(g);
				console.log(filled);
				disp()
				check()
			}

		function disp(){
				$('#lst').html('')
				for (var i =1; i<filled.length; i++) {
					gyd=filled[i].gyid
					u=filled[i].usr 

					ads="<li>"+u+" ("+gyd+")<span class=bt onclick=remove("+"'"+gyd+"'"+")>Remove</span></li>"

					$('#lst').html($('#lst').html()+ads)
				}


				
			}

			function check(){
			if(count<ptps){
				$('#addv').css('display','block')
				$('#cnf').prop('disabled',true)
			}else{
				$('#addv').css('display','none')
				$('#cnf').prop('disabled',false)
			}
		}

		$(document).ready(()=>{

			count=1
			filled=[{usr:'You', gyid:'<?php echo $_SESSION['gyid'];?>'}]

			check()

			$('#add').click(()=>{
				var u=$('#inp').val()
				let o=gyids.find(x=>x.usr===u)
				if(gyids.indexOf(o)>=0){

					if(filled.indexOf(o)==-1){

						console.log('came here');
						
						filled.push(o)
						disp()
						count+=1

						check()
						$('#err').html('')
				}else{
					$('#err').html('User already added')
				}

				}else{
						$('#err').html('User does not exist')
				}
			});

			
			$('#cnf').click(()=>{

			$('#data').val(JSON.stringify(filled))
			$('#id').val(<?php echo $_GET['id']; ?>)
			$('#ename').val('<?php echo $en; ?>')
			


		});
		
		

		});

	</script>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
<style type="text/css">
@import url('https://fonts.googleapis.com/css?family=Montserrat:700');



.cube {
  position: absolute;
  top: 80vh;
  left: 45vw;
  width: 10px;
  height: 10px;
  border: solid 1px #1e1f22;
  -webkit-transform-origin: top left;
          transform-origin: top left;
  -webkit-transform: scale(0) rotate(0deg) translate(-50%, -50%);
          transform: scale(0) rotate(0deg) translate(-50%, -50%);
  -webkit-animation: cube 12s ease-in forwards infinite;
          animation: cube 12s ease-in forwards infinite;
}
.cube:nth-child(2n) {
  border-color:#24262a;
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
	
	background-color: black;
}


.main-div{
	
	width: 100vw;
	height:100vh;

	display: flex;
	align-items: center;
	justify-content: space-around;
	
}

.inner{

	min-width: 320px;
	min-height: 400px;	
	width: 50vw;
	height: 50vh;
	z-index: 100;
	background-color: white;
	display: inline-flex;
	flex-direction: column;
	align-items: stretch;

}

.inner h1{
	color: white;
	background-color: #0040C1;
	margin:0px 0px 0px 0px;
	padding: 10vh 10px 10px 10px;
	font-family: 'Montserrat',sans-serif;
}


.mem{
	font-family: 'PT Sans',cursive;
	font-size: 1.2em;
	display: flex;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	width: 100%;
	height:100%;
}

.mem li{

	padding: 2px 2px 2px 0px;
	

}

#cnf{
	float: right;
	font-family: 'Montserrat',sans-serif;
	font-size: 1.2em;
	border: none;
	margin:10px 10px 10px 10px;
	display: inline-block;
	outline: none;
	padding: 10px 10px 10px 10px;
	border-radius: 5px;
	background: blue;
	color: white;
}

#cnf:hover{
	font-family: 'Montserrat',sans-serif;
	font-size: 1.2em;
	border: none;
	margin:10px 10px 10px 10px;
	display: inline-block;
	outline: none;
	padding: 10px 10px 10px 10px;
	border-radius: 5px;
	background: #0040C1;
	color: white;
	cursor: pointer;
}

#cnf:disabled{
	cursor: not-allowed;
}

#addv{
	margin:10px 10px 10px 10px;
}

.bt{
	min-width: 40px;
	font-size: 12pt;
	margin-left: 10px;
	font-family: 'PT Sans',sans-serif;
	display: inline-block;
	padding: 1px 7px 1px 7px;
	height: 20px;
	border-radius: 11px;
	border: 2px solid #0040C1;
	background-color: none;
	color: #0040C1;
}

.bt:hover{
	min-width: 40px;
	font-size: 12pt;
	margin-left: 10px;
	font-family: 'PT Sans',sans-serif;
	display: inline-block;
	height: 20px;
	border-radius: 11px;
	padding: 1px 7px 1px 7px;
	background-color: #0040C1;
	color: white;
	cursor:pointer;
}

#addv input{
	font-family: 'PT Sans',sans-serif;
	font-size: 1.1em;
	outline: none;
	border: none;
	background-color: transparent;
}

</style>
</head>
<body>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>
	<div class="cube"></div>

	<div class="main-div">


	<div class="inner">

	<h1 >
		<?php 
		echo $en;
		
		
		?>
	</h1>

	<center style="background-color: #ececec;"><span id='addv'>
		<input type="text" list='gyids' id='inp' placeholder="Enter Username">

		<span  id="add" class="bt">Add</span>
	</span></center>

	<div class="mem">

	<div>		
	<h4>Members</h4>
	<ol>
	<li>
		<?php 
	$cu=$con->prepare("select usr,gyid from users where gyid ='{$_SESSION['gyid']}'");
	$cu->execute();
	$cud=$cu->fetchAll();
	
	echo "{$cud[0]['usr']} ({$cud[0]['gyid']})";
	

		?>
	</li>
	<span id='lst'></span>
	</ol>
		<datalist id='gyids'>
			<?php

			foreach ($ub as $u) {
				echo "<option value={$u['usr']} >";
			}
			

			?>

		</datalist>
		
		<br>
		
		
		
		<div id='err' style="color:red"></div>
	</div>


	</div>

	<form id='regf' action="reg_cnf.php" method="POST">
		<input type="hidden" name="data" id='data'>
		<input type="hidden" name="id" id='id'>

		<input type="hidden" name="price" id='price'>
		<input type="hidden" name="ename" id='ename'>

		<button disabled id='cnf'>Register</button>
		</form>

	</div>
</div>

</body>
</html>