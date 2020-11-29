<?php

    //Tourist Read Query
    $stmt = $pdo->query('SELECT * FROM tourists ');
    $stmt->execute();
    $tourists = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $tourists[] = $row;
    }

    //Tourist Approve Query
    if(isset($_GET['approve'])){
        $tourist_id = $_GET['approve'];

        $stmt = $pdo->prepare('UPDATE tourists SET tourist_status = :tourist_status WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id'     => $tourist_id,
                        ':tourist_status' => 'approved']);
        $_SESSION['success'] = 'Tourist status set to Approved';
        header('Location: tourists.php');
        return;
    }

    //Tourist Unapprove Query
    if(isset($_GET['unapprove'])){
        $tourist_id = $_GET['unapprove'];

        $stmt = $pdo->prepare('UPDATE tourists SET tourist_status = :tourist_status WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id'     => $tourist_id,
                        ':tourist_status' => 'unapproved']);
        $_SESSION['success'] = 'Tourist status set to Unpproved';
        header('Location: tourists.php');
        return;
    }

    //Tourist Delete Query
    if(isset($_GET['delete'])){
        $tourist_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $_SESSION['success'] = 'Successfully Deleted  Tourist Info';
        header('Location: tourists.php');
        return;
    }
?>

<div class="col-xs-12">

    <?php
        include '../includes/flash_msg.php';

        if(empty($tourists)){
            echo '<h1 class="text-center pt-4">No Tourist Found</h1>';
        }else{

    ?>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usename</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Profile Picture</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Status</th>
                <th>Date</th>
                <th>Approve</th>
                <th>Unapprove</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
            foreach($tourists as $tourist){
                if($tourist['tourist_status'] == 'unapproved'){
                    echo "<tr class='table-warning'>";
                }else{
                    echo "<tr>";
                }              
                        echo "<td>". $tourist['tourist_id'] ."</td>";
                        echo "<td>". $tourist['tourist_username'] ."</td>";
                        echo "<td>". ucwords($tourist['tourist_firstname']) ."</td>";
                        echo "<td>". ucwords($tourist['tourist_lastname']) ."</td>";
                        echo "<td>". $tourist['tourist_email'] ."</td>";
                        echo "<td><img src='../images/". $tourist['profile_image'] ."' width='100' height='100' alt='". $tourist['tourist_username'] ."'></td>";
                        echo "<td>". $tourist['tourist_contact'] ."</td>";
                        echo "<td>". $tourist['tourist_address'] ."</td>";
                        echo "<td>". ucwords($tourist['tourist_status']) ."</td>";
                        echo "<td>". $tourist['date']. "</td>";

                    if($tourist['tourist_status'] == 'unapproved'){
                        echo "<td><a href='tourists.php?approve=". $tourist['tourist_id'] ."' class='btn btn-success mt-1'>Approve</a></td>";
                        echo "<td><a href='tourists.php?unapprove=". $tourist['tourist_id'] ."' class='btn btn-secondary mt-1'>Unapprove</a></td>";
                        echo "<td><a href='tourists.php?page=edit_tourist&edit=". $tourist['tourist_id'] ."' class='btn btn-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
                        echo "<a href='tourists.php?delete=". $tourist['tourist_id'] ."' class='btn btn-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
                    }else {
                        echo "<td><a href='tourists.php?approve=". $tourist['tourist_id'] ."' class='btn btn-outline-success mt-1'>Approve</a></td>";
                        echo "<td><a href='tourists.php?unapprove=". $tourist['tourist_id'] ."' class='btn btn-outline-secondary mt-1'>Unapprove</a></td>";
                        echo "<td><a href='tourists.php?page=edit_tourist&edit=". $tourist['tourist_id'] ."' class='btn btn-outline-warning mr-1 mt-1'><i class='fas fa-edit'></i></a>";
                        echo "<a href='tourists.php?delete=". $tourist['tourist_id'] ."' class='btn btn-outline-danger mt-1'><i class='fas fa-trash-alt'></i></a></td>";
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