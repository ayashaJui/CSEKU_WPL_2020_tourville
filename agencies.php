<?php
    include 'includes/db.php';
    $page = 'agencies';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

?>
<head>
    <style>
      .agency {
        background-image: url("images/view/agency.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        height: 50vh;
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
<div class="jumbotron jumbotron-fluid agency">
  <div class="container">
    <h2 class="display-4 font-weight-bold">Agency List</h2>
    <p class="lead">
      <form action="search.php" method="post" class="input-group">
            <input type="text" name="search" id="" placeholder="Search" class="form-control col-md-4">
            <button class="btn btn-outline-success ml-2 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>
    </p>
  </div>
</div>

<?php
  
  //Agency Read Query ... approved agency
  $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_status = :agency_status');
  $stmt->execute([':agency_status' => 'approved']);
  $agencies = [];
  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $agencies[] = $row;
  }

  if(empty($agencies)){
    echo '<h1 class="text-center pt-4">No Agency Found</h1>';
  }else{
?>

<div class="container">
  <div class="row">

<?php
  foreach($agencies as $agency){
    echo '<div class="col-sm-6">';
      echo '<div class="card mb-3 effect">';
        echo '<div class="row no-gutters">';
          echo '<div class="col-md-4">';
            echo '<a href="agency.php?agency_id='. $agency['agency_id'] .'"><img src="images/'. $agency['logo_image'] .'" class="card-img" height="180" alt="'. $agency['agency_name'] .'"></a>';
          echo '</div>';
          echo '<div class="col-md-8">';
            echo '<div class="card-body">';
              echo '<div>';
                echo '<h5 class="card-title">'. $agency['agency_name'] .'</h5>';

                //Avg rating
                $stmt = $pdo->prepare('SELECT avg(rating) AS avg_rate FROM reviews WHERE agency_id = :agency_id AND review_status = :review_status');
                $stmt->execute([':agency_id'      => $agency['agency_id'],
                                ':review_status'  => 'published']);
                $avg_rate = $stmt->fetch(PDO::FETCH_ASSOC);
                echo '<p class="my-1" style="font-size: .8rem;">
                        <span class="text-dark mr-3">'. number_format((float)$avg_rate['avg_rate'], 1, '.', '') .'</span>';
                        $starActive = round($avg_rate['avg_rate'], 0, PHP_ROUND_HALF_DOWN);
                        $starInactive = 5 - round($avg_rate['avg_rate'], 0, PHP_ROUND_HALF_UP);
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
                echo  '</p>';
              echo '</div>';
              echo '<p class="card-text"  style="font-size: 1rem;"><span class="mr-2"><i class="fas fa-map-marker-alt"></i></span>'. $agency['agency_address'] .'</p>';
              echo '<div>';
                echo '<p class="text-muted mb-0">
                        <a href="agency.php?agency_id='. $agency['agency_id'] .'" class="btn btn-primary"  style="font-size: .8rem;">View Details<span class=" ml-2"><i class="fas fa-angle-right"></i></span></a>
                      </p>';
              echo '</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    echo '</div>';
  }
?>
    </div>
</div>

<?php
  }
?>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
  include 'layouts/footer.php';
?>