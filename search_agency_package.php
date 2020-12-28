<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    //Package Search Query..
    if(isset($_POST['submit'])){
        $search     = $_POST['search'];
        $agency_id  = $_GET['agency_id'];

        if(empty($search)){
            header('Location: index.php');
            return;
        }
        $stmt = $pdo->prepare('SELECT * FROM packages WHERE agency_id = :agency_id AND (location LIKE :search OR country LIKE :search OR place_details LIKE :search OR num_days LIKE :search OR num_nights LIKE :search OR budget_price LIKE :search) AND package_status = :package_status');
        $stmt->execute([':agency_id'        => $agency_id,
                        ':search'           => "%". $search ."%",
                        ':package_status'   => 'available']);
        $package_count = $stmt->rowCount();
        $packages = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $packages[] = $row;
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
    <h1 class="display-4 text-primary font-weight-bold">Search Result: <?php echo $package_count; ?></h1>
    <p class="lead">
        
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
?>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>