<?php
    include 'includes/db.php';
    $page = 'index';
    include 'layouts/header.php';
    include 'layouts/navbar.php';
?>
<head>
    <style>
      html,
      body,
      .view {
        height: 100%;
      }

      .carousel,
      .carousel-item,
      .carousel-item.active {
        height: 86vh;
      }
      .carousel-inner {
        height: 100%;
      }
      .carousel-item:nth-child(1) {
        background-image: url("images/view/carousel1.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }
      .carousel-item:nth-child(2) {
        background-image: url("images/view/carousel2.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }
      .carousel-item:nth-child(3) {
        background-image: url("images/view/carousel3.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
      }
      .star-active {
        color: #fbc02d;
      }
      .star-active:hover {
        color: #f9a825;
        cursor: pointer;
      }
      .star-inactive {
        color: #cfd8dc;
      }
    </style>
      
</head>

<br><br><br>
<!--Carousel Wrapper-->
  <div id="carousel-example-1" class="carousel slide carousel-fade mb-5" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-1" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-1" data-slide-to="1"></li>
      <li data-target="#carousel-example-1" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner"  role="listbox">
      <!--First slide-->
      <div class="carousel-item active">
        <!--Mask-->
        <div class="view">
          <div class="full-bg-img flex-center mask rgba-indigo-light white-text">
            <ul class="animated fadeInUp col-md-12 list-unstyled list-inline"> 
              <li class="p-1">
                <blockquote class="blockquote font-weight-bold text-uppercase py-4 ml-5">
                    <p>The world is a book <br> and those who do not travel read only one page..</p>
                    <footer class="blockquote-footer">Saint Augustine</footer>
                </blockquote>
              </li>
              <li>
                <form action="search.php" method="post" class="input-group">
                  <input type="text" name="search" id="" placeholder="Search" class="form-control col-md-4 ml-5">
                  <!-- <select name="search_by" id="" class="custom-select col-sm-1 mx-1">
                    <option value="">Select</option>
                    <option value="package">Package</option>
                    <option value="agency">Agency</option>
                  </select> -->
                  <button class="btn btn-outline-success ml-1 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
                </form>
              </li>
            </ul>
          </div>
        </div>
        <!--/.Mask-->
      </div>
      <!--/.First slide-->

      <!--Second slide -->
      <div class="carousel-item">
        <!--Mask-->
        <div class="view">
          <div class="full-bg-img flex-center mask rgba-purple-light white-text">
            <ul class="animated fadeInUp col-md-12 list-unstyled">
              <li>
                <blockquote class="blockquote font-weight-bold text-uppercase py-4 ml-5">
                    <p>Travel opens your heart, broadens your mind <br> and fills your life with stories to tell..</p>
                </blockquote>
              </li>
            </ul>
          </div>
        </div>
        <!--/.Mask-->
      </div>
      <!--/.Second slide -->

      <!--Third slide-->
      <div class="carousel-item">
        <!--Mask-->
        <div class="view">
          <div class="full-bg-img flex-center mask rgba-blue-light white-text">
            <ul class="animated fadeInUp col-md-12 list-unstyled">
              <li>
                <blockquote class="blockquote font-weight-bold text-uppercase py-4 ml-5">
                    <p>Traveling leaves you speechless, <br> then it turns you into a storyteller..</p>
                    <footer class="blockquote-footer">Ibn battuta</footer>
                </blockquote>
              </li>
            </ul>
          </div>
        </div>
        <!--/.Mask-->
      </div>
      <!--/.Third slide-->
    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
  </div>
  <!--/.Carousel Wrapper-->

<!-- Trending Packages -->
<div class="container">
  <h3 class="text-center my-5 pt-5">Trending Packages</h3>
  <div class="row">
    <div class="col-sm-4">
      <div class="card mb-5 mt-2">
        <div>
          <a href="package.php?package_id=1">
          <img src="images/packages/astronomy-beautiful-clouds-constellation-355465.jpg" class="card-img-top" alt="..."></a>
          <div class="p-2" style="position: absolute; top: 0;">
            <span class="bg-dark text-white">From BDT 3000/-</span>
          </div>
        </div>
        <div class="card-body">
          <div class="card-text">
            <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> sajek, Bangladesh</h5>
            <h5><a href="package.php?package_id=1">Sajek Tour</a></h5>
            <p class="lead" style="font-size: 1rem;">
                <span class="text-muted mr-3">4.0</span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-inactive"></span>
            </p>
            <p class="text-muted" style="font-size: .8rem;"><span class="mr-1"><i class="far fa-clock"></i></span>4 days 5 nights</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card mb-5 mt-2">
        <div>
          <a href="package.php?package_id=1">
          <img src="images/packages/astronomy-beautiful-clouds-constellation-355465.jpg" class="card-img-top" alt="..."></a>
          <div class="p-2" style="position: absolute; top: 0;">
            <span class="bg-dark text-white">From BDT 3000/-</span>
          </div>
        </div>
        <div class="card-body">
          <div class="card-text">
            <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> sajek, Bangladesh</h5>
            <h5><a href="package.php?package_id=1">Sajek Tour</a></h5>
            <p class="lead" style="font-size: 1rem;">
                <span class="text-muted mr-3">4.0</span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-inactive"></span>
            </p>
            <p class="text-muted" style="font-size: .8rem;"><span class="mr-1"><i class="far fa-clock"></i></span>4 days 5 nights</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card mb-5 mt-2">
        <div>
          <a href="package.php?package_id=1">
          <img src="images/packages/astronomy-beautiful-clouds-constellation-355465.jpg" class="card-img-top" alt="..."></a>
          <div class="p-2" style="position: absolute; top: 0;">
            <span class="bg-dark text-white">From BDT 3000/-</span>
          </div>
        </div>
        <div class="card-body">
          <div class="card-text">
            <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> sajek, Bangladesh</h5>
            <h5><a href="package.php?package_id=1">Sajek Tour</a></h5>
            <p class="lead" style="font-size: 1rem;">
                <span class="text-muted mr-3">4.0</span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-active"></span>
                <span class="fa fa-star star-inactive"></span>
            </p>
            <p class="text-muted" style="font-size: .8rem;"><span class="mr-1"><i class="far fa-clock"></i></span>4 days 5 nights</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<hr>
<!-- Top Packages -->
<div class="container">
    <h3 class="text-center my-5 pt-5">Top Agencies</h3>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mb-5 mt-2">
          <div>
            <a href="agency.php?agency_id=1">
            <img src="images/agency_logo.jpg" class="card-img-top" alt="..."></a>
          </div>
          <div class="card-body">
            <div class="card-text">
              <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> 22, bk street, khulna</h5>
              <h5><a href="package.php?package_id=1">Last Minute Vacation</a></h5>
              <p class="lead" style="font-size: 1rem;">
                  <span class="text-muted mr-3">4.0</span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-inactive"></span>
              </p>
              <div style="font-size: .8rem;">
                <p><span class="mr-2"><i class="fas fa-envelope"></i></span> Email: ryan@gmail.com</p>
                <!-- <p><span class="mr-2"><i class="fas fa-phone-alt"></i></span> 017895235</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mb-5 mt-2">
          <div>
            <a href="agency.php?agency_id=1">
            <img src="images/agency_logo.jpg" class="card-img-top" alt="..."></a>
          </div>
          <div class="card-body">
            <div class="card-text">
              <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> 22, bk street, khulna</h5>
              <h5><a href="package.php?package_id=1">Last Minute Vacation</a></h5>
              <p class="lead" style="font-size: 1rem;">
                  <span class="text-muted mr-3">4.0</span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-inactive"></span>
              </p>
              <div style="font-size: .8rem;">
                <p><span class="mr-2"><i class="fas fa-envelope"></i></span> Email: ryan@gmail.com</p>
                <!-- <p><span class="mr-2"><i class="fas fa-phone-alt"></i></span> 017895235</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mb-5 mt-2">
          <div>
            <a href="agency.php?agency_id=1">
            <img src="images/agency_logo.jpg" class="card-img-top" alt="..."></a>
          </div>
          <div class="card-body">
            <div class="card-text">
              <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> 22, bk street, khulna</h5>
              <h5><a href="package.php?package_id=1">Last Minute Vacation</a></h5>
              <p class="lead" style="font-size: 1rem;">
                  <span class="text-muted mr-3">4.0</span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-active"></span>
                  <span class="fa fa-star star-inactive"></span>
              </p>
              <div style="font-size: .8rem;">
                <p><span class="mr-2"><i class="fas fa-envelope"></i></span> Email: ryan@gmail.com</p>
                <!-- <p><span class="mr-2"><i class="fas fa-phone-alt"></i></span> 017895235</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<footer class='text-center mt-5 p-1' style="background: #E9EAEC;">
  <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>