<?php
function resizeImage($resourceType, $image_width, $image_height, $resizeWidth, $resizeHeight)
{
    // $resizeWidth = 100;
    // $resizeHeight = 100;
    $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
    imagecopyresampled($imageLayer, $resourceType, 0, 0, 0, 0, $resizeWidth, $resizeHeight, $image_width, $image_height);
    return $imageLayer;
}


    $imageProcess = 0;
    if (is_array($_FILES))
    {
        $new_width = 540;
        $new_height = 540;
        $fileName = $_FILES['myFile']['tmp_name'];
        $sourceProperties = getimagesize($fileName);
        $resizeFileName = $_FILES['myFile']['name'];
        $uploadPath = "uploads/";
        $fileExt = pathinfo($_FILES['myFile']['name'], PATHINFO_EXTENSION);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];
        switch ($uploadImageType)
        {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight, $new_width, $new_height);
                imagejpeg($imageLayer, $uploadPath . $resizeFileName);
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

    if ($imageProcess == 1)
    {}

?>