<?php 

	include 'connect.php';
		
	try
	{
		
	}
	catch(Exception $e)
	{
		die("not connected to db");
	}
	header('Content-type:application/json');
	$v=array('error'=>'invalid request');
	
	$con->query("SET CHARACTER SET utf8;");
	if(isset($_GET['action']) && isset($_GET['key']) && $_GET['key']=='2ppagy0'){
		if($_GET['action']=='fetch' && isset($_GET['type'])){
			
			$qu="select * from events where type=:typ order by name";
			$res=$con->prepare($qu);
			$res->bindParam(':typ',$_GET['type']);
			$res->execute();	
			$v=$res->fetchAll(PDO::FETCH_ASSOC);
			
			//print_r($v);		
		}
		elseif ($_GET['action']=='fetchAll') {

		$qu="select id,name,concat(des,'<br><b>',dtv,'</b><br><br><br>') as 'des', rules,contact,img1,img2,cost,max_ptps,type,timestamp from events order by name";
		$res=$con->prepare($qu);
		$res->execute();	
		$v=$res->fetchAll(PDO::FETCH_ASSOC);
		
		}
		elseif ($_GET['action']=='check' && isset($_GET['gyid']) && isset($_GET['eid']) && isset($_GET['key'])) {
			
			$qu="select count(gyid) from transactions where gyid=:gyid and eid=:eid";

			$valp=$con->prepare($qu);
			$valp->bindParam(':eid',$_GET['eid']);
			$valp->bindParam(':gyid',$_GET['gyid']);
			$valp->execute();
			$valres=$valp->fetch(PDO::FETCH_NUM);
			if($valres[0]==1){
				$v=array('eligibility'=>'Eligible');
			}
			else{
				$v=array('eligibility'=>'Not - Eligible');
			}
		}
		elseif ($_GET['action']=='login' ){
			if( isset($_GET['uname']) && isset($_GET['pwd'])){
				$qu="select * from users where usr=:uname and pwd=:pwd";
				$valp=$con->prepare($qu);
				$valp->bindParam(':uname',$_GET['uname']);
				$valp->bindParam(':pwd',$_GET['pwd']);
				$valp->execute();
				$valres=$valp->fetch(PDO::FETCH_ASSOC);
				if(isset($valres['usr'])){             
					if($valres['verified']==1){
						$token=bin2hex(random_bytes(4));
						$v=array('token'=>$token);
						$qu="update users set token=:token where usr=:usr";
						$tp=$con->prepare($qu);
						$tp->bindParam(':token',$token);
						$tp->bindParam(':usr',$valres['usr']);
						$tp->execute();
					}
					else{
						$v=array("error"=>"not verified");
					}
				}
				else{
					$v=array('error'=>'invalid credentials');
				}
			}
			elseif(isset($_GET['token'])){
				$qu="select gyid,usr,name,clg,email,phno,gender from users where token=:token";
				$tp=$con->prepare($qu);
				$tp->bindParam(':token',$_GET['token']);
				$tp->execute();
				$tr=$tp->fetch(PDO::FETCH_ASSOC);
				
			
				$gd=$tr['gyid'];
				
				$qu="select eid from transactions where gyid='$gd'";
			
				$rp=$con->prepare($qu);
				$rp->execute();
				$re=$rp->fetchAll(PDO::FETCH_ASSOC);
			
				$v=array('user'=>$tr['usr']);
				$v=$tr;
				$v['reg']=array_column($re,'eid');
					
				
			}
		}
		elseif($_GET['action']=='signup'){
			$qc="select count(*) from users where usr=:usr or email=:email";
			$q=$con->prepare($qc);
			$q->bindParam(':usr',$_POST['usr']);
			$q->bindParam(':email',$_POST['email']);
			$q->execute();
			$temp=$q->fetch(PDO::FETCH_NUM);
			if($temp[0]==0){
				
				try{
				$token=bin2hex(random_bytes(4));

				$qu=$con->query("select gyid from users order by sno desc limit 1");
				$c=(int)substr($qu->fetchAll()[0]['gyid'],2)+1;
				//echo $c;
				//$gid="GY00$c";
				$gid = "GY".str_pad((string)$c,4,"0",STR_PAD_LEFT);
				$pwd=sha1($_POST['pswd1']);
				$usr=$_POST['usr'];
			
				$email=$_POST['email'];
				$clg=$_POST['clg'];
				$phone=$_POST['phone'];
				$gdr=$_POST['gdr'];
			    $pname=$_POST['pname'];

				$qi="insert into users(gyid,name,usr,pwd,email,clg,phno,gender,verified,token) values('$gid','$pname','$usr','$pwd','$email','$clg','$phone','$gdr',0,'$token')";
			
				$qe=$con->query($qi);

				$mail="<html><h2>Welcome {$_POST['pname']}</h2>Thanks for signing up for Gyanith 20.\n<a href='https://gyanith.org/verify.php?code=$token&gyid=$gid'>Click here</a> to complete registration.</html>";
			
				$h="Content-Type: text/html; charset=UTF-8\r\n";
			
				mail($_POST['email'],"Gyanith 20 Onboard",$mail,$h);
                if($qe)
				    $v=array('result'=>'success','text'=>'verification required');
				}catch(Exception $e){
					//echo $e->getMessage();
					$v=array('result'=>'failed','text'=>'Error adding user !');
				}
			}
			else{
				$v=array('result'=>'failed','text'=>'email or user-name already exists');
			}
		}
	}
	echo json_encode($v);
?>