<?php

    //Agency Read Query
    $stmt = $pdo->query('SELECT * FROM agencies ORDER BY agency_status DESC');
    $stmt->execute();
    $agencies = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $agencies[] = $row;
    }

     //Agency Approve Query
    if(isset($_GET['approve'])){
        $agency_id = $_GET['approve'];

        $stmt = $pdo->prepare('UPDATE agencies SET agency_status = :agency_status WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id'     => $agency_id,
                        ':agency_status' => 'approved']);
        $_SESSION['success'] = 'Agency status set to Approved';
        header('Location: agencies.php');
        return;
    }

    //Agency Unapprove Query
    if(isset($_GET['unapprove'])){
        $agency_id = $_GET['unapprove'];

        $stmt = $pdo->prepare('UPDATE agencies SET agency_status = :agency_status WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id'     => $agency_id,
                        ':agency_status' => 'unapproved']);
        $_SESSION['success'] = 'Agency status set to Unpproved';
        header('Location: agencies.php');
        return;
    }

    //Agency Delete Query
    if(isset($_GET['delete'])){
        $agency_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $_SESSION['success'] = 'Successfully Deleted  Agency Info';
        header('Location: agencies.php');
        return;
    }
?>

<div class="col-xs-12">

    <?php
        include '../includes/flash_msg.php';

        if(empty($agencies)){
            echo '<h1 class="text-center pt-4">No Agency Found</h1>';
        }else{
    ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Agency <br> Name</th>
                <th>Owner's <br> Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Office <br> Address</th>
                <th>Status</th>
                <th>Total <br> Packages</th>
                <th>Avg <br> Rating</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
                $i = 1;
                foreach($agencies as $agency){
                    if($agency['agency_status'] == 'unapproved'){
                        echo "<tr class='table-warning'>";
                    }else {
                        echo "<tr>";
                    }
                            echo "<td>". $i++ ."</td>";
                            echo "<td><a href='../agency.php?agency_id=". $agency['agency_id'] ."'>". $agency['agency_name'] ."</a></td>";
                            echo "<td>". ucwords($agency['owner_firstname']) ." ". ucwords($agency['owner_lastname']) ."</td>";
                            echo "<td>". $agency['agency_email'] ."</td>";
                            echo "<td>". $agency['agency_contact'] ."</td>";
                            echo "<td>". ucwords($agency['agency_address']) ."</td>";
                            echo "<td>". ucwords($agency['agency_status']) ."</td>";

                            $stmt = $pdo->prepare('SELECT count(*) FROM packages WHERE agency_id = :agency_id');
                            $stmt->execute([':agency_id'    => $agency['agency_id']]);
                            $count = $stmt->fetchColumn();
                            echo "<td>". $count ."</td>";

                            $stmt = $pdo->prepare('SELECT avg(rating) AS avg_rate FROM reviews WHERE agency_id = :agency_id AND review_status = :review_status');
                            $stmt->execute([':agency_id'      => $agency['agency_id'],
                                            ':review_status'  => 'published']);
                            $avg_rate = $stmt->fetch(PDO::FETCH_ASSOC);
                            echo "<td>". number_format((float)$avg_rate['avg_rate'], 1, '.', '') ."</td>";
                            echo "<td>". $agency['date'] ."</td>";
                            
                        if($agency['agency_status'] == 'unapproved'){
                            echo "<td><a href='agencies.php?approve=". $agency['agency_id'] ."' class='btn btn-success mt-1'>Approve</a></td>";
                            echo "<td><a href='agencies.php?unapprove=". $agency['agency_id'] ."' class='btn btn-secondary mt-1'>Unapprove</a></td>";
                            // echo "<td><a href='agencies.php?page=edit_agency&edit=". $agency['agency_id'] ."' class='btn btn-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
                            echo "<td><a href='agencies.php?delete=". $agency['agency_id'] ."' class='btn btn-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
                        }else{
                            echo "<td><a href='agencies.php?approve=". $agency['agency_id'] ."' class='btn btn-outline-success mt-1'>Approve</a></td>";
                            echo "<td><a href='agencies.php?unapprove=". $agency['agency_id'] ."' class='btn btn-outline-secondary mt-1'>Unapprove</a></td>";
                            // echo "<td><a href='agencies.php?page=edit_agency&edit=". $agency['agency_id'] ."' class='btn btn-outline-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
                            echo "<td><a href='agencies.php?delete=". $agency['agency_id'] ."' class='btn btn-outline-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
                        }
                        echo "</tr>";
                }
            ?>
        </tbody>    
    </table>

    <?php
        }
    ?>

</div>