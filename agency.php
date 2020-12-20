<?php
    include 'includes/db.php';
    $page = 'agencies';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(isset($_GET['agency_id'])){
        $agency_id = $_GET['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id'   => $agency_id]);
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <form action="search_agency_package.php?agency_id=<?php echo $agency_id; ?>" method="post" class="input-group ml-2 mt-5">
        <input type="text" name="search" id="" placeholder="Search package" class="form-control col-md-4">
        <button class="btn btn-outline-success ml-1 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
    </form>

    <?php
        if(empty($packages)){
            echo '<h1 class="text-center pt-4">No Package Found</h1>';
        }else{
    ?>

    <div class="card my-5 p-2" style="border: none; font-size: 1rem;" >
    
<?php
    foreach($packages as $package){
        echo '<div class="row no-gutters mb-3">';
            echo '<div class="col-md-4">';

                $imgs = $package['place_images'];
                //convert string to array
                $imgs = explode(',', $imgs);
                //replace the special character to space
                $search = ["(", "'", ")" ];
                $place_img = str_replace($search, '', $imgs[0]);

                echo  '<a href="package.php?package_id='. $package['package_id'] .'"><img src="images/packages/'. $place_img .'" class="card-img" alt="'. $package['package_name'] .'"></a>
                </div>';
            echo '<div class="col-md-8">';
                echo '<div class="card-body">';
                    echo '<div><div>';
                        echo '<h5 class="card-title">'. $package['package_name']. '</h5>';
                        echo '<p class="float-right" style="position: relative; top: -30px;">
                                <span class="text-muted mr-3">4.0</span>
                                <span class="fa fa-star star-active"></span>
                                <span class="fa fa-star star-active"></span>
                                <span class="fa fa-star star-active"></span>
                                <span class="fa fa-star star-active"></span>
                                <span class="fa fa-star star-inactive"></span>
                            </p>';
                        echo '</div>';
                        echo '<h5 class="font-italic text-info" style="font-size: .85rem;"><span class="mr-1"><i class="fas fa-map-marker-alt"></i></span>'. $package['location'] .', '. $package['country'] .'</h5>';
                        echo '<div class="" style="font-size: .85rem;">
                                <p class="text-muted pt-2"><span class="mr-1"><i class="far fa-clock"></i></span>'. $package['num_days'] .' days '. $package['num_nights'] .' nights</p>
                            </div>';
                    echo '</div>';
                    echo '<p class="card-text mb-3" style="font-size: .7rem;">'. substr($package['place_details'], 0, 50) .'...</p><hr>';
                    echo '<div>';
                        echo '<p class="text-muted">
                                <h5>BDT '. $package['budget_price'] .'/-</h5>
                                <a href="package.php?package_id='. $package['package_id'] .'" class="btn btn-primary float-right" style="position: relative; top: -30px;font-size: .8rem;">View<span class=" ml-2"><i class="fas fa-angle-right"></i></span></a>
                            </p>';
                    echo '</div>';
        echo ' </div></div></div>';

    }
?>
    </div>

    <?php 
        }
    ?>
</div>

<!-- Reviews -->
<div class="container review-content">
    <h5 class="mt-5 pl-3">Ratings & Comments</h5>
    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-10 col-12 text-center mb-5">
                <div class="card">
                    <div class="row justify-content-left d-flex">
                        <div class="col-md-4 d-flex flex-column">
                            <div class="rating-box">
                                <h1 class="pt-4">4.0</h1>
                                <p class="">out of 5</p>
                            </div>
                            <div> 
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-active mx-1"></span>
                                <span class="fa fa-star star-inactive mx-1"></span> 
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="rating-bar0 justify-content-center">
                                <table class="text-left mx-auto">
                                    <tr>
                                        <td class="rating-label">Excellent</td>
                                        <td class="rating-bar">
                                            <div class="progress  rounded-pill">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">123</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Good</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">23</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Average</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">10</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Poor</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">3</td>
                                    </tr>
                                    <tr>
                                        <td class="rating-label">Terrible</td>
                                        <td class="rating-bar">
                                            <div class="progress rounded-pill">
                                                <div class="progress-bar bg-dark " role="progressbar" style="width: 0%" aria-valuenow="00" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="text-right">0</td>
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
                <div class="card">
                    <div class="row d-flex">
                        <div class=""> <img class="profile-pic" src="images/download (1).jpg"></div>
                        <div class="d-flex flex-column">
                            <h3 class="mt-2 mb-0">John Doe</h3>
                            <div>
                                <p class="text-left">
                                    <span class="text-muted mr-3">4.0</span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-inactive"></span>
                                </p>
                            </div>
                        </div>
                        <div class="ml-auto">
                            <p class="text-muted pt-5 pt-sm-3">10 Sept</p>
                        </div>
                    </div>
                    <div class="row text-left">
                        <!-- <h4 class="mt-3">"An awesome place to experience travel"</h4> -->
                        <p class="content mt-3">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste dolores fugiat vero recusandae? Esse, similique.</p>
                    </div>
                </div>
            </div>

            <?php
                if(isset($_POST['post_review'])){
                    $tourist_id = $_SESSION['tourist_id'];
                    $agency_id  = $_GET['agency_id'];
                    $rate       = $_POST['rating'];
                    $comment    = $_POST['comment'];
                    $date       = date("y.m.d");

                    if($rate == -1){
                        $rate = 0;
                    }

                    $stmt = $pdo->prepare('SELECT * FROM reviews WHERE tourist_id = :tourist');
                    $stmt->execute(['tourist_id' => $tourist_id]);
                    $count = $stmt->rowCount();

                    if(!empty($count)){
                        $_SESSION['error'] = "You can not review twice. Please delete previous one to review again";
                        header('Location: agency.php?agency_id='. $agency_id);
                        return;
                    }else{
                        $stmt = $pdo->prepare('INSERT INTO reviews(agency_id, tourist_id, rating, comment, review_date) VALUES(:agency_id, :tourist_id, :rating, :comment, :review_date)');

                        $stmt->execute([':agency_id'        => $agency_id,
                                        ':tourist_id'       => $tourist_id,
                                        ':rating'           => $rate,
                                        ':comment'          => $comment,
                                        ':review_date'      => $date]);

                        header('Location: agency.php?agency_id='. $agency_id);
                        return;
                    }
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
                            <textarea name="comment" id="" cols="50" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary formPost" name="post_review" value="Post">
                        </div>
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