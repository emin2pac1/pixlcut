<?php require_once('common/header.php') ?>
       <!-- Page Content-->
        <div class="container px-4 px-lg-5">
            <!-- Heading Row-->
            <div class="row gx-4 gx-lg-5 align-items-center my-5">
                <div class="col-lg-5">
                    <h1 class="font-weight-light">All the Pixel fun, in a couple of clicks</h1>
                    <p>PixlCut makes common image manipulation forms a breeze to do! </p>
                    <a class="btn btn-primary home-btn-act" href="#units">Give it a try</a>
                </div>
                <div class="col-lg-7"><img class="img-fluid rounded mb-4 mb-lg-0" src="common/img/hero.jpg" alt="..." height="400" width="600" /></div>
            </div>
            <!-- Call to Action-->
            <div class="card text-white bg-secondary my-5 py-4 text-center">
                <div class="card-body"><p class="text-white m-0">Easy as pie! Just choose what you want to do</p></div>
            </div>
            <!-- Content Row-->
                <div class="col-md-12 mb-5 text-center" id="units">
                    <div class="card h-100">
                        <div class="card-body">
                            <h2 class="card-title"> PixlCut Operations</h2>
                            <div class="container">
                              <div class="row">
                                <p>Choose one</p>
                                <div class="btn-space">
                                <a href="cvrt.php" class="btn btn-primary btn-space home-btn">Convert Image Filetype</a>
                                <a href="wmark.php" class="btn btn-danger btn-space home-btn">Watermark Image</a>
                                <a href="rotate.php" class="btn btn-warning btn-space home-btn">Rotate Image</a>
                                <a href="scale.php" class="btn btn-warning btn-space home-btn">Scale Image</a>

                                </div>
                                  </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
                    </div>
                    <?php require_once('common/footer.php') ?>
