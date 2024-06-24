<!DOCTYPE html>
<?php
session_start();
//Set session variables
if (isset($_SESSION["flag"]))
{
	 header('Location: submit.php');
}
?>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="We are committed expert partners">
    <meta name="description" content="">
    <title>Home</title>
    <link rel="stylesheet" href="css/nicepage.css" media="screen">
	<link rel="stylesheet" href="css/Home.css" media="screen">
    
    
    <meta name="generator" content="Nicepage 5.15.1, nicepage.com">
    <meta name="referrer" content="origin">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function () {
         initialize();
      });
 

      // works out the X, Y position of the click inside the canvas from the X, Y position on the page
      function getPosition(mouseEvent, sigCanvas) {
         var x, y;
         if (mouseEvent.pageX != undefined && mouseEvent.pageY != undefined) {
            x = mouseEvent.pageX;
            y = mouseEvent.pageY;
         } else {
            x = mouseEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            y = mouseEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop;
         }
 
		var p = document.getElementById("frame");
		var style = p.currentStyle || window.getComputedStyle(p);	
		
        return { X: x - sigCanvas.offsetLeft - parseInt(style.marginLeft) , Y: y - sigCanvas.offsetTop - parseInt(style.marginTop) + 23	 };
      }
 
      function initialize() {
         // get references to the canvas element as well as the 2D drawing context
         var sigCanvas = document.getElementById("canvasSignature");
         var context = sigCanvas.getContext("2d");
         context.strokeStyle = 'Black';
 
         // This will be defined on a TOUCH device such as iPad or Android, etc.
         var is_touch_device = 'ontouchstart' in document.documentElement;
 
         if (is_touch_device) {
			var p = document.getElementById("frame");
			var style = p.currentStyle || window.getComputedStyle(p);	
			console.log(parseInt(style.marginLeft))
            // create a drawer which tracks touch movements
            var drawer = {
               isDrawing: false,
               touchstart: function (coors) {
                  context.beginPath();
                  context.moveTo(coors.x, coors.y);
                  this.isDrawing = true;
               },
               touchmove: function (coors) {
                  if (this.isDrawing) {
                     context.lineTo(coors.x, coors.y);
                     context.stroke();
                  }
               },
               touchend: function (coors) {
                  if (this.isDrawing) {
                     this.touchmove(coors);
                     this.isDrawing = false;
                  }
               }
            };
 
            // create a function to pass touch events and coordinates to drawer
            function draw(event) {
 
               // get the touch coordinates.  Using the first touch in case of multi-touch
               var coors = {
                  x: event.targetTouches[0].pageX,
                  y: event.targetTouches[0].pageY
               };
 
               // Now we need to get the offset of the canvas location
               var obj = sigCanvas;
 
               if (obj.offsetParent) {
                  // Every time we find a new object, we add its offsetLeft and offsetTop to curleft and curtop.
                  do {
                     coors.x -= obj.offsetLeft;
                     coors.y -= obj.offsetTop;
                  }
				  // The while loop can be "while (obj = obj.offsetParent)" only, which does return null
				  // when null is passed back, but that creates a warning in some editors (i.e. VS2010).
                  while ((obj = obj.offsetParent) != null);
               }
 
               // pass the coordinates to the appropriate handler
               drawer[event.type](coors);
            }
 

            // attach the touchstart, touchmove, touchend event listeners.
            sigCanvas.addEventListener('touchstart', draw, false);
            sigCanvas.addEventListener('touchmove', draw, false);
            sigCanvas.addEventListener('touchend', draw, false);
 
            // prevent elastic scrolling
            sigCanvas.addEventListener('touchmove', function (event) {
               event.preventDefault();
            }, false); 
         }
         else {
 
            // start drawing when the mousedown event fires, and attach handlers to
            // draw a line to wherever the mouse moves to
            $("#canvasSignature").mousedown(function (mouseEvent) {
               var position = getPosition(mouseEvent, sigCanvas);
 
               context.moveTo(position.X, position.Y);
               context.beginPath();
 
               // attach event handlers
               $(this).mousemove(function (mouseEvent) {
                  drawLine(mouseEvent, sigCanvas, context);
               }).mouseup(function (mouseEvent) {
                  finishDrawing(mouseEvent, sigCanvas, context);
               }).mouseout(function (mouseEvent) {
                  finishDrawing(mouseEvent, sigCanvas, context);
               });
            });
 
         }
      }
 
      // draws a line to the x and y coordinates of the mouse event inside
      // the specified element using the specified context
      function drawLine(mouseEvent, sigCanvas, context) {
 
         var position = getPosition(mouseEvent, sigCanvas);
 
         context.lineTo(position.X, position.Y);
         context.stroke();
      }
 
      // draws a line from the last coordiantes in the path to the finishing
      // coordinates and unbind any event handlers which need to be preceded
      // by the mouse down event
      function finishDrawing(mouseEvent, sigCanvas, context) {
         // draw the line to the finishing coordinates
         drawLine(mouseEvent, sigCanvas, context);
 
         context.closePath();
 
         // unbind any events which could draw
         $(sigCanvas).unbind("mousemove")
                     .unbind("mouseup")
                     .unbind("mouseout");
      }
	  function uploadFile() {
		var canvas = document.getElementById('canvasSignature');
        document.getElementById('hidden_data').value = canvas.toDataURL('image/png');
		
		if(document.getElementById("form").checkValidity()) {
			document.getElementById("form").submit();
		}
		else{
			alert("Vui lòng điền đầy đủ thông tin!!");
		}
      }
	  
	  
	  
   </script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body class="u-body u-xl-mode" data-lang="en">
    <section class="u-align-center u-clearfix u-container-align-center u-white u-section-1" id="carousel_7394" style="min-height: 0px;">
      <img class="u-expanded-width u-image u-image-default u-image-1" src="images/gh4.jpg" alt="" style="margin-top: 0px;">
      <h2 class="u-align-center u-text u-text-default u-text-1"></h2>
      <div class="u-form u-radius-20 u-white u-form-1" id="frame">
        <form  id="form" action="submit.php" method="POST" class="u-clearfix u-form-spacing-15 u-inner-form"  name="form" style="padding: 23px; " enctype="multipart/form-data">
          <h4 class="u-align-center u-form-group u-form-text u-text u-text-2">NHẬP CẢM NGHĨ CỦA BẠN<span style="text-decoration: underline !important;"></span>
          </h4>
          <div class="u-form-group u-form-name" style="margin-bottom: 15px;">
            <label for="name-4c18" class="u-label">Họ Tên</label>
            <input type="text" placeholder="Nhập Họ Tên" id="name" name="name" class="u-border-2 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-10" required="">
          </div>
		  <div class="u-form-group u-form-name" style="margin-bottom: 15px;">
            <label for="name-4c18" class="u-label">Mã Số Sinh Viên</label>
            <input type="text" placeholder="Nhập MSSV" id="mssv" name="mssv" class="u-border-2 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-10" required="">
          </div>
          <div class="u-form-name u-form-group" style="margin-bottom: 15px;">
            <label for="name-4c18" class="u-label">Lớp</label>
            <input type="text" placeholder="Nhập Lớp" id="class" name="class" class="u-border-2 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-10" required="">
          </div>
          <div class="u-form-group u-form-message" style="margin-bottom: 15px;">
            <label for="message-4c18" class="u-label">Nội dung cảm nghĩ về thầy cô, gia đình, bạn bè, trường lớp:</label>
			</div>
			<div class="u-form-group u-form-message" style="margin-bottom: 15px;">	
			<label for="message-4c18" class="u-label" style="color:#FF0000;"><i>Ghi chú: các cảm nghĩ không phù hợp sẽ ko được duyệt</i></label>
            <textarea placeholder="Nhập nội dung cảm nghĩ (không quá 3 dòng)" rows="4" cols="50" id="message" name="message" class="u-border-2 u-border-grey-10 u-grey-10 u-input u-input-rectangle u-radius-10" maxlength="150"></textarea>
          </div>
		  <div id="canvasDiv" class="u-form-group u-form-message" style="margin-bottom: 15px;">
			<label for="message-4c18" class="u-label">Ký Tên (Vui lòng xoay ngang điện thoại):</label><input type="button" id="clear" value="Viết Lại">
			<canvas id="canvasSignature" width="487px" height="300px" style="border:2px solid #000000;" data-canvas-default-options="" class="u-border-2 u-border-grey-10 u-input u-input-rectangle u-radius-10"></canvas>
			<input name="hidden_data" id='hidden_data' type="hidden"/>
		  </div>
          <div class="u-form-agree u-form-group u-form-group-5" style="margin-bottom: 15px;">
            <label for="fileToUpload">Ảnh đại diện: </label>
			<input type="file" name="fileToUpload" id="fileToUpload" onchange="fileSelected();" accept="image/*" capture="camera" />
            </label>
          </div>
		  
          <div class="u-align-right u-form-group u-form-submit">
            <input onclick="uploadFile();" type="button" class="u-active-palette-3-base u-border-5 u-border-active-palette-3-base u-border-hover-palette-3-base u-border-palette-2-base u-btn u-btn-round u-button-style u-hover-palette-3-base u-palette-2-base u-radius-10 u-btn-1"   value="Gởi Cảm Nghĩ" />
          </div>
		  
        </form>
		
      </div>
    </section>
    <script>
      let canvas = document.getElementById('canvasSignature');
      let context = canvas.getContext('2d');
      
      
      // bind event handler to clear button
      document.getElementById('clear').addEventListener('click', function() {
          context.clearRect(0, 0, canvas.width, canvas.height);
        }, false);
    </script>
  
</body></html>