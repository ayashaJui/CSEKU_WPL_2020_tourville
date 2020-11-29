<?php
    include '../includes/db.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->query('SELECT * FROM comments');
    $stmt->execute();
    $comments = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $comments[] = $row;
    }
    
    if(isset($_GET['publish'])){
        $comment_id = $_GET['publish'];

        $stmt = $pdo->prepare('UPDATE comments SET comment_status = :comment_status WHERE comment_id = :comment_id');
        $stmt->execute([':comment_id'     => $comment_id,
                        ':comment_status' => 'published']);

        $_SESSION['success'] = 'Comment status set to Published';
        header('Location: comments.php');
        return;
    }

    if(isset($_GET['unpublish'])){
        $comment_id = $_GET['unpublish'];

        $stmt = $pdo->prepare('UPDATE comments SET comment_status = :comment_status WHERE comment_id = :comment_id');
        $stmt->execute([':comment_id'     => $comment_id,
                        ':comment_status' => 'unpublished']);

        $_SESSION['success'] = 'Comment status set to Unblished';
        header('Location: comments.php');
        return;
    }

    if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM comments WHERE comment_id = :comment_id');
        $stmt->execute([':comment_id' => $comment_id]);

        $_SESSION['success'] = 'Comment Deleted';
        header('Location: comments.php');
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
                    <li class="breadcrumb-item active">Package Comments Details</li>
                </ol>
                <div class="row">
                    <div class="col-lg-12">

                    <?php
                        include '../includes/flash_msg.php';
                        
                        if(empty($comments)){
                            echo '<h1 class="text-center pt-4">No Comment Found</h1>';
                        }else{
                    ?>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Package</th>
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
                                foreach($comments as $comment){
                                    if($comment['comment_status'] == 'unpublished'){
                                        echo '<tr class="table-warning">';
                                    }else{
                                        echo '<tr>';
                                    }
                                        echo '<td>'. $comment['comment_id'] .'</td>';

                                        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
                                        $stmt->execute([':tourist_id' => $comment['tourist_id']]);
                                        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo '<td>'. $tourist['tourist_firstname'] .' '. $tourist['tourist_lastname'] .'</td>';
                                        echo '<td>'. $tourist['tourist_email'] .'</td>';
                                        echo '<td>'. $comment['content'] .'</td>';

                                        $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                                        $stmt->execute([':package_id' => $comment['package_id']]);
                                        $package = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo '<td><a href="../package.php?package_id='. $comment['package_id'] .'">'. $package['package_name'] .'</a></td>';

                                        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                                        $stmt->execute([':agency_id' => $comment['agency_id']]);
                                        $agency = $stmt->fetch(PDO::FETCH_ASSOC);

                                        echo '<td><a href="../agency.php?agency_id='. $comment['agency_id'] .'">'. $agency['agency_name'] .'</a></td>';
                                        echo '<td>'. ucwords($comment['comment_status']) .'</td>';
                                        echo '<td>'. $comment['comment_date'] .'</td>';
                                        echo '<td><a href="comments.php?publish='. $comment['comment_id'] .'" class="btn btn-outline-success mt-1">Publish</a></td>';
                                        echo '<td><a href="comments.php?unpublish='. $comment['comment_id'] .'" class="btn btn-outline-secondary mt-1">Unpublish</a></td>';
                                        echo '<td><a href="comments.php?delete='. $comment['comment_id'] .'" class="btn btn-outline-danger mt-1">Delete</a></td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>
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
