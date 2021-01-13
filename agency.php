<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'agencies';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(isset($_GET['agency_id'])){
        $agency_id = $_GET['agency_id'];

        $agency = readAgency($agency_id);
    }

?>

<head>
    <script src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/agency.php?agency_id=<?php echo $agency['agency_id']; ?>" />
    
</head>

<br><br><br>
<div class="jumbotron jumbotron-fluid agency">
  <div class="container">
    <h2 class="display-4 font-weight-bold text-info text-center"></h2>
    <p class="lead"></p>
  </div>
  <div>
    <img src="images/<?php echo $agency['logo_image']; ?>" class="rounded mx-auto d-block rounded-circle agency-logo" width="200" height="200" alt="<?php echo $agency['agency_name']; ?>">
  </div>
</div>

<div class="container mt-5">
    <div class="ml-auto p-2 my-5 text-center">
        <h3 class="font-weight-bold pt-4 mt-3"><?php echo $agency['agency_name']; ?></h3>
        <h5 class="font-weight-italic text-info" style="font-size: 1rem;"><i class="fas fa-map-marker-alt"></i> <?php echo $agency['agency_address']; ?></h5>
    </div>

    <!-- subnav -->
    <ul class="nav nav-tabs">
        <li class="nav-item subnav">
            <a class="nav-link active package" href="#">Packages</a>
        </li>
        <li class="nav-item subnav">
            <a class="nav-link reviews" href="#">Reviews</a>
        </li>
        <li class="nav-item subnav">
            <a class="nav-link info" href="#">Info</a>
        </li>
    </ul>
</div>

<?php
    if(isset($_GET['agency_id'])){
        $agency_id = $_GET['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM packages WHERE agency_id = :agency_id AND package_status = :package_status');
        $stmt->execute([':agency_id'        => $agency_id,
                        ':package_status'   => 'available']);
        $packages = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $packages[] = $row;
        }
    }
?>

<!-- Packages -->
<div class="lead container package-content">
    <h5 class="mt-5 pl-3">Packages</h5>

    <div class="container ml-5">
        <form action="search_agency_package.php?agency_id=<?php echo $agency_id; ?>" method="post" class="input-group ml-3 mt-5 float-center">
            <input type="text" name="search" id="" placeholder="Search package" class="form-control col-md-4">
            <button class="btn btn-outline-success ml-1 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

<?php 
    if(empty($packages)){
        echo '<h1 class="text-center pt-4">No Package Found</h1>';
    }else{
?>
    <div class="row">
        <div class="col-sm-12">
        <?php
            foreach($packages as $package){
                //get single image from database to show 
                $place_img = getSingleImage($package['package_id']);
        ?>
            <div class="card m-5 pt-4 px-4 effect pb-0" style="border: none;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="package.php?package_id=<?php echo $package['package_id'] ?>">
                            <img src="images/packages/<?php echo $place_img; ?>" class="card-img" height="200" alt="<?php echo $package['package_name']; ?>">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body pt-0">
                            <h4 class="card-title"><?php echo $package['package_name']; ?>
                            <?php 
                                //read package date data
                                $date = readPackageDates($package['package_id']);
                                if(!empty($date) && $date['status'] == 'booking off'){
                                    echo '<span class="badge rounded-pill ml-1 status">'. ucwords($date['status']) .'</span>';
                                }
                            ?>
                            </h4>
                            <h5 class="font-italic text-info" style="font-size: .85rem;"><span class="mr-1"><i class="fas fa-map-marker-alt"></i></span><?php echo $package['location'] .', '. $package['country']; ?></h5>
                            <div class="" style="font-size: .85rem;">
                                <p class="text-muted pt-2"><span class="mr-1" ><i class="far fa-clock"></i></span><?php echo $package['num_days'] .' days '. $package['num_nights'] .' nights' ?></p>
                            </div>
                            <p class="card-text mb-3" style="font-size: .7rem;"><?php echo substr($package['place_details'], 0, 40); ?>...</p><hr>

                            <div>
                                <p class="text-muted" >
                                    <h5>BDT <?php echo $package['budget_price'] ?> /-</h5>
                                    <a href="package.php?package_id=<?php echo $package['package_id']; ?>" class="btn btn-primary float-right" style="position: relative; top: -30px; font-size: .8rem;">View<span class=" ml-2"><i class="fas fa-angle-right"></i></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
<?php
    }
?>
</div>

<!-- Reviews -->
<?php
    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE agency_id = :agency_id AND review_status = :review_status ORDER BY review_id DESC');
    $stmt->execute([':agency_id'    => $_GET['agency_id'],
                    ':review_status' => 'published']);
    $reviews = [];
    $rates = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $reviews[] = $row;
        $rates[] = $row['rating'];
    }
?>

<div class="container review-content">
    <h5 class="mt-5 pl-3">Ratings & Comments (<?php echo $total_person = $stmt->rowCount(); ?>)</h5>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10 col-12 text-center mb-5">
                <div class="card effect">
                    <div class="row justify-content-left d-flex">
                        <div class="col-md-4 d-flex flex-column">
                            <div class="rating-box">

                            <?php

                                $total_person = sizeof($rates);
                                $total_rate = 0;
                                $rate5 = 0;
                                $rate4 = 0;
                                $rate3 = 0;
                                $rate2 = 0;
                                $rate1 = 0;
                                for($i=0; $i<$total_person; $i++){
                                    $total_rate += $rates[$i];

                                    if($rates[$i] == 5){
                                        $rate5++;
                                    }elseif($rates[$i] == 4){
                                        $rate4++;
                                    }elseif($rates[$i] == 3){
                                        $rate3++;
                                    }elseif($rates[$i] == 2){
                                        $rate2++;
                                    }elseif($rates[$i] == 1){
                                        $rate1++;
                                    }
                                }

                                if($total_person != 0){
                                    $avg_rate = $total_rate / $total_person;
                                }else{
                                    $avg_rate = 0;
                                }
                                
                            ?>

                                <h1 class="pt-4"><?php echo number_format((float)$avg_rate, 1, '.', ''); ?></h1>
                                <p class="">out of 5</p>
                            </div>
                            <div class="my-2">
                            
                            <?php

                                $starActive = round($avg_rate, 0, PHP_ROUND_HALF_DOWN);
                                $starInactive = 5 - round($avg_rate, 0, PHP_ROUND_HALF_UP);
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

                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="rating-bar0 justify-content-center">
                                <table class="text-left mx-auto">
                                    <tr>
                                        <td class="rating-label">Excellent</td>
                                        <td class="rating-bar">
                                            <div class="progress  rounded-pill">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round(($rate5 / $total_person) * 100) ?>%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right"><?php echo $rate5; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Good</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round(($rate4 / $total_person) * 100) ?>%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right"><?php echo $rate4; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Average</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo round(($rate3 / $total_person) * 100) ?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right"><?php echo $rate3; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Poor</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo round(($rate2 / $total_person) * 100) ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right"><?php echo $rate2; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Terrible</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-dark " role="progressbar" style="width: <?php echo round(($rate1 / $total_person) * 100) ?>%" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right"><?php echo $rate1; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- comment -->
        <div class="row">
            <div class="col-sm-8">
            <?php
                if(empty($reviews)){
                    echo '<h1 class="text-center pt-4">No Comments to Show</h1>';
                }else{
                    foreach($reviews as $review){
                        $tourist = readTourist($review['tourist_id']);

                        $profile_img = '';
                        if(!empty($tourist['profile_image'])){
                            $profile_img = $tourist['profile_image'];
                        }else{
                            $profile_img = 'default_user.png';
                        }
            ?>
                <div class="card effect">
                    <div class="row d-flex">
                        <div class=""> <img class="profile-pic" src="images/<?php echo $profile_img; ?>"></div>
                        <div class="d-flex flex-column">
                            <h3 class="mt-2 mb-0"><?php echo ucwords($tourist['tourist_firstname']) .' '. ucwords($tourist['tourist_lastname']); ?></h3>
                            <div>
                                <p class="text-left" style="position: relative; top: 5px; font-size: 1rem;">
                                    <span class="text-dark mr-3"><?php echo $review['rating']; ?></span>

                                    <?php
                                        for($i=0; $i<$review['rating']; $i++){
                                            echo '<span class="fa fa-star star-active"></span>';
                                        }
                                        for($i=0; $i<(5 - $review['rating']); $i++){
                                            echo '<span class="fa fa-star star-inactive"></span>';
                                        }
                                    ?>
                                    
                                </p>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <p class="text-muted pt-5 pt-sm-3"><?php echo $review['review_date'] ?></p>
                        </div>
                    </div>
                    <div class="row text-left">
                        <!-- <h4 class="mt-3">"An awesome place to experience travel"</h4> -->
                        <p class="content mt-2 ml-5 pl-5"><?php echo $review['comment'] ?></p>
                    </div>
                </div>

            <?php
                    }
                }
            ?>

            </div>

            <?php
                if(isset($_POST['post_review'])){
                    $tourist_id = $_SESSION['tourist_id'];
                    $agency_id  = $_GET['agency_id'];
                    $rate       = $_POST['rating'];
                    $comment    = $_POST['comment'];
                    $date       = date("y.m.d");

                    if(empty($rate)){
                        $_SESSION['error'] = "Rating can not be Zero";
                        header('Location: agency.php?agency_id='. $agency_id);
                        return;
                    }

                    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE tourist_id = :tourist_id AND agency_id = :agency_id');
                    $stmt->execute([':tourist_id' => $tourist_id,
                                    ':agency_id' => $agency_id]);
                    $review = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();

                    if(!empty($count)){
                        $stmt = $pdo->prepare('UPDATE reviews SET agency_id = :agency_id, tourist_id = :tourist_id, rating = :rating, comment = :comment, review_status = :review_status, review_date = :review_date WHERE review_id = :review_id');

                        $stmt->execute([':review_id'        => $review['review_id'],
                                        ':agency_id'        => $review['agency_id'],
                                        ':tourist_id'       => $review['tourist_id'],
                                        ':rating'           => $rate,
                                        ':comment'          => $comment,
                                        ':review_status'    => 'published',
                                        ':review_date'      => $date]);

                        header('Location: agency.php?agency_id='. $agency_id);
                        return;
                    }else{
                        $stmt = $pdo->prepare('INSERT INTO reviews(agency_id, tourist_id, rating, comment, review_status, review_date) VALUES(:agency_id, :tourist_id, :rating, :comment, :review_status, :review_date)');

                        $stmt->execute([':agency_id'        => $agency_id,
                                        ':tourist_id'       => $tourist_id,
                                        ':rating'           => $rate,
                                        ':comment'          => $comment,
                                        ':review_status'    => 'published',
                                        ':review_date'      => $date]);

                        header('Location: agency.php?agency_id='. $agency_id);
                        return;
                    }
                }
            ?>

            <?php
                if(isset($_SESSION['tourist_id'])){
                    $stmt = $pdo->prepare('SELECT * FROM payments WHERE tourist_id = :tourist_id AND agency_id = :agency_id');
                    $stmt->execute([':tourist_id'   => $_SESSION['tourist_id'],
                                    ':agency_id'    => $agency_id]);
                    $payment = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            ?>
            <div class="col-sm-4 mt-4"  style="font-size: .9rem">
                <h5>Leave a Review</h5>
                <?php
                    include 'includes/flash_msg.php';
                ?>
                <div class="form-group">
                    <form action="" method="post">
                        <label for="">Rate Your Experience</label>
                        <div> 
                            <span class="fa fa-star review mx-1" data-index="1"></span>
                            <span class="fa fa-star review mx-1" data-index="2"></span>
                            <span class="fa fa-star review mx-1" data-index="3"></span>
                            <span class="fa fa-star review mx-1" data-index="4"></span>
                            <span class="fa fa-star review mx-1" data-index="5"></span> 
                            <input type="hidden" name="rating" id="rating">
                        </div>
                        <div class="form-group">
                            <label for="">Write a Comment(optional)</label><br>
                            <textarea name="comment" id="body" cols="50" rows="10"></textarea>
                        </div>
                        <?php
                            if(isset($_SESSION['tourist_id'])  && (!empty($payment) && $payment['tour_status'] == 'completed')){
                                echo '<div class="form-group">
                                        <input type="submit" class="btn btn-primary formPost" name="post_review" value="Post">
                                    </div>';
                            }
                        ?>
                        
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Info -->
<div class="lead container info-content">
    <h5 class="mt-5 pl-3">Agency Information</h5>
    <div class="row">
        <div class="col-sm-8">
            <div class="card pb-0" style="border: none;">
                <div class="card-body">
                    <div class="py-3">
                        <span class="font-weight-bold font-italic border-bottom border-dark">Owner</span>
                    </div>
                    <div class="py-2 pl-2">
                        <span class="font-weight-bold mr-2">Name:</span><?php echo $agency['owner_firstname'] .' ' .$agency['owner_lastname']; ?>
                    </div>
                    <div class="py-2 pl-2">
                        <span class="mr-2"><i class="fas fa-envelope"></i></span>
                        <span class="font-weight-bold mr-2">Email:</span> <?php echo $agency['agency_email']; ?>
                    </div>
                    <div class="py-2 pl-2">
                        <span class="mr-2"><i class="fas fa-phone-alt"></i></span>
                        <span class="font-weight-bold mr-2">Phone:</span> <?php echo $agency['agency_contact']; ?>
                    </div>
                </div>
            </div>

            <?php
                $stmt = $pdo->prepare('SELECT * FROM agency_employees WHERE role = :role AND agency_id = :agency_id');
                $stmt->execute([':role'       => 'manager',
                                ':agency_id'  => $agency['agency_id'] ]);
                $managers = $stmt->fetchAll();

                if(!empty($managers)){
            ?>
            <div class="card py-0" style="border: none;">
                <div class="card-body">
                    <div class="pb-3">
                        <span class="font-weight-bold font-italic border-bottom border-dark">Manager(s)</span>
                    </div>

                    <?php
                        foreach($managers as $manager){
                    ?>
                    <div class="py-2 pl-2">
                        <span class="font-weight-bold mr-2">Name:</span><?php echo $manager['employee_firstname'] .' ' .$manager['employee_lastname']; ?>
                    </div>
                    <div class="py-2 pl-2">
                        <span class="mr-2"><i class="fas fa-envelope"></i></span>
                        <span class="font-weight-bold mr-2">Email:</span> <?php echo $manager['employee_email']; ?>
                    </div>
                    <div class="py-2 pl-2 mb-3">
                        <span class="mr-2"><i class="fas fa-phone-alt"></i></span>
                        <span class="font-weight-bold mr-2">Phone:</span> <?php echo $manager['employee_contact']; ?>
                    </div>

                    <?php
                        }
                    ?>

                </div>
            </div>

            <?php
                }
                
                $stmt = $pdo->prepare('SELECT * FROM agency_employees WHERE role = :role AND agency_id = :agency_id');
                $stmt->execute([':role'       => 'staff',
                                ':agency_id'  => $agency['agency_id'] ]);
                $staffs = $stmt->fetchAll();

                if(!empty($staffs)){
            ?>
            <div class="card pt-0" style="border: none;">
                <div class="card-body">
                    <div class="pb-3">
                        <span class="font-weight-bold font-italic border-bottom border-dark">Staff(s)</span>
                    </div>

                    <?php
                        foreach($staffs as $staff){
                    ?>
                    <div class="py-2 pl-2">
                        <span class="font-weight-bold mr-2">Name:</span><?php echo $staff['employee_firstname'] .' ' .$staff['employee_lastname']; ?>
                    </div>
                    <div class="py-2 pl-2">
                        <span class="mr-2"><i class="fas fa-envelope"></i></span>
                        <span class="font-weight-bold mr-2">Email:</span> <?php echo $staff['employee_email']; ?>
                    </div>
                    <div class="py-2 pl-2 mb-3">
                        <span class="mr-2"><i class="fas fa-phone-alt"></i></span>
                        <span class="font-weight-bold mr-2">Phone:</span> <?php echo $staff['employee_contact']; ?>
                    </div>

                    <?php
                        }
                    ?>

                </div>
            </div>
                    <?php } ?>
        </div>
    </div>
</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<script>
    let ratedIndex = -1;
    $(document).ready(function(){
        const star = $('.review');
        
        //console.log(star);
        resetColor();

        $(star).click(function(){
            ratedIndex =  parseInt($(this).data('index'));
            console.log(parseInt(ratedIndex));
            $("#rating").val(ratedIndex);
        })

        $(star).mouseover(function(){
            let current = parseInt($(this).data('index'));

            setStarColor(current);
        });

        $(star).mouseleave(function(){
            resetColor();

            if(ratedIndex != -1){
                setStarColor(ratedIndex);
            }
        });

        function resetColor(){
            $(star).css('color', '#cfd8dc');
        }

        function setStarColor(max){
            for(let i=0; i<max; i++){
                $(star[i]).css('color', '#fbc02d');
            }
        }
    });
</script>

<script src="js/agency.js"></script>

<?php
    include 'layouts/footer.php'
?>