<!DOCTYPE html>
<?php

if(isset($_GET['id']) && !empty($_GET['id'])){
    $var = $_GET["id"];
    include '../connect2.php';
} else {
    die("the page your looking for doesn't exist");
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gyanith '20 - Events</title>
    <link rel="shortcut icon" href="images/img_0.png">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="learn_more.css">
    <link rel="stylesheet" type="text/css" href="css/coalesce.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <style>
      body {
        margin: 0px 0px;
        font-family: 'Bebas Neue', cursive;
        color: white;
      }
      h1{
        text-align: center;
        top: 5%;
        width: 90%;
        position: absolute;
        left: 0;
        right: 0;
        margin: 0 auto;
      }
      @keyframes fadeIn {
				from {
					opacity: 0;
				}
				to {
					opacity: 1;
				}
        }
        @media screen and (max-width: 700px)
        {
        #particle-canvas
        {
          height: 300%;
        }
        .para
        {
          padding-left: 30px;
        }
        .btn
        {
          position: absolute;
          left: 0;
          right: 0;
          margin:0 auto;
          width: 200px;
        }
        h1
        {
          line-height: 1;
          position: unset;
          padding-top: 20px;
          margin-left: 50px;
          margin-bottom: 50px;
        }
      }
        #back_button {
          position: absolute;
          top: 6%;
          left: 5%;
          color: white;
          font-size: 35px;
        }

        #dtv{
          font-weight: bold;
        }
      </style>
</head>
<body>
<main>
    <div class="frame">
      <div class="content content--canvas">
        <h2 class="content__title"></h2>
      </div>
  </main>
  <h1 id="head"><?php 
      $q = "select * from events where eid='$var'";
      $r = mysqli_query($con,$q);
      $ans = mysqli_fetch_assoc($r);
      
      echo $ans["name"];?></h1>
      <i class="fas fa-arrow-left" id="back_button" onclick="goBack()"></i>
  <div class="tabbed">
    <input type="radio" name="tabs" id="tab-nav-1" checked>
    <label for="tab-nav-1" id="tab1">DESCRIPTION</label>
    <input type="radio" name="tabs" id="tab-nav-2">
    <label for="tab-nav-2">CONTACT US</label>
    <input type="radio" name="tabs" id="tab-nav-3">
    <label for="tab-nav-3">REGISTER</label>
    <input type="radio" name="tabs" id="tab-nav-4">
    <!--label-- for="tab-nav-4">Output</!--label-->
    <div class="tabs">
      <div><h2><center>DESCRIPTION</center></h2><div class="para"><?php 
      $q = "select * from events where eid='$var'";
      $r = mysqli_query($con,$q);
      $ans = mysqli_fetch_assoc($r);


       $qi="select id from events where wid=$var";
      $r=mysqli_query($con,$q);
      $ra=mysqli_fetch_assoc($r);

      echo "<script>var id={$ra['id']};</script>";
      
      echo $ans["des"];
?>
  
  <div id="dtv">
          <?php echo $ans["dtv"]; ?>
        </div>
</div>
      </div>
      <div><h2><center>CONTACT US</center></h2>
        <div class="para"><?php
        if($ans["contact"]!=NULL)
        echo $ans["contact"];
        else
        echo "Coming Soon";?>
        </div></div>
      <div><h2><center>REGISTER</center></h2>
        <div class="para">
      <?php
      if($ans["rules"]!="")	
        echo $ans["rules"]; 	
        ?></div><br><br> 
        <button class="btn" onclick=location.href="<?php echo '../register.php?type=e&id='.$var?>">Register</button>
        
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.6/prefixfree.min.js"></script>
  <script src="js/background.js"></script>
  <script src="js/jquery-2.1.1.js"></script>
  <script>
  $(document).ready(function(){
        $('body').css('display', 'none');
        $('body').css('background', 'black');
				$('body').fadeIn(1000);


        /*$.ajax({
          url:'https://gyanith19-9fdcb.firebaseio.com/Schedule.json',
          type:'GET',
          success:(res)=>{

            obj=res;
            var eobj;
            for (k in obj){
              if(obj[k]['id']==id){
                eobj=obj[k];
                break;
              }
            }

             console.log(eobj);
             var venue=eobj['venue'];
             var d1=new Date(eobj['start_time']);
             var d=d1.toString().split(" ");
             var date=d[0]+", "+d[1]+" "+d[2];
             var time=d[4].slice(0,5);
             console.log(time);
             console.log(date);
             console.log(venue);
             $('#dtv').html(`
              Date: ${date}<br>
              Time: ${time}<br>
              Venue: ${venue}

          ` )
          }
        });*/


			});







</script>
	<script src="js/jquery-2.1.1.js"></script>
		<script src="js/velocity.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/noise.min.js"></script>
		<script src="js/util.js"></script>
		<script src="js/coalesce.js"></script>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>
