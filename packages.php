<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    //Pagination
    $per_page = 10;
    $stmt = $pdo->prepare('SELECT count(*) FROM packages WHERE package_status = :package_status');
    $stmt->execute([':package_status' => 'available']);
    $package_count = $stmt->fetchColumn();
    $package_count = ceil($package_count/$per_page);

    if(isset($_GET['page_no'])){
        $page_no = $_GET['page_no'];
    }else{
        $page_no = '';
    }
    $prev = ' ';
    $next = ' ';
    if(!empty($page_no)){
        $prev = $page_no - 1;
        $next = $page_no + 1;
    }

    if($page_no === '' || $page_no === 1){
        $start = 0;
    }else{
        $start = ($page_no*$per_page) - $per_page;
    }

    //Package read Query.. All Packages
    $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_status = :package_status ORDER BY package_name LIMIT '. $start .', '.$per_page);
    $stmt->execute([':package_status' => 'available']);
    $packages = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $packages[] = $row;
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

        .status{
            background: #EAE8FF;
            font-size: .9rem;
            font-weight: 500;
            border: 2px solid #85998A;
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
<div class="jumbotron jumbotron-fluid package">
  <div class="container">
    <h1 class="display-4 text-primary font-weight-bold">Packages</h1>
    <p class="lead">
        <form action="search.php" method="post" class="input-group">
            <input type="text" name="search" id="" placeholder="Search" class="form-control col-md-4">
            <button class="btn btn-outline-success ml-2 p-2" type="submit" name="submit"><i class="fas fa-search"></i></button>
        </form>
    </p>
  </div>
</div>

<div class="container">
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
            <div class="card m-5 pt-4 px-4 effect" style="border: none;">
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

<div class="container">
    <nav aria-label="Page navigation example ">
        <ul class="pagination justify-content-center">
            <?php
                if($page_no == 1 || $page_no == ' '){
                    echo '<li class="page-item disabled">
                            <a class="page-link" href="packages.php?page_no='. $prev .'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>';
                }else{
                    echo '<li class="page-item">
                            <a class="page-link" href="packages.php?page_no='. $prev .'" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>';
                }
            ?>

            <?php
                for($i=1; $i<= $package_count; $i++){
                    if($i == $page_no){
                        echo '<li class="page-item active"><a class="page-link" href="packages.php?page_no='.$i.'">'.$i.'</a></li>';
                    }else{
                        echo '<li class="page-item"><a class="page-link" href="packages.php?page_no='.$i.'">'.$i.'</a></li>';
                    }
                }

                if($page_no == $package_count){
                    echo '<li class="page-item disabled">
                            <a class="page-link" href="packages.php?page_no='. $next .'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>';
                }else{
                    echo '<li class="page-item">
                            <a class="page-link" href="packages.php?page_no='. $next .'" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>';
                }
            ?>
        </ul>
    </nav>
</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>