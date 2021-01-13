<?php
    include 'includes/db.php';
    include 'includes/functions.php';
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

      .star-half{
        color: #fbc02d;
      }

      .star-active:hover,
      .star-half:hover{
        color: #f9a825;
        cursor: pointer;
      }

      .star-inactive {
        color: #cfd8dc;
      }

      .effect:hover{
        box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
        -webkit-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
        -moz-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
        transition: box-shadow 0.2s ease-in-out;
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


<!-- Top Agencies according to Ratings -->
<?php
    $stmt = $pdo->prepare('SELECT agency_id, avg(rating) AS avg_rate FROM reviews WHERE review_status = :review_status GROUP BY agency_id ORDER BY avg(rating) DESC LIMIT 9');
    $stmt->execute([':review_status' => 'published']);
    $top_agencies = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $top_agencies[] = $row;
    }
?>

<div class="container">
    <h3 class="text-center my-5 pt-5">Top Agencies</h3>
    <div class="row">

    <?php
      if(empty($top_agencies)){
        echo '<h1 class="text-center pt-4 mx-auto">No Agency Found</h1>';
      }else{
        foreach($top_agencies as $top_agency){
          $agency = readAgency($top_agency['agency_id']);

    ?>

      <div class="col-sm-4">
        <div class="card mb-5 mt-2 effect">
          <div>
            <a href="agency.php?agency_id=<?php echo $top_agency['agency_id']; ?>">
            <img src="images/<?php echo $agency['logo_image']; ?>" class="card-img-top" height="240" alt="<?php echo $agency['agency_name']; ?>"></a>
          </div>
          <div class="card-body">
            <div class="card-text">
              <h5 class="font-weight-italic text-muted" style="font-size: .8rem;"><i class="fas fa-map-marker-alt"></i> <?php echo $agency['agency_address']; ?></h5>
              <h5><a href="agency.php?agency_id=<?php echo $top_agency['agency_id']; ?>"><?php echo $agency['agency_name']; ?></a></h5>
              <p class="lead" style="font-size: 1rem;">
                  <span class="text-dark font-weight-bold mr-3"><?php echo number_format((float)$top_agency['avg_rate'], 1, '.', ''); ?></span>
                  <?php
                      $starActive = round($top_agency['avg_rate'], 0, PHP_ROUND_HALF_DOWN);
                      $starInactive = 5 - round($top_agency['avg_rate'], 0, PHP_ROUND_HALF_UP);
                      $starHalf = 5 - ($starActive + $starInactive);

                      for($i=0; $i<$starActive; $i++){
                          echo '<span class="fa fa-star star-active mx-1"></span>';
                      }
                      for($i=0; $i<$starHalf; $i++){
                          echo '<span class="fas fa-star-half-alt star-half mx-1"></span>';
                      }
                      for($i=0; $i<$starInactive; $i++){
                          echo '<span class="fa fa-star star-inactive mx-1"></span>';
                      }
                  ?>
              </p>
              <div style="font-size: .8rem;">
                <p><span class="mr-2"><i class="fas fa-envelope"></i></span> Email: <?php echo $agency['agency_email']; ?></p>
                <!-- <p><span class="mr-2"><i class="fas fa-phone-alt"></i></span> 017895235</p> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php
        }
      }
      ?>

    </div>
</div>

<footer class='text-center mt-5 p-1' style="background: #E9EAEC;">
  <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>