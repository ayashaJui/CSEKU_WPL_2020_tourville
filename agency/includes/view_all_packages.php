<?php
    //Package Read Query.. for only one Agency
    if($_SESSION['agency_id']){
        $agency_id = $_SESSION['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM packages WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $packages = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $packages[] = $row;
        }
    }

    //Package Available Query
    if(isset($_GET['available'])){
        $package_id = $_GET['available'];

        $stmt = $pdo->prepare('UPDATE packages SET package_status = :package_status WHERE package_id = :package_id');
        $stmt->execute([':package_id'       => $package_id,
                        ':package_status'   => 'available']);
        $_SESSION['success'] = 'Package status set to Available';
        header('Location: packages.php');
        return;
    }

    //Package unvailable Query
    if(isset($_GET['unavailable'])){
        $package_id = $_GET['unavailable'];

        $stmt = $pdo->prepare('UPDATE packages SET package_status = :package_status WHERE package_id = :package_id');
        $stmt->execute([':package_id'       => $package_id,
                        ':package_status'   => 'unavailable']);
        $_SESSION['success'] = 'Package status set to Unavailable';
        header('Location: packages.php');
        return;
    }

    //Package Delete Query
    if(isset($_GET['delete'])){
        $package_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id' => $package_id]);

        $_SESSION['success'] = 'Package has been Deleted';
        header('Location: packages.php');
        return;
    }
?>

<div class="container-fluid">

<?php
    include '../includes/flash_msg.php';

    if(empty($packages)){
        echo '<h1 class="text-center pt-4">No Package Found</h1>';
    }else{
?>

    <div class="col-xs-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                <th>ID</th>
                <th>Package Name</th>
                <th>Location</th>
                <th>Country</th>
                <th>Status</th>
                <th>Comments</th>
                <th>Created at</th>
                <th>Available</th>
                <th>Unavailable</th>

                <?php
                    if( $_SESSION['agency_login'] == 'AgencyOwner' || $_SESSION['role'] !== 'staff'){
                ?>

                <th>Action</th>

                <?php
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
                foreach($packages as $package){
                    if($package['package_status'] == 'unavailable'){
                        echo '<tr class="table-warning">';
                    }else{
                        echo '<tr>';
                    }
                            echo '<td>'. $package['package_id'] .'</td>';
                            echo '<td><a href="../package.php?package_id='. $package['package_id'] .'">'. $package['package_name'] .'</a></td>';
                            echo '<td>'. $package['location'] .'</td>';
                            echo '<td>'. $package['country'] .'</td>';
                            echo '<td>'. ucwords($package['package_status']) .'</td>';
                            echo '<td>8</td>';
                            echo '<td>'. $package['package_date'] .'</td>';

                        if($package['package_status'] == 'unavailable'){
                            echo '<td><a  href="packages.php?available='. $package['package_id'] .'" class="btn btn-success mt-1">Available</a></td>';
                            echo '<td><a  href="packages.php?unavailable='. $package['package_id'] .'" class="btn btn-secondary mt-1">Unavailable</a></td>';
                        }else {
                            echo '<td><a  href="packages.php?available='. $package['package_id'] .'" class="btn btn-outline-success mt-1">Available</a></td>';
                            echo '<td><a  href="packages.php?unavailable='. $package['package_id'] .'" class="btn btn-outline-secondary mt-1">Unavailable</a></td>';
                        }

                        if( $_SESSION['agency_login'] == 'AgencyOwner' || $_SESSION['role'] !== 'staff'){
                            if($package['package_status'] == 'unavailable'){
                                echo '<td><a  href="packages.php?page=edit_package&edit='. $package['package_id'] .'" class="btn btn-warning mt-1 mr-1"><i class="fas fa-edit"></i></a>';
                                echo '<a href="packages.php?delete='. $package['package_id'] .'" class="btn btn-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                            }else{
                                echo '<td><a  href="packages.php?page=edit_package&edit='. $package['package_id'] .'" class="btn btn-outline-warning mt-1 mr-1"><i class="fas fa-edit"></i></a>';
                                echo '<a href="packages.php?delete='. $package['package_id'] .'" class="btn btn-outline-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                            }
                        }
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