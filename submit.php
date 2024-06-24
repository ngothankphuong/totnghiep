<?php
session_start();
require __DIR__ . '/vendor/autoload.php';
use Ratchet\Client\Connector;
use React\EventLoop\Factory;
use React\Socket\Connector as ReactConnector;


function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
{
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
    imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
    return $imageLayer;
}


if ( !isset($_SESSION["flag"]) and strlen($_POST['mssv']) > 0)
{
	$imageProcess = 0;
	$fileExt = "";
    if (is_array($_FILES))
    {
        $new_width = 540;
        $new_height = 540;
        $fileName = $_FILES['fileToUpload']['tmp_name'];
		if (strlen($fileName) > 0)
		{
			
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = $_FILES['fileToUpload']['name'];
        $uploadPath = "uploads/";
        $fileExt = pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType)
        {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                imagejpeg($imageLayer, $uploadPath . $_POST['mssv']. '.'. $fileExt);
            break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                imagegif($imageLayer, $uploadPath . $resizeFileName);
            break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                imagepng($imageLayer, $uploadPath . $resizeFileName);
            break;

            case IMAGETYPE_JPG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                imagepng($imageLayer, $uploadPath . $resizeFileName);
            break;

            default:
                $imageProcess = 0;
            break;
        }
        //move_uploaded_file($fileName, $uploadPath . $resizeFileName . "." . $fileExt);
        $imageProcess = 1;
		}
    }

    if ($imageProcess == 1)
    {}
	
	define('UPLOAD_DIR', 'images/');
	$img = $_POST['hidden_data'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . $_POST['mssv'] . '.png';
	$success = file_put_contents($file, $data);

	include 'connection.php';

	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$name = $_POST['name'];
	$class = $_POST['class'];
	$message = $_POST['message']; 
	$mssv = $_POST['mssv']; 
	$file = $_POST['mssv']. '.'. $fileExt; 

	$sql = "INSERT INTO camnghi (HOTEN, LOP, CAMNGHI, ANH, MSSV)
	VALUES ('$name', '$class', '$message','$file','$mssv')";

	if ($conn->query($sql) === TRUE) {
	$_SESSION["flag"] = "1";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


  // GỬI TIN NHẮN ĐẾN ADMIN
  $id = null; 
  // Lấy ID từ bảng camnghi dựa trên MSSV
  $sql1 = "SELECT ID FROM camnghi WHERE MSSV = '$mssv' LIMIT 1";
  $result = $conn->query($sql1);

  if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $id = $row["ID"];
  } else {
      echo "Không có kết quả nào.";
  }
  $mess = [
    'id'=> $id,
    'name'=> $name,
    'class' => $class,
    'message' => $message,
    'mssv' => $mssv,
    'file_name' => $file,
    'hinh' => $file
  ];

  $mess_user = json_encode($mess, JSON_UNESCAPED_UNICODE);

  $loop = Factory::create();
  $reactConnector = new ReactConnector($loop);
  $connector = new Connector($loop, $reactConnector);

  $connector('ws://localhost:8080')
    ->then(function(Ratchet\Client\WebSocket $conn) use ($mess_user) {
        $conn->send($mess_user);
        $conn->close();
    }, function(\Exception $e) {
        echo "Could not connect: {$e->getMessage()}\n";
    });

  $loop->run();


$conn->close();
} else {
	if (!isset($_SESSION["flag"])){
		header("Location: index.php"); 
		exit();
	}
}


?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="en"><head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="​Increase your website traffic with us!">
    <meta name="description" content="">
    <title>About</title>
    <link rel="stylesheet" href="nicepage.css" media="screen">
	<link rel="stylesheet" href="About.css" media="screen">
    <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.15.1, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
    
    
    
    <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": ""
}</script>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="About">
    <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/"></head>
  <body class="u-body u-xl-mode" data-lang="en">
    <section class="u-clearfix u-container-align-center-sm u-container-align-center-xs u-image u-section-1" id="carousel_6293" data-image-width="1400" data-image-height="788">
      <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-xl u-sheet-1">
        <div class="u-container-align-center u-container-style u-group u-opacity u-opacity-45 u-radius-50 u-shape-round u-white u-group-1">
          <div class="u-container-layout u-valign-middle u-container-layout-1">
            <h1 class="u-align-center u-text u-text-default u-text-1">Cám ơn bạn đã gởi cảm nghỉ cho chúng tôi!</h1>
          </div>
        </div>
      </div>
    </section>
    
  
</body></html>