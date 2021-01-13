<?php

    include '../includes/db.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->query('SELECT * FROM packages ORDER BY agency_id');
    $stmt->execute();

    $packages = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $packages[] = $row;
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
                    <li class="breadcrumb-item active">Package Information</li>
                </ol>

                <?php
                    if(empty($packages)){
                        echo '<h1 class="text-center pt-4">No Package Found</h1>';
                    }else{
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Agency Name</th>
                                    <th>Location</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                foreach($packages as $package){
                                    if($package['package_status'] == 'unavailable'){
                                        echo '<tr class="table-warning">';
                                    }else {
                                        echo '<tr>';
                                    }
                                        echo '<td>'. $i++ .'</td>';
                                        echo '<td><a href="../package.php?package_id='. $package['package_id'] .'">'. $package['package_name'] .'</a></td>';

                                        $agency_id = $package['agency_id'];
                                        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                                        $stmt->execute([':agency_id' => $agency_id]);
                                        $agency = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo '<td><a href="../agency.php?agency_id='. $package['agency_id'] .'">'. $agency['agency_name'] .'</a></td>';
                                        echo '<td>'. $package['location'] .'</td>';
                                        echo '<td>'. $package['country'] .'</td>';
                                        echo '<td>'. ucwords($package['package_status']) .'</td>';

                                        //Counting Package Comment
                                        $stmt = $pdo->prepare('SELECT count(*) FROM comments WHERE package_id = :package_id AND comment_status = :comment_status');
                                        $stmt->execute([':package_id'       => $package['package_id'],
                                                        ':comment_status'   => 'published']);
                                        $comment_count = $stmt->fetchColumn();
                                        echo '<td>'. $comment_count .'</td>';

                                    if($package['package_status'] == 'unavailable'){
                                        echo '<td><a href="packages.php?delete='. $package['package_id'] .'" class="btn btn-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                                    }else{
                                        echo '<td><a href="packages.php?delete='. $package['package_id'] .'" class="btn btn-outline-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                                    }
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
                    }
                ?>

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
