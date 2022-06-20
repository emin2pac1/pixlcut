<?php
require_once('common/header.php');
require_once('common/init.php');

if($get_post == 'POST'){

    $wm_text = $_POST['wmtext'];
    move_uploaded_file($ftmp, UPL_PATH. '/'.$fname);
	$fpath = UPL_PATH. '/'.$fname;
    $original = $fpath;

    //stop rewind
    $outputFile = $image = $original;
    $exif = exif_read_data($image);
    $img_ort = $exif['Orientation'];
    // handle incorrect orientation exif metadata
    if (!empty($img_ort)) {
        switch ($img_ort) {
            case 3:
                $angle = 180;
                break;
            case 6:
                $angle = -90;
                $fnt_size*=3;
                break;
            case 8:
                $angle = 90;
                break;
            default:
                $angle = null;
        }
    }
    
    switch ($ftype) {
        case 'image/jpeg':
            // If necessary, rotate the image
            if (!is_null($angle)) {
                $original = imagecreatefromjpeg($image);
                $rotated = imagerotate($original, $angle, 0);
                imagejpeg($rotated, $outputFile, 100);
                imagedestroy($original);
                imagedestroy($rotated);
            }
            $resource = imagecreatefromjpeg($original);
            break;

        case 'image/png':
            if (!is_null($angle)) {
                $original = imagecreatefrompng($image);
                $rotated = imagerotate($original, $angle, 0);
                imagepng($rotated, $outputFile, 100);
                imagedestroy($original);
                imagedestroy($rotated);
            }

            $resource = imagecreatefrompng($original);
            break;

        case 'image/bmp':
            if (!is_null($angle)) {
                $original = imagecreatefrombmp($image);
                $rotated = imagerotate($original, $angle, 0);
                imagebmp($rotated, $outputFile, 100);
                imagedestroy($original);
                imagedestroy($rotated);
            }

            $resource = imagecreatefrombmp($original);
            break;
        
    }

    $img_width = imagesx($resource);
    $img_height = imagesy($resource);

    //count number of words >1 and deduct from font size to center text
    
    $word_num = str_word_count($wm_text);

    $markW = ($fnt_size * strlen($wm_text)) - $fnt_size * ($word_num -1);
    $markH = $img_height * 0.12; //12% of image height
    $center_y = $markH /1.5;
    $center_x = $word_num -1 > 1 ? ($fnt_size * 0.5) * ($word_num -1) : $fnt_size * 0.5; 

    // Create resource for text watermark
    $watermark = imagecreatetruecolor($markW, $markH);

    //fill resource with solid color
    imagefilledrectangle($watermark, 0, 0, $markW, $markH, 0x000000);

    // Add the text
    imagettftext($watermark, $fnt_size, 0, $center_x, $center_y, 0xFFFFFF, FNT_PATH, $wm_text); //ideal parameters

    // Merge text watermark into uploaded image resource
    imagecopymerge($resource, $watermark, $img_width - $markW - $margin_right, $img_height - $markH - $margin_bottom, 0, 0, $markW, $markH, 50);
    $path_string = PCD_PATH . '/'.$wm_text.'_'.uniqid('marked').'.png';
    imagepng($resource,$path_string, 9);

    // clean up & deliver
    imagedestroy($resource);
    imagedestroy($watermark);
    $file_url = basename($path_string);
   	header('Location: success.php?file='.$file_url); //job done, go to download page
}
require_once('common/form_header.php');

//HTML
?>
<!-- Page-specific HTML Starts -->
<div class="row d-flex justify-content-center g-2" style="margin-bottom:2%">

    <div class="col-md-3">

    <div class="form-floating">
             <input type="text" class="form-control" id="floatingWatermarkText" placeholder="Watermark Text" value="" name="wmtext" aria-describedby="typeHelp">
 				<label for="floatingWatermarkText">Enter Watermark Text</label>
                 <small id="typeHelp" class="form-text text-muted">For better image quality, output will be of PNG type </small>


    </div>
</div>

</div>
<?php
require_once('common/form_footer.php');
require_once('common/footer.php');
?>