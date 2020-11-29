<?php
    include '../includes/db.php';
    include 'layouts/agency_header.php';
    include 'layouts/agency_navbar.php';

    if(empty($_SESSION['agency_login']) || $_SESSION['agency_login'] == ''){
        header('Location: ../includes/login.php');
        return;
    }

    if(isset($_SESSION['agency_id'])){
        $agency_id = $_SESSION['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM comments WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $comments = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $comments[] = $row;
        }
    }
?>

<head>
    <link rel="stylesheet" href="../css/agency.php">
</head>

<div id="layoutSidenav">
    <?php
        include 'layouts/agency_sidenav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to 
                <?php
                    if(isset($_SESSION['employee_id'])){
                        echo ucwords($_SESSION['agency_name']) ." (". ucwords($_SESSION['role']) .")";
                    }elseif($_SESSION['agency_id']){
                        echo ucwords($_SESSION['agency_name']) ." (Owner)";
                    }
                ?>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Package Comment List</li>
                </ol>
                <div class="container-fluid mt-3">
                <?php
                    if(empty($comments)){
                        echo '<h1 class="text-center pt-4">No Comment Found</h1>';
                    }else{
                ?>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Author Email</th>
                                <th>Package Name</th>
                                <th>Comment</th>
                                <th>Date</th>
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

                                    $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                                    $stmt->execute([':package_id' => $comment['package_id']]);
                                    $package = $stmt->fetch(PDO::FETCH_ASSOC);

                                    echo '<td><a href="../package.php?package_id='. $comment['package_id'] .'">'. $package['package_name'] .'</a></td>';
                                    echo '<td>'. $comment['content'] .'</td>';
                                    echo '<td>'. $comment['comment_date'] .'</td>';
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
    include 'layouts/agency_footer.php';
?>