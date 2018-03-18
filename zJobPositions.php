<?php
session_start();
include 'dbConnection.php';

$theClient = $_SESSION['userID'];
?>
<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Job Positions</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Owl Carousel -->
	<link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
	<link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

	<!-- Magnific Popup -->
	<link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
  <link type="text/css" rel="stylesheet" href="css/style2.css" />
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	.center {
    height: 70%;
    position: relative;
	}

	.center h1 {
	    margin: 0;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    -ms-transform: translate(-50%, -50%);
	    transform: translate(-50%, -50%);
	}
	@media (max-width: 575.98px) {
		.sButton {
			position: relative;
			margin-left: 2.45em;
			margin-top: 1em;
		}
	}
	</style>
</head>
<body style="background-color: ecf0f1;">
	<!-- Nav -->
	<nav id="nav" class="navbar">
		<div class="container">

			<div class="navbar-header">
				<!-- Logo -->
				<div class="navbar-brand">
					<a href="jobs.html">
						<img class="logo" src="img/logo.png" alt="logo">
						<img class="logo-alt" src="img/logo-alt.png" alt="logo">
					</a>
				</div>
				<!-- /Logo -->

				<!-- Collapse nav button -->
				<div class="nav-collapse">
					<span></span>
				</div>
				<!-- /Collapse nav button -->
			</div>

			<!--  Main navigation  -->
			<ul class="main-nav nav navbar-nav navbar-right">
				<li class="active"><a href="#home"><i class="fa fa-suitcase"></i>&nbsp;Jobs</a></li>
				<li><a href="profile.php"><i class="fa fa-user"></i>&nbsp;Profile</a></li>
				<li><a href="#message"><i class="fa fa-envelope"></i>&nbsp;Message</a></li>
        <li><a href="#application"><i class="fa fa-suitcase"></i>&nbsp;Application</a></li>
				<li><a href="index.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a></li>
			</ul>
			<!-- /Main navigation -->

		</div>
	</nav>
	<!-- /Nav -->


		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">
        <?php
        $client_jobpos = "SELECT * FROM jobposition WHERE theClient = $theClient";
        $result_client_jobpos = mysqli_query($connection, $client_jobpos);

        //fetch data from database
        while($row_client_jobpos = mysqli_fetch_array($result_client_jobpos) )
        {
          //declaration
          $title = $row_client_jobpos['title'];
          $desc = $row_client_jobpos['description'];
          $salary = $row_client_jobpos['salaryPerHour'];
          $hours = $row_client_jobpos['hoursPerWeek'];
          $weeks = $row_client_jobpos['durationInWeeks'];
          $address = $row_client_jobpos['address'];
          $city= $row_client_jobpos['city'];
          $status= $row_client_jobpos['status'];
          $theEmployee = $row_client_jobpos['theEmployee'];

          $job_emp = "SELECT * FROM jobseeker WHERE userID = $theEmployee";
          $result_job_emp = mysqli_query($connection, $job_emp);
          if (mysqli_num_rows($result_job_emp) > 0){
            while($row_job_emp = mysqli_fetch_assoc($result_job_emp) ) {
              $_SESSION['empName'] = $row_job_emp['fullName'];
            }
          } else {
              $_SESSION['empName'] = '-';
          }
        }


        echo "
        <div class='col-sm-3'>
          <div class='pricing'>
            <div class='price-head'>
        ";
        echo
              "<span class='price-title'>Title: " .
              $title . "</span>"
        ;
        echo "
              <div class='price'>
                <h3>$" . $salary . "</h3>
              </div> ";
        $link='"jobDetails.php"';
        echo "
            </div>
            <ul class='price-content'>";
        if (mysqli_num_rows($result2) > 0) {
          echo "Skills Required: ";
          $counter = 0;
          while ($row = mysqli_fetch_assoc($result2)) {
            $counter += 1;
            echo "
            <li>" . $row['skillName'] . "</li>
            ";
          }
          $rowPrint = 4 - $counter;
          for ($i = 0; $i <= $rowPrint; $i++) {
            echo "<br />";
          }
        }
        else {
          echo "No skills required";
          for ($i = 0; $i <= 4; $i++) {
            echo "<br />";
          }
        }


        echo "<div class='price-btn'>
              <form action='jobDetails.php' method='post'  target='_blank'>
                <input type=hidden name='jobID' value='" . $row['jobID'] .
                "'>
                <input class='outline-btn' type='submit' value='Details'>
              </form>
            </div>
          </div>
        </div>
        ";

          ?>

      </div>

		</div>
		<!-- /Container -->
	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">

			<!-- Row -->
			<div class="row">

				<div class="col-md-12">

					<!-- footer logo -->
					<div class="footer-logo">
						<a href="index.php"><img src="img/logo-alt.png" alt="logo"></a>
					</div>
					<!-- /footer logo -->

					<!-- footer follow -->
					<ul class="footer-follow">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						<li><a href="#"><i class="fa fa-youtube"></i></a></li>
					</ul>
					<!-- /footer follow -->

					<!-- footer copyright -->
					<div class="footer-copyright">
						<p>Copyright © 2017 AGN. All Rights Reserved. Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>
					</div>
					<!-- /footer copyright -->

				</div>

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</footer>
	<!-- /Footer -->
	<!-- Back to top -->
	<div id="back-to-top"></div>
	<!-- /Back to top -->

	<!-- Preloader -->
	<div id="preloader">
		<div class="preloader">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<!-- /Preloader -->

	<!-- jQuery Plugins -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript" src="js/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
