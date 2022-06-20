<?php
//define paths
#UPL: uploads dir
#PCD: processed dir
define('UPL_PATH','uploads');
define('WM_PATH','uploads\watermarks');
define('PCD_PATH','processed');
define('FNT_PATH','common\fonts\font.ttf');

$qualities = [
	'hi' => 99,
	'md' => 75,
	'lw' => 50
];
if($get_post == 'POST'){
$fname = $_FILES['fileup']['name'] ?? '';
$ftype = $_FILES['fileup']['type'] ?? '';
$fsize= $_FILES['fileup']['size'] ?? '';
$ftmp = $_FILES['fileup']['tmp_name'] ?? '';
}
//accepted image types
$good_mimes = [
	'jpeg',
	'png',
	'bmp',
	'jpg'
];

$fnt_size = 30;
?>