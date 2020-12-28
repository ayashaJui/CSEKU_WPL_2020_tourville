<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(isset($_GET['package_id'])){
        $package_id = $_GET['package_id'];

        $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id'  => $package_id]);
        $package = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<br><br>
<head>
    <link rel="stylesheet" href="css/package.css">
    <script src="js/script.js"></script>
</head>

<br>
<div class="jumbotron jumbotron-fluid package-details">
  <div class="container">
    <h1 class="display-4 font-weight-bold">Package Details</h1>
    
  </div>
</div>

<div class="container">
    <div class="ml-auto p-2 mb-5">
        <h3 class="font-weight-bold pt-4"><?php echo $package['package_name']; ?></h3>
        <h5 class="font-italic text-info" style="font-size: 1rem;"><i class="fas fa-map-marker-alt"></i><?php echo $package['location']; ?>, <?php echo $package['country']; ?></h5>
        <div class="lead mt-5" style="font-size: 1.2rem;">
            <div class="mb-2">

            <?php
                $agency_id = $package['agency_id'];

                $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                $stmt->execute([':agency_id' => $agency_id]);
                $agency = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
                Arranged by: <a href="agency.php?agency_id=<?php echo $package['agency_id']; ?>" class="mr-3"> <?php echo $agency['agency_name']; ?> </a>
            </div>
            <div style="font-size: 1rem;">
                <p><span class="mr-2"><i class="fas fa-envelope"></i></span> Email: <?php echo $agency['agency_email']; ?></p>
                <p><span class="mr-2"><i class="fas fa-phone-alt"></i></span> <?php echo $agency['agency_contact']; ?> </p>
            </div>
        </div>
    </div>

    <!-- subnav -->
    <ul class="nav nav-tabs">
        <li class="nav-item subnav">
            <a class="nav-link active tour-details" href="#">Tour Details</a>
        </li>
        <li class="nav-item subnav">
            <a class="nav-link itinerary" href="#">Itinerary</a>
        </li>
        <li class="nav-item subnav">
            <a class="nav-link gallery" href="#">Gallery</a>
        </li>
        <li class="nav-item subnav">
            <a class="nav-link review" href="#">Reviews</a>
        </li>
    </ul>
</div>

<!-- tour details -->
<div class="lead container tour-details-content">
    <div class="mt-5 p-2">
        <h4 class="pb-2">Place Details</h4>
        <p>
            <?php echo $package['place_details']; ?>
        </p>
    </div>
    <div class="alert alert-warning mt-5 text-dark" role="alert">
        <p><span class="mr-1"><i class="far fa-clock"></i></span>
            Duration:  <span class="mx-1" style="font-weight: 600;"><?php echo $package['num_days']; ?></span> days <span class="mx-1" style="font-weight: 600;"><?php echo $package['num_nights']; ?></span> nights
        </p>
    </div>
    <div class="alert alert-secondary mt-5 text-dark" role="alert">
        <p><span class="mr-1"><i class="fas fa-users"></i></span>
            Minimum  <span class="mx-1" style="font-weight: 600;"><?php echo $package['min_people']; ?></span> Persons Required.

            <?php
                $package_id = $package['package_id'];
                $stmt = $pdo->prepare('SELECT * FROM bookings WHERE package_id = :package_id AND booking_status = :booking_status');
                $stmt->execute([':package_id'       => $package_id,
                                ':booking_status'   => 'confirm']);

                $books = [];
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $books[] = $row['persons'];
                }
                $size = sizeof($books);

                $book_person = 0;
                for($i=0; $i<$size; $i++){
                    $book_person += $books[$i];
                }
            ?>

            Already Booked by <span class="mx-1" style="font-weight: 600;"><?php echo $book_person; ?></span> persons.
        </p>
    </div>
    
    <?php
        $stmt = $pdo->prepare('SELECT * FROM package_dates WHERE package_id = :package_id');
        $stmt->execute([':package_id'   => $package['package_id']]);
        $date = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="mt-5">
        <p>Starting from
            <h5>BDT <?php echo $package['budget_price']; ?>/-<span class="ml-3">per person</span></h5>
        </p>
        <?php
            if(!isset($_SESSION['tourist_email']) || (!empty($date) && $date['status'] == 'booking off')){
                echo '<a href="booking.php?package_id='. $package['package_id'] .'" class="btn btn-primary mt-3 disabled">Book this tour</a>';
            }else{
                echo '<a href="booking.php?package_id='. $package['package_id'] .'" class="btn btn-primary mt-3">Book this tour</a>';
            }
        ?>
    </div>

    <?php
        if(!empty($date)){
    ?>
    <div class="alert alert-info mt-5 text-dark" role="alert">
        <p><span class="mr-1"><i class="far fa-calendar-alt"></i></span>
            Last Booking Date:  <span class="mx-1" style="font-weight: 600;"><?php echo $date['last_date']; ?></span>.
            Travel Date:  <span class="mx-1" style="font-weight: 600;"><?php echo $date['travel_date']; ?></span>
        </p>
    </div>
    <?php
        }
    ?>
    
    <div class="row mt-5 lead">
        <div class="col-sm-4 border-right">
            <h5 class="p-4 "><span class="border-bottom border-success">Included</span></h5>
            <ul class="list-unstyled p-2">
                <?php 
                    echo $package['includes'];
                ?>
                <!-- <li class=""><span class="text-success mr-2"><i class="fas fa-check"></i></span> Lorem ipsum dolor sit amet.</li>-->
            </ul>
        </div>
        <div class="col-sm-4 ">
            <h5 class="p-4"><span class="border-bottom border-danger">Excluded</span></h5>
            <ul class="list-unstyled p-2">
                <?php 
                    echo $package['excludes'];
                ?>
                <!-- <li class=""><span class="text-danger mr-2"><i class="fas fa-times"></i></span> Lorem ipsum dolor.</li>-->
            </ul>
        </div>
        <div class="col-sm-4 border-left">
            <h5 class="p-4"><span class="border-bottom border-primary">Optional</span></h5>
            <ul class="list-unstyled p-2">
            <?php 
                echo $package['optional'];
            ?>
                <!-- <li class=""><span class="text-primary mr-2"><i class="fas fa-plus"></i></span> Lorem ipsum dolor sit amet.</li>-->
            </ul>
        </div>
    </div>
</div>

<!-- Itinerary -->
<div class="container itinerary-content">
    <div class="lead mt-5 p-2 border-bottom">
        <?php echo $package['itinerary']; ?>
        <!-- <h5 class="font-weight-bold">Day 1</h5>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium nisi deserunt veniam, quaerat eos veritatis.</p> -->
    </div>
    <!-- <div class="lead mt-3 p-2 border-bottom">
        <h5 class="font-weight-bold">Day 2</h5>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laudantium nisi deserunt veniam, quaerat eos veritatis.</p>
    </div> -->
</div>

<!-- gallery -->
<div class="container gallery-content">
    <h5 class="mt-5">Photo Gallery</h5>
    <div class="row" id="gallery" data-toggle="modal" data-target="#exampleModal">

    <?php
        //getting multiple image from database..
        $stmt = $pdo->prepare('SELECT place_images FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id' => $package['package_id']]);
        $img = $stmt->fetchColumn();
        //convert string to array
        $img = explode(',', $img);
        // print_r($img);
        $img_count = count($img);
        //replace the special character to space
        $search = ["(", "'", ")" ];
        for($i=0; $i<$img_count; $i++){
            $place_img = str_replace($search, '', $img[$i]);
                echo '<div class="col-12 col-sm-6 col-lg-3">';
                    echo '<img class="w-100" src="images/packages/'. $place_img .'" alt="'. $package['package_id'] .'" data-target="#carouselExample" data-slide-to="'. $i .'">';
                echo '</div>';
        }
    ?>
        <!-- <div class="col-12 col-sm-6 col-lg-3">
            <img class="w-100" src="images/packages/astronomy-beautiful-clouds-constellation-355465.jpg" alt="First slide" data-target="#carouselExample" data-slide-to="1">
        </div> -->
    </div>

    <!-- Modal -->
    <div class="modal fade modal-fullscreen exmple-modal-fullscreen show" id="exampleModal" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content h-100 border-0 shadow-0">
                <div class="modal-body p-0">
                    <div id="carouselExample" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <?php
                        for($i=0; $i<$img_count; $i++){
                            echo '<li data-target="#carouselExample" data-slide-to="'. $i .'"></li>';
                        }
                    ?>
                        <!-- <li data-target="#carouselExample" data-slide-to="0" class="active"></li> -->
                        
                    </ol>
                    <div class="carousel-inner">
                    <?php
                        for($i=0; $i<$img_count; $i++){
                            $place_img = str_replace($search, '', $img[$i]);
                            
                            if($i > 0){
                                echo '<div class="carousel-item">
                                        <img class="d-block w-100" src="images/packages/'. $place_img .'" alt="First slide">
                                    </div>';
                            }else {
                                echo '<div class="carousel-item active" >';
                                    echo '<img class="d-block w-100" src="images/packages/'. $place_img .'" alt="..">';
                                echo '</div>';
                            }
                            
                        }
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Review -->
<div class="container review-content">
    <h5 class="mt-5">Comments</h5>
    <div class="container-fluid px-1 pt-5 pb-3 mx-auto">
        <!-- comment -->
        <div class="row">
            <div class="col-sm-8">

            <?php
                //Read Comment
                if(isset($_GET['package_id'])){
                    $package_id = $_GET['package_id'];

                    $stmt = $pdo->prepare('SELECT * FROM comments WHERE package_id = :package_id AND comment_status = :comment_status');
                    $stmt->execute([':package_id'       => $package_id,
                                    ':comment_status'   => 'published']);
                    $comments = [];
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $comments[] = $row;
                    }
                }

                //comment delete
                if(isset($_GET['delete_comment'])){
                    $comment_id = $_GET['delete_comment'];
                    $package_id = $_GET['package_id'];

                    $stmt = $pdo->prepare('DELETE FROM comments WHERE comment_id = :comment_id');
                    $stmt->execute([':comment_id' => $comment_id]);

                    header('Location: package.php?package_id='. $package_id);
                    return;
                }

                if(empty($comments)){
                    echo '<h1 class="text-center pt-4">No Comments to Show</h1>';
                }else{
                    foreach($comments as $comment){
            ?>
                <div class="card">
                    <div class="row d-flex">

                    <?php
                        $tourist_id = $comment['tourist_id'];

                        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
                        $stmt->execute([':tourist_id'  => $tourist_id]);
                        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>

                        <div class=""> <img class="profile-pic" src="images/<?php echo $tourist['profile_image']; ?>"></div>
                        <div class="d-flex flex-column">
                            <h4 class="my-auto"><?php echo $tourist['tourist_firstname'] .' '. $tourist['tourist_lastname']; ?></h4>
                        </div>
                        <div class="ml-auto">
                            <p class="text-muted pt-5 pt-sm-3"><?php echo $comment['comment_date']; ?></p>
                        </div>
                    </div>
                    <div class="row text-left mt-3">
                        <p class="content mt-4"><?php echo $comment['content']; ?></p>
                    </div>
                    <?php
                        if(isset($_SESSION['tourist_id']) && $_SESSION['tourist_id'] == $tourist['tourist_id']){
                            echo '<div class="" >
                                    <a href="package.php?package_id='. $comment['package_id'] .'&delete_comment='. $comment['comment_id'] .'" class="btn btn-danger float-right" ><i class="fas fa-trash-alt"></i></a>
                                </div>';
                        }
                    ?>
                </div>

            <?php
                }
            }
            ?>
            </div>

            <!-- Insert Comment -->
            <?php
                if(isset($_POST['post_comment'])){
                    $tourist_id = $_SESSION['tourist_id'];
                    $package_id = $_GET['package_id'];
                    $content    = $_POST['content'];
                    $date       = date("y.m.d");

                    $package = readPackage($package_id);

                    if(empty($content)){
                        header('Location: package.php?package_id='. $package_id);
                        return;
                    }else{
                        $stmt = $pdo->prepare('INSERT INTO comments(tourist_id, package_id, agency_id, content, comment_status, comment_date) VALUES(:tourist_id, :package_id, :agency_id, :content, :comment_status, :comment_date)');

                        $stmt->execute([':tourist_id'       => $tourist_id,
                                        ':package_id'       => $package_id,
                                        ':agency_id'        => $package['agency_id'],
                                        ':content'          => $content,
                                        ':comment_status'   => 'published',
                                        ':comment_date'     => $date]);

                        header('Location: package.php?package_id='. $package_id);
                        return;
                    }
                }

                if(isset($_SESSION['tourist_id'])){
                    $stmt = $pdo->prepare('SELECT * FROM payments WHERE tourist_id = :tourist_id AND package_id = :package_id');
                    $stmt->execute([':tourist_id' => $_SESSION['tourist_id'],
                                ':package_id' => $package_id]);
                    $payment = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                
            ?>

            <div class="col-sm-4 mt-4"  style="font-size: .9rem">
                <h5>Leave a Comment</h5>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="content">Write a Comment</label><br>
                        <textarea name="content" id="body" cols="50" rows="10"></textarea>
                    </div>
                    <?php
                        if(isset($_SESSION['tourist_id'])  && (!empty($payment) && $payment['tour_status'] == 'completed')){
                            echo '<div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="post_comment" value="Post">
                                </div>';
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<script src="js/package.js"></script>

<?php
    include 'layouts/footer.php';
?>