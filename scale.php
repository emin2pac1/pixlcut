<?php
require_once('common/header.php');
require_once('common/init.php');
//size presets
$sizes = [
	'xsm' => 150,
    'sm' => 300,
    'md' => 600,
    'lg' => 900,
    'xlg' => 1280
];

if($get_post == 'POST'){
	move_uploaded_file($ftmp, UPL_PATH. '/'.$fname);
	$fpath = UPL_PATH. '/'.$fname;
	$form_width = $sizes[$_POST['size']] ?? '';
	$form_c_width = $_POST['cwsize'] ?? '';
	$form_c_height = $_POST['chsize'] ?? '';
	if(is_numeric($form_c_width) && is_numeric($form_c_height)){
	settype($form_c_width,'int');
	settype($form_c_height,'int');
	}
	$form_quality = $qualities [$_POST['quality']] ?? '';
	//php version exception for imagebmp
	if (PHP_VERSION_ID >= 80000) 
	$bmp_compressed = $form_quality == 99 ? false : true;
	else $bmp_compressed = $form_quality / 10;


		switch ($ftype) {
		case 'image/jpeg':
				# resource and file creation
				$img = imagecreatefromjpeg($fpath);
				$img_width =imagesx($img);
				$img_height =imagesy($img);
				$scale = is_numeric($form_c_width) ? imagescale($img, $form_c_width, $form_c_height) : imagescale($img, $form_width); // only width given, aspect ratio preserved, final argument is scale algo
				//get path string for easier output file access 
				$path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('scaled_'.$form_width.'px_').'.jpg';
				$scaled_img = imagejpeg($scale, $path_string, $form_quality); //create file
				imagedestroy($img);
				imagedestroy($scale);
				$file_url = basename($path_string);
				break;

			case 'image/png':
				# resource and file creation
				$img = imagecreatefrompng($fpath);
				$img_width =imagesx($img);
				$img_height =imagesy($img);
				$scale = is_numeric($form_c_width) ? imagescale($img, $form_c_width, $form_c_height) : imagescale($img, $form_width); // only width given, aspect ratio preserved, final argument is scale algo
				//get path string for easier output file access 
				$path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('scaled_'.$form_width.'px_').'.png';
				$scaled_img = imagepng($scale, $path_string, $form_quality/10); //create file
				imagedestroy($img);
				imagedestroy($scale);
				$file_url = basename($path_string);
				break;

				case 'image/bmp':
				# resource and file creation
				$img = imagecreatefrombmp($fpath);
				$img_width =imagesx($img);
				$img_height =imagesy($img);
				$scale = is_numeric($form_c_width) ? imagescale($img, $form_c_width, $form_c_height) : imagescale($img, $form_width);// only width given, aspect ratio preserved, final argument is scale algo
				//get path string for easier output file access 
				$path_string = PCD_PATH . '/'.$form_quality.'q_'.uniqid('scaled_'.$form_width.'px_').'.bmp';
				$scaled_img = imagebmp($scale, $path_string, $bmp_compressed); //create file
				imagedestroy($img);
				imagedestroy($scale);
				$file_url = basename($path_string);
				break;
		default:
			# code...
			break;
	}
	header('Location: success.php?file='.$file_url); //job done, go to download page
   }
   



// HTML 
?>
			<?php require_once('common/form_header.php') ?>
			<!--size & quality-->
			<div class="row d-flex justify-content-center g-2" style="margin-bottom:3%">
				<div class="col-md-3">

					<div class="form-floating">
						<select class="form-select form-select-sm visibiliity-control" id="floatingSelectSize" aria-label="Floating label select size" name="size">
							<option value="">Choose Preset</option>
							<option value="xsm">Very Small - 150px Width</option>
							<option value="sm">Small - 300px Width</option>
							<option value="md">Medium - 600px Width</option>
							<option value="lg">Large - 750px Width</option>
							<option value="xlg">Very Large - 1280px Width</option>
							<option value="4">Choose Custom Width & Height</option>
						</select>
						<label for="floatingSelect">Size Preset (Preserves Aspect Ratio)</label>
					</div>
				</div>

				<div class="col-md-3">
					
				<div class="form-floating">
						<select class="form-select form-select-sm" id="floatingSelect2" aria-label="Floating label select quality" name="quality">
							<option value="">Choose Quality</option>
							<option value="hi">High</option>
							<option value="md">Standard</option>
							<option value="lw">Low</option>
						</select>
						<label for="floatingSelect">Quality (higher = bigger file size)</label>
					</div>

				</div>
			</div>

							<!-- Custom Dimensions start -->

							<div class="row d-flex justify-content-center g-2" style="margin-bottom:5%">

								<div class="col-md-3 custom-size">
									<div class="form-floating">

										<input type="number" class="form-control" id="floatingCustomWidth" placeholder="Custom Width" value="" name="cwsize">
										<label for="floatingInputWidth">Width</label>

									</div>
								</div>

								<!-- Height Starts -->

								<!-- By Image -->

								<div class="col-md-1 custom-size">

								<img src="common/img/by.png" height="50" width="50">

								</div>

								<!-- Ends -->
   								
								<div class="col-md-3 custom-size">
									<div class="form-floating">

										<input type="number" class="form-control" id="floatingCustomHeight" placeholder="Custom Height" value="" name="chsize">
										<label for="floatingInputHeight">Height</label>

									</div>
								</div>

								</div>

			<?php require_once('common/form_footer.php') ?>
<script>
	$(document).ready(function(){
		new ConditionalField({
		control: '.visibiliity-control',
		visibility: {
			'4': '.custom-size'
		
		}
	});

		//validate form
		$("#uplform").validate({
				rules: {
				cwsize: {
				required: {
				depends: function(elem) {
				return $("#floatingSelectSize").val() == 4
				}
				}
				},

				chsize: {
				required: {
				depends: function(elem) {
				return $("#floatingSelectSize").val() == 4
				}
				}
				},

				quality:{
					required:true
				},

				size:{
					required:true
				}

				}

				});
});

</script>

<?php
require_once('common/footer.php');
?>