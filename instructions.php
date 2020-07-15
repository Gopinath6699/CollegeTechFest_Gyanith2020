
<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<style type="text/css">

	
	.vback
	{
		text-decoration: none;
		color:white;
		font-size: 40px;
		position: absolute;
		left:20px;
	}
	.vback:hover
	{
		color:white;
	}

	.card
	{
		background-color: #1d1e22;
	}



/*Create ripple effec*/

.ripple {
  position: relative;
  overflow: hidden;
  transform: translate3d(0, 0, 0);
}

.ripple:after {
  content: "";
  display: block;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  pointer-events: none;
  background-image: radial-gradient(circle, #fff 10%, transparent 10.01%);
  background-repeat: no-repeat;
  background-position: 50%;
  transform: scale(10, 10);
  opacity: 0;
  transition: transform .5s, opacity 1s;
}

.ripple:active:after {
  transform: scale(0, 0);
  opacity: .3;
  transition: 0s;
}
</style>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<div class="container-fluid ">
<div class="row bg-dark">
<a  class="vback" href="index2.html"><i class="fas fa-arrow-left" id="back_button"></i></a>
<div class="col col-lg-10 p-xl-5   mx-auto k">

	<div class='card card-inverse text-white'>
	<div class='card-header'>
	<h2>Registration Instructions</h2>
	<button class="btn  btn-success" style="float:right;" onclick="window.location.assign('https://www.thecollegefever.com/college-technical-fests/burnout-IgVj9eUqG6')">Go to College Fever</button>
</div>
<div class="card-body  card-inverse">
	<h4 class="text-center p-4">1.Go to the Gyanith 20 College Fever site</h4>
	<img src="images/step.png " class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">
	<h4 class="text-center p-4">2.Read the Rules</h4>
	<img src="images/step2.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">
	<h5 class="text-center p-4">3.Scroll to the Event or Workshop you want to register and click Book Now</h5>
	<img src="images/step3.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">
	<h5 class="text-center p-4">4.Choose the ticket type  and click proceed</h5>
	<img src="images/step4.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">
	<h5 class="text-center p-4">5.Sign in using Google or Facebook account</h5>
	<img src="images/step5.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">
	

	<h5 class="text-center p-4">6.Uncheck Pay Rs.50 and get free online face-to-face expert driven practice interview </h5>
	<img src="images/step7.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">

	<h5 class="text-center p-4">7.Enter details and click Pay Now</h5>
	<img src="images/step8.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">

	<h5 class="text-center p-4">8.Select type of Payment and enter the details</h5>
	<img src="images/step9.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">

	<h5 class="text-center p-4">9.Enter OTP and complete the transaction</h5>
	<img src="images/step10.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">

	<h5 class="text-center p-4">10.Click print Ticket to get the E-ticket</h5>
	<img src="images/step11.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">

	<h5 class="text-center p-4">11.The ticket is required for participation in Events/Workshops</h5>
	<img src="images/step12.png" class="mb-4 rounded shadow mx-auto d-block img-fluid " alt="">


    <button class="btn btn-block btn-success" onclick="window.location.assign('https://www.thecollegefever.com/college-technical-fests/burnout-IgVj9eUqG6')">Go to College Fever</button>
  </div>
</div>

</div>
</div>

</body>
</html>