<?php
    include '../includes/db.php';
    include '../includes/functions.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->query('SELECT * FROM reviews ORDER BY review_status DESC');
    $stmt->execute();

    $reviews = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $reviews[] = $row;
    }

    if(isset($_GET['publish'])){
        $review_id = $_GET['publish'];

        $stmt = $pdo->prepare('UPDATE reviews SET review_status = :review_status WHERE review_id = :review_id');
        $stmt->execute([':review_id'     => $review_id,
                        ':review_status' => 'published']);

        $_SESSION['success'] = 'Review status set to Published';
        header('Location: reviews.php');
        return;
    }

    if(isset($_GET['unpublish'])){
        $review_id = $_GET['unpublish'];

        $stmt = $pdo->prepare('UPDATE reviews SET review_status = :review_status WHERE review_id = :review_id');
        $stmt->execute([':review_id'     => $review_id,
                        ':review_status' => 'unpublished']);

        $_SESSION['success'] = 'Review status set to Unblished';
        header('Location: reviews.php');
        return;
    }

    if(isset($_GET['delete'])){
        $review_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM reviews WHERE review_id = :review_id');
        $stmt->execute([':review_id' => $review_id]);

        $_SESSION['success'] = 'Review Deleted';
        header('Location: reviews.php');
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
                    <li class="breadcrumb-item active">Ratings & Comments Details</li>
                </ol>

                <?php
                    include '../includes/flash_msg.php';
                    
                    if(empty($reviews)){
                        echo '<h1 class="text-center pt-4">No Review Found</h1>';
                    }else{
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Agency</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Publish</th>
                                    <th>Unpublish</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach($reviews as $review){
                                if($review['review_status'] == 'unpublished'){
                                    echo '<tr class="table table-warning">';
                                }else{
                                    echo '<tr>';
                                }
                                    echo '<td>'. $i++ .'</td>';
                                    
                                    //read tourist name
                                    $tourist = readTourist($review['tourist_id']);
                                    echo '<td>'. ucwords($tourist['tourist_firstname']) .' '. ucwords($tourist['tourist_lastname']) .'</td>';

                                    echo '<td>'. $review['rating'] .'</td>';
                                    echo '<td>'. $review['comment'] .'</td>';

                                    //read agency name
                                    $agency = readAgency($review['agency_id']);
                                    echo '<td><a href="../agency.php?agency_id='. $review['agency_id'] .'">'. $agency['agency_name'] .'</a></td>';

                                    echo '<td>'. ucwords($review['review_status']) .'</td>';
                                    echo '<td>'. $review['review_date'] .'</td>';

                                if($review['review_status'] == 'unpublished'){
                                    echo '<td><a href="reviews.php?publish='. $review['review_id'] .'" class="btn btn-success mt-1">Publish</a></td>';
                                    echo '<td><a href="reviews.php?unpublish='. $review['review_id'] .'" class="btn btn-secondary mt-1">Unpublish</a></td>';
                                    echo '<td><a href="reviews.php?delete='. $review['review_id'] .'" class="btn btn-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                                }else{
                                    echo '<td><a href="reviews.php?publish='. $review['review_id'] .'" class="btn btn-outline-success mt-1">Publish</a></td>';
                                    echo '<td><a href="reviews.php?unpublish='. $review['review_id'] .'" class="btn btn-outline-secondary mt-1">Unpublish</a></td>';
                                    echo '<td><a href="reviews.php?delete='. $review['review_id'] .'" class="btn btn-outline-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
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
