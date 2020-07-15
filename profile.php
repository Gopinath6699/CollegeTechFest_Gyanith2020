<!DOCTYPE html>
<html>
<head>
	<title>profile</title>
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=0.9">

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
    <script type="text/javascript">
        function sw(id,load){

            if(load){
                $('.tabs').children().removeClass('active')
            $('#'+id).addClass('active')

            
            $('.info').animate({opacity:0},0,()=>{
                $('.info').children().css('display','none')
                $('#'+id+1).css('display','inline-block')
                console.log('#'+id+1);
            })
            }

            
            // $('#'+id).css('color','#CB356B')
            $('.tabs').children().removeClass('active')
            $('#'+id).addClass('active')

            
            $('.info').animate({opacity:0},250,()=>{
                $('.info').children().css('display','none')
                $('#'+id+1).css('display','inline-block')
                console.log('#'+id+1);
            })

            
            $('.info').animate({opacity:1},250)
        }


        function d(text){
            $(document).ready(()=>{
            $('#dtext').html(text)
            $('#di').css('display','flex')
            //sw('ta',true)



            })



          
            
            
        }

        
    </script>



	<?php 
	session_start();
	if(!isset($_SESSION['gyid']))
		header('location:login.php');
	
	include 'connect.php';
	include 'phpqrcode/qrlib.php';
		

			
			try{
			

				$qu=$con->prepare("select gyid,name,usr,clg,phno from users where gyid=:gyid");
				$qu->bindParam(":gyid",$_SESSION['gyid']);
				$qu->execute();
				$res=$qu->fetchAll(PDO::FETCH_ASSOC);

				

				ob_start();
				QRcode::png($res[0]['gyid'],null,'L',5,2);
				$qst=base64_encode(ob_get_contents());
				ob_end_clean();
				
				//print_r($res[0]);




			}catch(Exceptin $e){
				die('cannot acces db !');
			}

			if(isset($_POST['logout'])){

				unset($_POST);
				unset($_SESSION['gyid']);
				session_destroy();
				header('location:login.php');
			}

            echo "<script>var usri={}</script>";
            foreach($res[0] as $k=>$v){
                    echo "<script>usri['$k']='$v'</script>";
                }


    if(isset($_POST['b'])){


        $aq=$con->prepare("select * from transactions where (gyid='{$_SESSION['gyid']}' and eid=1000)");
        $aq->execute();
        $r=$aq->fetchAll(PDO::FETCH_ASSOC);
        
        if(count($r)==0){

            $intt=str_replace("T"," ",$_POST['intime']);
            $intt.=":00";

            $outt=str_replace("T"," ",$_POST['outtime']);
            $outt.=":00";
            
            $i="insert into transactions(gyid,eid,intime,outtime) values('{$_SESSION['gyid']}',1000,'{$intt}','{$outt}')";
            
             $iq=$con->query($i);
            if($iq){
                echo "<script>d('Accommodation booked&shy; successfully.');
                location.href='instructions.php';
                </script>"; 
            }else{
               
                echo "<script>d('Booking Failed.')</script>"; 
            }

        }else{
          echo "<script>d('You have already booked &shy;for Accommodation.')</script>";  
        }
        
    }



	 ?>
	
	
	 <script type="text/javascript">
	 	

	 	function ini() {

    var width, height, largeHeader, canvas, ctx, points, target, animateHeader = true;

    // Main
    initHeader();
    initAnimation();
    addListeners();

    function initHeader() {
        width = window.innerWidth;
        height = window.innerHeight;
        target = {x: width/2, y: height/2};

        // largeHeader = document.getElementById('large-header');
        // largeHeader.style.height = height+'px';

        canvas = document.getElementById('demo-canvas');
        canvas.width = width;
        canvas.height = height;
        ctx = canvas.getContext('2d');

        // create points
        points = [];
        for(var x = 0; x < width; x = x + width/20) {
            for(var y = 0; y < height; y = y + height/20) {
                var px = x + Math.random()*width/20;
                var py = y + Math.random()*height/20;
                var p = {x: px, originX: px, y: py, originY: py };
                points.push(p);
            }
        }

        // for each point find the 5 closest points
        for(var i = 0; i < points.length; i++) {
            var closest = [];
            var p1 = points[i];
            for(var j = 0; j < points.length; j++) {
                var p2 = points[j]
                if(!(p1 == p2)) {
                    var placed = false;
                    for(var k = 0; k < 5; k++) {
                        if(!placed) {
                            if(closest[k] == undefined) {
                                closest[k] = p2;
                                placed = true;
                            }
                        }
                    }

                    for(var k = 0; k < 5; k++) {
                        if(!placed) {
                            if(getDistance(p1, p2) < getDistance(p1, closest[k])) {
                                closest[k] = p2;
                                placed = true;
                            }
                        }
                    }
                }
            }
            p1.closest = closest;
        }

        // assign a circle to each point
        for(var i in points) {
            var c = new Circle(points[i], 2+Math.random()*2, 'rgba(255,255,255,0.3)');
            points[i].circle = c;
        }
    }

    // Event handling
    function addListeners() {
        if(!('ontouchstart' in window)) {
            window.addEventListener('mousemove', mouseMove);
        }
        window.addEventListener('scroll', scrollCheck);
        window.addEventListener('resize', resize);
    }

    function mouseMove(e) {
        var posx = posy = 0;
        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        }
        else if (e.clientX || e.clientY)    {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        target.x = posx;
        target.y = posy;
    }

    function scrollCheck() {
        if(document.body.scrollTop > height) animateHeader = false;
        else animateHeader = true;
    }

    function resize() {
        width = window.innerWidth;
        height = window.innerHeight;
        //largeHeader.style.height = height+'px';
        canvas.width = width;
        canvas.height = height;
    }

    // animation
    function initAnimation() {
        animate();
        for(var i in points) {
            shiftPoint(points[i]);
        }
    }

    function animate() {
        if(animateHeader) {
            ctx.clearRect(0,0,width,height);
            for(var i in points) {
                // detect points in range
                if(Math.abs(getDistance(target, points[i])) < 4000) {
                    points[i].active = 0.3;
                    points[i].circle.active = 0.6;
                } else if(Math.abs(getDistance(target, points[i])) < 20000) {
                    points[i].active = 0.1;
                    points[i].circle.active = 0.3;
                } else if(Math.abs(getDistance(target, points[i])) < 40000) {
                    points[i].active = 0.02;
                    points[i].circle.active = 0.1;
                } else {
                    points[i].active = 0;
                    points[i].circle.active = 0;
                }

                drawLines(points[i]);
                points[i].circle.draw();
            }
        }
        requestAnimationFrame(animate);
    }

    function shiftPoint(p) {
        TweenLite.to(p, 1+1*Math.random(), {x:p.originX-50+Math.random()*100,
            y: p.originY-50+Math.random()*100, ease:Circ.easeInOut,
            onComplete: function() {
                shiftPoint(p);
            }});
    }

    // Canvas manipulation
    function drawLines(p) {
        if(!p.active) return;
        for(var i in p.closest) {
            ctx.beginPath();
            ctx.moveTo(p.x, p.y);
            ctx.lineTo(p.closest[i].x, p.closest[i].y);
            ctx.strokeStyle = 'rgba(156,217,249,'+ p.active+')';
            ctx.stroke();
        }
    }

    function Circle(pos,rad,color) {
        var _this = this;

        // constructor
        (function() {
            _this.pos = pos || null;
            _this.radius = rad || null;
            _this.color = color || null;
        })();

        this.draw = function() {
            if(!_this.active) return;
            ctx.beginPath();
            ctx.arc(_this.pos.x, _this.pos.y, _this.radius, 0, 2 * Math.PI, false);
            ctx.fillStyle = 'rgba(156,217,249,'+ _this.active+')';
            ctx.fill();
        };
    }

    // Util
    function getDistance(p1, p2) {
        return Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2);
    }

   
     
    



    
    $('#td1').html(`
    	<strong>GYID: &nbsp;</strong>${usri["gyid"]}<br>
    	<strong>Name: &nbsp;</strong>${usri["name"]}<br>
    	<strong>College: &nbsp;</strong>${usri["clg"]}<br>
    	<strong>Phone No: &nbsp;</strong>${usri["phno"]}
    	`);
   
    
    

    $('#usr').html(`@${usri["usr"]}`)

    if(window.location.href.split("?")[1].split("=")[0]=="acc")
            sw('ta',true)
    if(window.location.href.split("?")[1].split("=")[0]=="app"){
        sw('ta',true)
        $('.im-div').css('display','none')
        $('.tabs').css('display','none')
        $('#demo-canvas').css('display','none')
    }


};
	 </script>













	<!--Actual code-->


	 <script type="text/javascript">



	 	


        
	 </script>



	  <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700' rel='stylesheet' type='text/css'>
	 <style type="text/css">

	 	@import url("https://fonts.googleapis.com/css?family=Montserrat:700");
	 	@import url('https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap');

	 	body{
	 		background-color: black;
	 		color:white;
	 		font-family: 'Montserrat',sans-serif;
	 	}

        .main-div{
            position: absolute;
            top:0;
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            padding:20px 10px 10px 10px;
           

        }

        .inner{
            display: flex;
            justify-content: center;
            align-content: stretch;
            flex-wrap: wrap;
            height: 80vh;


        }

        .imm{
            padding:5px;
            border-radius: 10px;
            background-color: white;
        }

        .im-div{
        	flex-grow: 1;
        	min-width: 230px;
        	width: 25vw;
            display: inline-flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background:linear-gradient(135deg,#CB356B,#BD3F32);
            padding:20px 20px 20px 20px;
            width: auto;

        }

        .sbtn{
            min-width: 70px;
        	font-family: inherit;
        	font-size: 1.2em;
            outline:none;
            padding:5px 5px 5px 5px;
            margin-top:10px;
            display: inline-block;
            background-color: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 5px;

        }
         .sbtn:hover{
            min-width: 70px;
         	font-family: inherit;
        	font-size: 1.2em;
            outline:none;
            padding:5px 5px 5px 5px;
            margin-top:10px;
            display: inline-block;
            background-color: white;
            color:#CB356B;
            cursor:pointer;

        }
       
       .info-div{
      

       flex-grow: 1;
       min-width: 60vw;
      
       color:#CB356B;
       
       }

       @keyframes ani{
       	from {opacity: 0}
       	to {opacity: 1};
       }

       .info{
       	font-family: 'PT sans';
       	color: white;
       	font-size: 1.6em;
       	height: 100%;
       	padding:10px 10px 10px 10px;
       	animation: ani 0.5s;
       	display: flex;
       	justify-content: center;
       	align-items: center;
       	text-align: justify;
       }

       .tabs{
       	font-family:'Bebas Neue',cursive;
       	display: flex;
       	justify-content: space-around;



       }

       .tab-btn{
       	color: white;
       	font-size: 2em;
       	padding:10px 10px 10px 10px;
       	outline: none;
       	background-color: transparent;
       }

       .tab-btn:hover{
       	color:#ffffffa8;
       	font-size: 2em;
       	padding:10px 10px 10px 10px;
       	outline: none;
       	background-color: transparent;
       	cursor: pointer;
       }

       .tab-btn.active{
       	color:#CB356B;
       	font-size: 2em;
       	padding:10px 10px 10px 10px;
       	outline: none;
       	background-color: transparent;
       }

     
        

       .bk{
            font-family: 'Montserrat',sans-serif;
            font-size: 0.8em;
            outline:none;
            padding:5px 10px 5px 10px;
            margin-top:10px;
            display: inline-block;
            background-color: transparent;
            color: white;
            border: 2px solid white;
            border-radius: 5px;
            margin: 10px 10px 10px 10px;
            float: right;

        }
         .bk:hover{
            font-family: 'Montserrat',sans-serif;
            font-size: 0.8em;
            outline:none;
            padding:5px 10px 5px 10px;
            margin-top:10px;
            display: inline-block;
            background-color: #BD3F32;
            color:white;
            cursor:pointer;
            margin: 10px 10px 10px 10px;
            float: right;

        }
          .inner-f input{
            max-width: 80vw;
            font-family: 'PT Sans';
            font-size: 1.2em;
            border: none;
            outline: none;
            color:white;
            background-color: transparent;
        }
        

        .inner-f {
            color:#CB356B;
        }

        #di{
            padding: 15px;
            flex-wrap: wrap;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 5;
            position: fixed;
            left: 0;
            
            bottom: 0;
            width:100%;
            
            font-family:'Montserrat',sans-serif;
            background: linear-gradient(135deg,#BD3F32,#CB356B);
            animation: up 0.4s;
        }


        #dtext{
            line-height: 100%;
            font-size: 1.2em;
        }

        @keyframes up{
            from{margin-bottom: -25px;}
            to{margin-bottom: 0px;}
            
        }



       





	 </style>
</head>
<body onload="ini()">
	 <canvas id='demo-canvas'></canvas>
   <div id='di'>
        <span id='dtext' style="margin-left:10px">Hi there i m a dialog</span>
        
    </div>
    <h2 style="top:0;position: absolute;margin:10px 0px 0px 10px; z-index: 1 ;display:none;">Profile</h2>
 
    <div class="main-div">
        <div class="inner" >
	
    <div class="im-div">
	
    <div class="imm">
    <?php

        echo "<img src='data:img/png;base64,$qst' style='height:180px; width:180px;'></img><br>";
    ?></div>
        <h1 id='usr'>@hvk</h1>
        <form action="" method="post" >
        <input type="submit" name="logout" value="Sign Out" class="sbtn" >
    </form>
    </div>

    <div class="info-div">
    	
        <div class="tabs" >
        	<!-- <span id="ts"></span> -->
            <span class="tab-btn active" id='td' onclick="sw(this.id,false)">Details</span>
            <span class="tab-btn" id='ta' onclick="sw(this.id,false)">Accommodation</span>
       
            
        </div>
        <div class="info">
        	<div id="td1" style="display: inline-block;">
        		details page
        	</div>

        	<div id="ta1" style="display: none">
        		<form action="profile.php" method="post">
                    <span class='inner-f'>
                <label>
                    Check in Date & Time<br>
                    <input type="datetime-local" name="intime" min="2020-03-03T08:30" max="2020-03-08T09:30" required><br><br>
                </label>
                <label>
                    Check out Date & Time<br>
                    <input type="datetime-local" name="outtime" min="2020-03-03T08:30" max="2020-03-08T22:30" required><br><br>
                </label></span>

                <input type="submit" name="b" class="bk" value="Book">
                </form>
        	</div>

        </div>
    </div>

	 <br/>
	
</div>
	
  </div>
</body>
</html>