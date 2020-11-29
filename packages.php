<?php
    include 'includes/db.php';
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
    $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_status = :package_status LIMIT '. $start .', '.$per_page);
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

                //getting multiple image from database..
                $stmt = $pdo->prepare('SELECT place_images FROM packages WHERE package_id = :package_id');
                $stmt->execute([':package_id' => $package['package_id']]);
                $img = $stmt->fetchColumn();
                //convert string to array
                $img = explode(',', $img);
                //replace the special character to space
                $search = ["(", "'", ")" ];
                $place_img = str_replace($search, '', $img[0]);

                echo '<a href="package.php?package_id='. $package['package_id'] .'"><img src="images/packages/'. $place_img .'" class="card-img" height="200" alt="'. $package['package_name'] .'"></a>';
            echo '</div>';
            echo '<div class="col-md-8">';
                echo '<div class="card-body pt-0">';
                    echo '<div><div>';
                        echo    '<h5 class="card-title">'. $package['package_name'] .'</h5>
                                <p class="float-right" style="position: relative; top: -30px;">
                                    <span class="text-muted mr-3">4.0</span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-active"></span>
                                    <span class="fa fa-star star-inactive"></span>
                                </p>
                            </div>';
                         echo '<h5 class="font-italic text-info" style="font-size: .85rem;"><span class="mr-1"><i class="fas fa-map-marker-alt"></i></span>'. $package['location'] .', '. $package['country'] .'</h5>';
                        echo '<div class="" style="font-size: .85rem;">
                                <p class="text-muted pt-2"><span class="mr-1" ><i class="far fa-clock"></i></span>'. $package['num_days'] .' days '. $package['num_nights'] .' nights</p>';
                    echo '</div></div>';
                    echo '<p class="card-text mb-3" style="font-size: .7rem;">'. substr($package['place_details'], 0, 40) .'...</p><hr>';
                    echo '<div>';
                        echo '<p class="text-muted" >
                                <h5>BDT '. $package['package_price'] .' /-</h5>
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