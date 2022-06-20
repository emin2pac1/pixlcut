<?php
require_once('common/header.php');
require_once('common/init.php');
/**
 * Convert image and destroy resource 
 * get correct imagecreate variant
 * get correct imageformat variant
 */

if($get_post == 'POST'){
	move_uploaded_file($ftmp, UPL_PATH. '/'.$fname);
	$fpath = UPL_PATH. '/'.$fname;
	$form_type = $_POST['type'] ?? '';
    $form_quality = $qualities [$_POST['quality']] ?? '';
    //php version exception for imagebmp, compression is bool since 8.0.0
    if (PHP_VERSION_ID >= 80000) 
    $bmp_compressed = $form_quality == 99 ? false : true;
    else $bmp_compressed = $form_quality / 10;


		switch ($ftype) {
		case 'image/jpeg':
        switch ($form_type) {
            case 'png':
                $resource = imagecreatefromjpeg($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.png';
				$img = imagepng($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;

            case 'bmp':
                $resource = imagecreatefromjpeg($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.bmp';
                $img = imagebmp($resource, $path_string, $bmp_compressed); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;
            
            case 'jpg':
                $resource = imagecreatefromjpeg($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.jpg';
                $img = imagejpeg($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;
            default:
                # code...
                break;
        }
			break;	
		case 'image/png':
		switch ($form_type) {
            case 'png':
                $resource = imagecreatefrompng($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.png';
				$img = imagepng($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;

            case 'jpg':
                $resource = imagecreatefrompng($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.jpg';
                $img = imagejpeg($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;

            case 'bmp':
                $resource = imagecreatefrompng($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.bmp';
                $img = imagebmp($resource, $path_string, $bmp_compressed); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;
            default:
                # code...
                break;
        }		
            break;
		case 'image/bmp':
		switch ($form_type) {
            case 'png':
                $resource = imagecreatefrombmp($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.png';
				$img = imagepng($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;

            case 'jpg':
                $resource = imagecreatefrombmp($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.jpg';
                $img = imagejpeg($resource, $path_string, $form_quality/10); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;

            case 'bmp':
                $resource = imagecreatefrombmp($fpath);
                $path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('convert_').'.bmp';
                $img = imagepng($resource, $path_string, $bmp_compressed); //create file
                imagedestroy($resource);
                $file_url = basename($path_string);
                break;
            default:
                # code...
                break;
        }		
			break;
		default:
			break;
	}
	header('Location: success.php?file='.$file_url); //job done, go to download page
   }
   //HTML
   require_once('common/form_header.php'); 
   ?>
   <!-- Page-Specific HTML Starts -->
    <div class="row d-flex justify-content-center g-2" style="margin-bottom:5%">
				<div class="col-md-6">

					<div class="form-floating">
						<select class="form-select form-select-sm" id="floatingSelectType" aria-label="Floating label select type" name="type" required>
							<option value="">Choose New Type</option>
							<option value="jpg">JPG/JPEG</option>
							<option value="png">PNG</option>
							<option value="bmp">BMP</option>
						</select>
						<label for="floatingSelectType">Type (Choose current if only adjusting quality)</label>
					</div>
				</div>

                <div class="col-md-6">

					<div class="form-floating">
						<select class="form-select form-select-sm" id="floatingSelectQuality" aria-label="Floating label select quality" name="quality" required>
							<option value="">Choose Quality</option>
							<option value="hi">High</option>
							<option value="md">Standard</option>
							<option value="lw">Low</option>
						</select>
						<label for="floatingSelectQuality">Quality (higher = bigger file size)</label>
					</div>
				</div>
    </div>

   <?php
	 require_once('common/form_footer.php');
     require_once('common/footer.php');
?>