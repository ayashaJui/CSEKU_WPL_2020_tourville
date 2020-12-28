<?php
    include '../includes/db.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == '' ){
        header('Location: index.php');
        return;
    }
?>

<div id="layoutSidenav">
    <?php
        include 'layouts/admin_sidenav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to Admin ...</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">

                <?php
                    $stmt = $pdo->prepare('SELECT count(*) FROM agencies');
                    $stmt->execute();
                    $agency_count = $stmt->fetchColumn();
                ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Agencies</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $agency_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="agencies.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $stmt = $pdo->prepare('SELECT count(*) FROM tourists');
                        $stmt->execute();
                        $tourist_count = $stmt->fetchColumn();
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Tourists</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $tourist_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="tourists.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $stmt = $pdo->prepare('SELECT count(*) FROM packages');
                        $stmt->execute();
                        $package_count = $stmt->fetchColumn();
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Packages</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $package_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="packages.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $stmt = $pdo->prepare('SELECT count(*) FROM payments');
                        $stmt->execute();
                        $payment_count = $stmt->fetchColumn();
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Payments</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $payment_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="payments.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $stmt = $pdo->prepare('SELECT count(*) FROM reviews');
                        $stmt->execute();
                        $review_count = $stmt->fetchColumn();
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-info text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Ratings</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $review_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="reviews.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $stmt = $pdo->prepare('SELECT count(*) FROM comments');
                        $stmt->execute();
                        $comment_count = $stmt->fetchColumn();
                    ?>

                    <div class="col-xl-4 col-md-6">
                        <div class="card bg-dark text-white mb-4">
                            <div class="card-body" style="font-size: 30px;">Comments</div>
                            <div class="col-xs-9 text-right pr-4">
                                <div style="font-size: 45px; line-height: normal;"><?php echo $comment_count; ?></div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="comments.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-3 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">tourism@tourville &copy;2020</div>
                    <div class="text-muted">by AyashaJui & SamiaShorna</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php
    include 'layouts/admin_footer.php';
?>
