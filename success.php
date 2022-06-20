<?php
require_once('common/header.php');
require_once('common/init.php');
//presence & type validations
$fid = $_GET['file'];
$furl = PCD_PATH.'/'.$fid;
$mime = pathinfo($furl, PATHINFO_EXTENSION);
if(!$fid || !file_exists($furl) || !in_array($mime,$good_mimes)) // handle bad request, blanket solution
header('Location: index.php'); //ideally 404/bad request page
?>
<div class="jumbotron text-center" style="margin-top:10%">
  <h1 class="display-3">Smell Something Fresh?</h1>
  <h3 class="display-5">its your new image!</h3>
  <button class="btn btn-primary btn-lg" style="margin-top:1.5%"><a href="<?php echo $furl ?>" style="color: white; text-decoration: none" download>Download</a></button> 
 <hr>
  <p>
    Having trouble? <a href="mailto:promomegm@gmail.com">E-mail me</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="index.php" role="button">Back to homepage</a>
  </p>
</div>
<?php require_once('common/footer.php') ?>