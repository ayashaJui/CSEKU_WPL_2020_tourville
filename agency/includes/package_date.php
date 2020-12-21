<?php
    
    $stmt = $pdo->prepare('SELECT * FROM package_dates WHERE agency_id = :agency_id');
    $stmt->execute([':agency_id'  => $_SESSION['agency_id']]);
    $dates = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $dates[] = $row;
    }

    //booking on
    if(isset($_GET['b_on'])){
        $date_id = $_GET['b_on'];

        $stmt = $pdo->prepare('UPDATE package_dates SET status = :status WHERE date_id = :date_id');
        $stmt->execute([':status'   => 'booking on',
                        ':date_id'  => $date_id]);

        $_SESSION['success'] = 'Booking Going On';
        header('Location: packages.php?page=package_date');
        return;
    }

    //booking off
    if(isset($_GET['b_off'])){
        $date_id = $_GET['b_off'];

        $stmt = $pdo->prepare('UPDATE package_dates SET status = :status WHERE date_id = :date_id');
        $stmt->execute([':status'   => 'booking off',
                        ':date_id'  => $date_id]);

        $_SESSION['success'] = 'Booking Off';
        header('Location: packages.php?page=package_date');
        return;
    }

    //delete
    if(isset($_GET['delete'])){
        $date_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM package_dates WHERE date_id = :date_id');
        $stmt->execute([':date_id' => $date_id]);

        $_SESSION['success'] = 'Package Dates has been Deleted';
        header('Location: packages.php?page=package_date');
        return;
    }
?>

<div class="container-fluid">

<?php
    include '../includes/flash_msg.php';

    if(empty($dates)){
        echo '<h1 class="text-center pt-4">Nothing to Show</h1>';
    }else{
?>
    <div class="col-xs-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Package Name</th>
                    <th>Last Booking Date</th>
                    <th>Travel Date</th>
                    <th>Status</th>
                    <th>Extend</th>
                    <th>Booking</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                foreach($dates as $date){
                    echo '<tr>';
                        echo '<td>'. $date['date_id'] .'</td>';
                        
                        $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                        $stmt->execute([':package_id' => $date['package_id']]);
                        $package = $stmt->fetch(PDO::FETCH_ASSOC);
                        echo '<td><a href="../package.php?package_id='. $date['package_id'] .'">'. $package['package_name'] .'</a></td>';

                        echo '<td>'. $date['last_date'] .'</td>';
                        echo '<td>'. $date['travel_date'] .'</td>';
                        echo '<td>'. ucwords($date['status']) .'</td>';

                        echo '<td><a href="packages.php?page=update_date&extend='. $date['date_id'] .'" class="btn btn-outline-info mt-1">Extend</a></td>';

                        echo '<td><a href="packages.php?page=package_date&b_on='. $date['date_id'] .'" class="btn btn-outline-success mt-1 mr-1">On</a>';
                        echo '<a href="packages.php?page=package_date&b_off='. $date['date_id'] .'" class="btn btn-outline-secondary mt-1">Off</a></td>';

                        echo '<td><a href="packages.php?page=update_date&edit='. $date['date_id'] .'" class="btn btn-outline-warning mt-1 mr-1"><i class="fas fa-edit"></i></a>';
                        echo '<a href="packages.php?page=package_date&delete='. $date['date_id'] .'" class="btn btn-outline-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php
    }
    ?>
</div>