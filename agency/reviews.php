<?php
    include '../includes/db.php';
    include '../includes/functions.php';
    include 'layouts/agency_header.php';
    include 'layouts/agency_navbar.php';

    if(empty($_SESSION['agency_login']) || $_SESSION['agency_login'] == ''){
        header('Location: ../includes/login.php');
        return;
    }

    if(isset($_SESSION['agency_id'])){
        $agency_id = $_SESSION['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM reviews WHERE agency_id = :agency_id AND review_status = :review_status');
        $stmt->execute([':agency_id'        => $agency_id,
                        ':review_status'    => 'published']);
        $reviews = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $reviews[] = $row;
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
                    <li class="breadcrumb-item active">Ratings List</li>
                </ol>
                <div class="container-fluid mt-3">

                <?php
                    if(empty($reviews)){
                        echo '<h1 class="text-center pt-4">No Review Found</h1>';
                    }else{
                ?>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Author Email</th>
                                <th>Ratings</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                            foreach($reviews as $review){
                                echo '<tr>';
                                    echo '<td>'. $review['review_id'] .'</td>';

                                    $tourist = readTourist($review['tourist_id']);
                                    echo '<td>'. ucwords($tourist['tourist_firstname']) .' '. ucwords($tourist['tourist_lastname']) .'</td>';
                                    echo '<td>'. $tourist['tourist_email'] .'</td>';

                                    echo '<td>'. $review['rating'] .'</td>';
                                    echo '<td>'. $review['comment'] .'</td>';
                                    echo '<td>'. $review['review_date'] .'</td>';
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