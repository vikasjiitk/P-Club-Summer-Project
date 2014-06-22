<!DOCTYPE html>
<html lang="en" class="demo-2 no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<title>About Us</title>
		<meta name="description" content="Hover Effects with animated SVG Shapes using Snap.svg" />
		<meta name="keywords" content="animated svg, hover effect, grid, svg shape html, " />
		<meta name="author" content="Codrops" />
		<link rel="shortcut icon" href="assets/ico/favicon.ico">
		<link rel="stylesheet" type="text/css" href="normalize.css" />
		
		<link rel="stylesheet" type="text/css" href="component.css" />
		<link href="welcome.css" rel="stylesheet" />
 
		<link href="css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" href="demo2.css" />
        <link rel="stylesheet" type="text/css" href="style7.css" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300|McLaren' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="modernizr.custom.79639.js"></script> 
    <!-- Custom styles for this template -->
    <link href="navbar-fixed-top.css" rel="stylesheet" />
		<script src="svg-min.js"></script>
	
<style type="text/css">
h1{ font-family: Magneto;
color:black;
font-size: 50px;}
.abt{
	font-family: Arial;
	text-align: center;
}

</style>
<?php session_start();
if(!$_SESSION['loggedin'])
{
header("Location:login.php");
exit;
}
?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-7243260-2']);
_gaq.push(['_trackPageview']);
(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
</script>








		</head>
	<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="welcome.php">Welcome <?php echo $_SESSION['userlogin']?> !</a>
</div>
<div class="navbar-collapse collapse">
<ul class="nav navbar-nav">
<li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
<li><a href="create_group.php"><span class="glyphicon glyphicon-list-alt"></span> Create Group</a></li>
<li><a href="yourgroup.php"><span class="glyphicon glyphicon-tasks"></span> Your Group</a></li>
<li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>


</ul>
<ul class="nav navbar-nav navbar-right">
<li><a href="contacts.php"><span class="glyphicon glyphicon-phone-alt"></span>Contacts</a></li>
<li class="active"><a href="aboutus.php">About Us</a></li>
<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span>Sign-out</a></li>
</ul>
</div><!--/.nav-collapse -->
</div>
</div>


<h1 style="text-align:Center"><b>Share Ur Fare</b></h1>
<section class="main">
				
				<h2 class="cs-text">
					<span>a</span>
					<span>B</span>
					<span>O</span>
					<span>U</span>
					<span>T</span>
					<span>U</span>
					<span>S</span>
					<span></span>
				</h2>
				
			</section>

		<div class="container">
			<section id="grid" class="grid clearfix">
				<a href="https://www.facebook.com/angadchan02" data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
					<figure>
						<img src="angad.png" />
						<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"/></svg>
						<figcaption>
							<h2>Angad Chandhok</h2>
							<p>BS MATH<br>HALL-X</p>
							<button onClick="window.location.href='https://www.facebook.com/angadchan02'">View</button>
						</figcaption>
					</figure>
				</a>

				
				<a href="https://www.facebook.com/profile.php?id=100001634473615" data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
					<figure>
						<img src="shubham.png" />
						<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"/></svg>
						<figcaption>
							<h2>Shubham Gupta</h2>
							<p>BTech EE<br>HALL-X</p>
							<button onClick="window.location.href='https://www.facebook.com/profile.php?id=100001634473615'">View</button>
						</figcaption>

					</figure>
				</a>
				<a href="https://www.facebook.com/sushant.mukhija.3" data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
					<figure>
						<img src="sushant.png" />
						<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"/></svg>
						<figcaption>
							<h2>Sushant Mukhija</h2>
							<p>Btech EE<br>HALL-V</p>
							<button onClick="window.location.href='https://www.facebook.com/sushant.mukhija.3'">View</button>
						</figcaption>
					</figure>
				</a>
				<a href="https://www.facebook.com/profile.php?id=100006478844998" data-path-hover="m 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z">
					<figure>
		

						<img src="vikas.png" />
						
						<svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="m 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z"/></svg>
						<figcaption>
							<h2>Vikas Jain</h2>
		
							<p>BTech EE<br>HALL-X</p>
		
							<button onClick="window.location.href='https://www.facebook.com/profile.php?id=100006478844998'">View</button>
						</figcaption>

					</figure>
				</a>
					</section>
					</div><!-- /container -->
		<script>
		(function() {
	
				function init() {
					var speed = 330,
						easing = mina.backout;

					[].slice.call ( document.querySelectorAll( '#grid > a' ) ).forEach( function( el ) {
						var s = Snap( el.querySelector( 'svg' ) ), path = s.select( 'path' ),
							pathConfig = {
								from : path.attr( 'd' ),
								to : el.getAttribute( 'data-path-hover' )
							};

						el.addEventListener( 'mouseenter', function() {
							path.animate( { 'path' : pathConfig.to }, speed, easing );
						} );

						el.addEventListener( 'mouseleave', function() {
							path.animate( { 'path' : pathConfig.from }, speed, easing );
						} );
					} );
				}

				init();

			})();
		</script>
		
	</body>
</html>
