<div class="container center" <?php echo $get_post == 'POST' ? "style='display:none'" : "style=''" ?>>
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	
	<form name="upload" method="post" action="" enctype="multipart/form-data" accept-charset="utf-8" id="uplform">
		<div class="row">
			<div class="col-md-6 col-md-offset-3 center">
				<div class="btn-container">
					<!--the three icons: default, ok file (img), error file (not an img)-->
					<h1 class="imgupload"><i class="fa fa-file-image-o"></i></h1>
					<h1 class="imgupload ok"><i class="fa fa-check"></i></h1>
					<h1 class="imgupload stop"><i class="fa fa-times"></i></h1>
					<!--this field changes dinamically displaying the filename we are trying to upload-->
					<p id="namefile">Accepted Formats (jpg,jpeg,bmp,png)</p>
					<!--our custom btn which which stays under the actual one-->
					<button type="button" id="btnup" class="btn btn-primary btn-lg">Upload Image</button>
					<!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
					<input type="file" value="" name="fileup" id="fileup" class="btn btn-primary btn-lg" style="z-index:99">
				</div>
			</div>
		</div> 
		<!-- Form -> here is fixed -->