<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'index';
    include 'layouts/header.php';
    include 'layouts/navbar.php';
?>
<head>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Ephesis&display=swap');

      html,
      body {
        height: 100%;
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

      /* Video Background */
      .video-background {
        position: fixed;
        right: 0;
        bottom: 0;
        width: 100vw;
        height: auto;
      }

      video {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .video-overlay {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        width: 100vw;
        background-color: rgba(0, 0, 0, 0.6);
      }

      .content-container {
        min-width: 580px;
        min-height: 304px;
        color: black;
        margin: 0 auto;
        padding: 25px 50px;
        border-radius: 5px;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.85);
      }

      .input-container {
        position: relative;
        top: 80px;
      }

      h1{
        font-size: 70px;
        font-family: 'Ephesis', cursive;
        text-align: center;
        margin-top: 20px;
        margin-bottom: 20px;
        letter-spacing: 3px;
        /* text-transform: uppercase; */
        font-weight: 600;
      }

      .quote{
        font-size: 20px;
        color: #000;
        font-weight: 700;
      }

      h3{
        font-size: 30px;
        text-align: center;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #000;
        position: relative; 
        z-index: 2;
        margin: 50px auto;
      }

      @media screen and (max-width: 600px) {
      .video-background {
        height: 100vh;
        width: 100vw;
      }
      
      video {
        object-fit: cover;
        object-position: 70%;
        margin-top: -1px;
      }

      .content-container {
        min-width: unset;
        width: 95vw;
        min-height: 245px;
        padding: 20px;
        margin: 10px;
      }

      .input-container {
        top: unset;
      }

      h1 {
        font-size: 40px;
      }

      .quote{
        font-size: 15px;
      }

      h3{
        font-size: 25px;
      }

    }


    </style>
      
</head>

<br><br><br>

<!-- Video Background  -->

<div class="container my-5">
  <video class="video-background" loop muted autoplay>
    <source src="videos/Dubrovnik.mp4">
  </video>
  <div class="video-overlay"></div>

  <div class="content-container my-5">
    <!-- Input Container  -->
    <div class="input-container" id="input-container">
        <h1 class="mb-5 text-white" data-aos="fade-up">Welcome To Tourville </h1>
        <div class="quote" data-aos="fade-right" data-aos-delay="600">
          <p class='text-muted'>The world is a book and those who do not travel read only one page..</p>
          <footer class="blockquote-footer  text-center">Saint Augustine</footer>
        </div>
        <form action="search.php" method="post" class="input-group mt-5" data-aos="fade-right" data-aos-delay="800">
          <input type="text" name="search" id="" placeholder="Search" class="form-control col-sm-6 ml-auto" style="border-top-right-radius: 3px;  border-bottom-right-radius: 3px;">
          <button class="btn btn-success ml-1 p-2 mr-auto" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
  </div>
</div>

<!-- Top Agencies according to Ratings -->
<?php
    $stmt = $pdo->prepare('SELECT agency_id, avg(rating) AS avg_rate FROM reviews WHERE review_status = :review_status GROUP BY agency_id ORDER BY avg(rating) DESC LIMIT 9');
    $stmt->execute([':review_status' => 'published']);
    $top_agencies = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $top_agencies[] = $row;
    }
?>

<br><br><br><br><br><br>
<div class="container mt-5">
    <h3 class="text-center text-white pt-5">Top Agencies</h3>
    <div class="row">

    <?php
      if(empty($top_agencies)){
        echo '<h2 class="text-center pt-4 mx-auto">No Agency Found</h2>';
      }else{
        foreach($top_agencies as $top_agency){
          $agency = readAgency($top_agency['agency_id']);

    ?>

      <div class="col-sm-4" data-aos="fade-up">
        <div class="card mb-5 mt-2 effect" data-tilt>
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

<footer class='text-center mt-5 p-1' style="background: #343A40; position: relative; z-index: 2;">
  <p class="text-white text-center pt-2">tourism@tourville &copy;2020</p>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tilt.js/1.2.1/tilt.jquery.min.js" integrity="sha512-u1L7Dp3BKUP3gijgSRoMTNxmDl/5o+XOHupwwa7jsI1rMzHrllSLKsGOfqjYl8vrEG+8ghnRPNA/SCltmJCZpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<?php
    include 'layouts/footer.php';
?>