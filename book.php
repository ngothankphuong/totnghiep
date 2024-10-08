<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta name="viewport" content="width = 1050, user-scalable = no" />
<script type="text/javascript" src="extras/jquery.min.1.7.js"></script>
<script type="text/javascript" src="extras/modernizr.2.5.3.min.js"></script>
<style>
/* ----------------------------------------------
 * Generated by Animista on 2023-8-17 8:17:36
 * Licensed under FreeBSD License.
 * See http://animista.net/license for more info. 
 * w: http://animista.net, t: @cssanimista
 * ---------------------------------------------- */

/**
 * ----------------------------------------
 * animation slide-left
 * ----------------------------------------
 */

@keyframes slide-left {
  0% {
    
            transform: translateX(100%);
  }
  100% {
    
            transform: translateX(0);
  }
}

.slide-left {
	
	         animation: slide-left 6s cubic-bezier(0.600, -0.280, 0.735, 0.045) 1s forwards; 
}

.u-image-1 {
    height: 200px;
    margin-top: 10px;
    margin-bottom: 0;
}

.u-expanded-width {
    width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
}

.u-back-image.u-image-contain, .u-image.u-image-contain {
    object-fit: contain;
    background-size: contain;
}
</style>
<link rel="stylesheet" href="css/card.css">


<?php
	
	include 'connection.php';
	
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$sql = "SELECT * FROM camnghi WHERE SHOWED = 1 ORDER BY ID DESC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) { 
	$i = 0;?>
</head>
<body>
<img class="u-expanded-width u-image u-image-contain u-image-default u-image-1" src="images/CUTLetotnghiep20231.png" alt="" data-image-width="1920" data-image-height="774">
<div class="flipbook-viewport">
	<div class="container slide-left">
		<div class="flipbook">
			<div style="background-image:url(images/page_bg.jpg)"><button id="next"></button></div>
			<?php // output data of each row
			while($row = $result->fetch_assoc()) { 
			if ($i % 2 == 0) { echo '<div style="background-image:url(images/page_ctbg.jpg)" style="margin:200px">'; } ?>
				<figure class="snip1197">
					<figcaption>
						<blockquote><?php if (strlen($row["CAMNGHI"]) > 200) { echo substr($row["CAMNGHI"],0,200) .' ...'; } else { echo $row["CAMNGHI"]; } ?></blockquote>
						<img src="images/<?php echo $row["MSSV"]; ?>.png" alt="sq-sample10"/>
						<div class="arrow"></div>
					</figcaption>
					<div  class="img" style="width:200px; background-image: url(uploads/<?php echo $row["MSSV"]; ?>.jpg); background-position: 50% 50%; background-size: cover;"></div>
					<div class="author">
						<h5><?php echo $row["HOTEN"]; ?><span>- <?php echo $row["LOP"]; ?></span></h5>
					</div>
				</figure>
			<?php if ($i % 2 == 1) { echo '</div>'; }
			$i ++;
			 }
			if ($i % 2 == 1) { echo '</div>'; } 
	} else {
	  echo "0 results";
	}
	$conn->close();
	?>
		</div>
	</div>
</div>


<script type="text/javascript">

function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:1500,
			
			// Height

			height:800,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['lib/turn.js'],
	nope: ['lib/turn.html4.min.js'],
	both: ['css/basic.css'],
	complete: loadApp
});

function NextPage(){
		setInterval(function () {
			$('.flipbook').turn('next');
    }, 4000);}
document.getElementById("next").addEventListener('click',NextPage);
</script>

</body>
</html>