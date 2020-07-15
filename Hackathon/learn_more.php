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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gyanith '20 - Workshops</title>
    <link rel="shortcut icon" href="images/img_0.png">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="learn_more.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <style>
      body {
        margin: 0px 0px;
        font-family: 'Bebas Neue', cursive;
        color: white;
      }
      #particle-canvas {
        position: absolute;
        width: 100%;
        height: 130vh;
        background: linear-gradient(to bottom, rgb(10, 10, 50) 0%,rgb(60, 10, 60) 100%);
        vertical-align: middle;
        z-index: -1;
      }
      h1{
        text-align: center;
        top: 30px;
        width: 700px;
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
        
        #back_button {
          position: absolute;
          top: 6%;
          left: 5%;
          color: white;
          font-size: 35px;
        }
      </style>
</head>
<body>
  <canvas id="particle-canvas"></canvas>
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
      
      echo $ans["des"];
      ?></div>
      </div>
      <div><h2><center>CONTACT US</center></h2>
        <p class="para">Coming soon.</p></div>
      <div><h2><center>REGISTER</center></h2>
        <p class="para">Registration will open soon.</p><br><br>
        <button class="btn">Register</button></div>
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
			});
</script>

<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>
