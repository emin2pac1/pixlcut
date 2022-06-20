<?php
require_once('common/header.php');
require_once('common/init.php');

if($get_post == 'POST'){
    $degrees = $_POST['degree'] ?? '';
    settype($degrees,'int');
    move_uploaded_file($ftmp, UPL_PATH. '/'.$fname);
	$fpath = UPL_PATH. '/'.$fname;
    
    switch ($ftype) {
        case 'image/jpeg':
            // Load
            $source = imagecreatefromjpeg($fpath); //switch

            // Rotate
            $rotate = imagerotate($source, $degrees, 0);
            //path
            $path_string = PCD_PATH . '/'.$degrees.'d_'.uniqid('rotated_').'.jpg';

            // Output
            imagejpeg($rotate, $path_string,9); //switch

            // Free the memory
            imagedestroy($source);
            imagedestroy($rotate);
            $file_url = basename($path_string);

            break;

        case 'image/png':
            // Load
            $source = imagecreatefrompng($fpath); //switch

            // Rotate
            $rotate = imagerotate($source, $degrees, 0);

            //path
            $path_string = PCD_PATH . '/'.$degrees.'d_'.uniqid('rotated_').'.png';


            // Output
            
            imagepng($rotate, $path_string,9); //switch

            // Free the memory
            imagedestroy($source);
            imagedestroy($rotate);
            $file_url = basename($path_string);

            break;

        case 'image/bmp':
            // Load
            $source = imagecreatefrombmp($fpath); //switch

            // Rotate
            $rotate = imagerotate($source, $degrees, 0);

            //path
            $path_string = PCD_PATH . '/'.$degrees.'d_'.uniqid('rotated_').'.bmp';

            // Output
            imagebmp($rotate, $path_string,false); //switch

            // Free the memory
            imagedestroy($source);
            imagedestroy($rotate);
            $file_url = basename($path_string);

            break;

        default:
    
            break;
    }

    
   	header('Location: success.php?file='.$file_url); //job done, go to download page
}
require_once('common/form_header.php');

//HTML
?>
<!-- Page-specific HTML Starts -->
<!--  row for selecting degree -->
<div class="row d-flex justify-content-center g-2" style="margin-bottom:2%">

    <div class="col-md-3">

    <div class="form-floating">
        <select class="form-select form-select-sm" id="floatingSelectDegree" aria-label="Floating label select degree" name="degree" required>
            <option value="">Rotation degree</option>
            <option value="180">Upside Down</option>
            <option value="270">90 Degrees Clockwise</option>
            <option value="90">90 Degrees Counter-Clockwise</option>
        </select>
        <label for="floatingSelectdegree">Degree</label>
    </div>
</div>

</div>
<?php
require_once('common/form_footer.php');
require_once('common/footer.php');
?>