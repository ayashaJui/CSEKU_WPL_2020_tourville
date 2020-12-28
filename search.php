<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    //Package Search Query..
    if(isset($_POST['submit'])){
        $search = $_POST['search'];

        if(empty($search)){
            header('Location: index.php');
            return;
        }

        $stmt = $pdo->prepare('SELECT * FROM packages WHERE location LIKE :search OR country LIKE :search AND package_status = :package_status');
        $stmt->execute([':search'=> "%". $search ."%",
                        ':package_status' => 'available']);
        $package_count = $stmt->rowCount();
        $packages = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $packages[] = $row;
        }

        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_address LIKE :search AND agency_status = :agency_status');
        $stmt->execute([':search'=> "%". $search ."%",
                        ':agency_status' => 'approved']);
        $agency_count = $stmt->rowCount();
        $agencies = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agencies[] = $row;
        }
    }
    

?>

<head>
    <style>
        .package {
            background-image: url("images/view/package.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 50vh;
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

        .stat{
            background: #EAE8FF;
            font-size: .9rem;
            font-weight: 500;
            border: 2px solid #85998A;
        }

    </style>
</head>

<br><br><br>
<div class="jumbotron jumbotron-fluid package">
  <div class="container">
    <h1 class="display-4 text-primary font-weight-bold">Search Result</h1>
    <p class="lead">
        <form action="search.php" method="post" class="input-group">
            <input type="text" name="search" value="<?php echo $search; ?>" id="" placeholder="Search" class="form-control col-md-4">
            <button class="btn btn-outline-success ml-2 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>
    </p>
  </div>
</div>

<?php
    if(empty($packages)){
        echo '<h1 class="text-center pt-4">No Package Found</h1>';
    }else {
        
?>

<div class="container">
    <div class="card mb-3" style="border: none;" >
    
<?php
    
    echo '<h1 class="py-4 text-muted font-italic">Package Found: '. $package_count .'</h1>';
    foreach($packages as $package){
        echo '<div class="row no-gutters">';
            echo '<div class="col-md-4">';

                //get single image from database to show 
                $place_img = getSingleImage($package['package_id']);

                echo '<a href="package.php?package_id='. $package['package_id'] .'"><img src="images/packages/'. $place_img .'" class="card-img" height="200" alt="'. $package['package_name'] .'"></a>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo '<div class="card-body pt-0">';
                    echo '<div>';
                    
                        //read package date data
                        $date = readPackageDates($package['package_id']);

                        echo  '<h4 class="card-title mt-2">'. $package['package_name'] .'';
                        if(!empty($date) && $date['status'] == 'booking off'){
                            echo '<span class="badge rounded-pill ml-2 stat">'. ucwords($date['status']) .'</span>';
                        }
                        echo '</h4>';
                        echo '<h5 class="font-italic text-info" style="font-size: .85rem;"><span class="mr-1"><i class="fas fa-map-marker-alt"></i></span>'. $package['location'] .', '. $package['country'] .'</h5>';
                        echo '<div class="" style="font-size: .85rem;">
                                <p class="text-muted pt-2"><span class="mr-1" ><i class="far fa-clock"></i></span>'. $package['num_days'] .' days '. $package['num_nights'] .' nights</p>';
                    echo '</div></div>';
                    echo '<p class="card-text mb-3" style="font-size: .7rem;">'. substr($package['place_details'], 0, 40) .'...</p><hr>';
                    echo '<div>';
                        echo '<p class="text-muted" >
                                <h5>BDT '. $package['budget_price'] .' /-</h5>
                                <a href="package.php?package_id='. $package['package_id'] .'" class="btn btn-primary float-right" style="position: relative; top: -30px; font-size: .8rem;">View<span class=" ml-2"><i class="fas fa-angle-right"></i></span></a>
                            </p>';
                    echo '</div>';
                echo '</div></div></div>';
    }
?>
    </div>
</div>

<?php
    }

    echo '<hr>';
    if(empty($agencies)){
        echo '<h1 class="text-center pt-4">No Agency Found</h1>';
    }else{
?>

<div class="container">
    <h1 class="py-4 text-muted font-italic">Agency Found: <?php echo $agency_count; ?></h1>
    <div class="row">

<?php

    foreach($agencies as $agency){
        echo '<div class="col-sm-6">';
        echo '<div class="card mb-3">';
            echo '<div class="row no-gutters">';
            echo '<div class="col-md-4">';
                echo '<a href="agency.php?agency_id='. $agency['agency_id'] .'"><img src="images/'. $agency['logo_image'] .'" class="card-img" height="180" alt="'. $agency['agency_name'] .'"></a>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                echo '<div>';
                    echo '<h5 class="card-title">'. $agency['agency_name'] .'</h5>';
                    echo '<p class="my-1" style="font-size: .8rem;">
                            <span class="text-muted mr-3">4.0</span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-inactive"></span>
                        </p>';
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