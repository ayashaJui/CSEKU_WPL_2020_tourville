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

        //Booking Read Query
        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $bookings = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bookings[] = $row;
        }
    }

    //Booking Confirm Query
    if(isset($_GET['confirm'])){
        $booking_id = $_GET['confirm'];

        $stmt = $pdo->prepare('UPDATE bookings SET booking_status = :booking_status WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id'       => $booking_id,
                        ':booking_status'   => 'confirm']);
        $_SESSION['success'] = 'Booking status set to Confirm';
        header('Location: bookings.php');
        return;
    }

    //Booking Pending Query
    if(isset($_GET['pending'])){
        $booking_id = $_GET['pending'];

        $stmt = $pdo->prepare('UPDATE bookings SET booking_status = :booking_status WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id'       => $booking_id,
                        ':booking_status'   => 'pending']);
        $_SESSION['success'] = 'Booking status set to Pending';
        header('Location: bookings.php');
        return;
    }

    //Booking Reject Query
    if(isset($_GET['reject'])){
        $booking_id = $_GET['reject'];

        $stmt = $pdo->prepare('UPDATE bookings SET booking_status = :booking_status WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id'       => $booking_id,
                        ':booking_status'   => 'reject']);
        $_SESSION['success'] = 'Booking status set to Reject';
        header('Location: bookings.php');
        return;
    }
?>

<!-- <head>
    <link rel="stylesheet" href="../css/agency.php">
</head> -->

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
                    <li class="breadcrumb-item active">Booking Details</li>
                </ol>
                <div class="container-fluid">

                <?php

                    include '../includes/flash_msg.php';

                    if(empty($bookings)){
                        echo '<h1 class="text-center pt-4">No Bookings to Show</h1>';
                    }else {
                    
                ?>

                    <div class="col-xs-12">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Booked By</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Package Name</th>
                                    <th>Travel Style</th>
                                    <th>Persons</th>
                                    <th>Total Price</th>
                                    <th>Booking Status</th>
                                    <th>Date</th>
                                    <th>Confirm</th>
                                    <th>Pending</th>
                                    <th>Reject</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                foreach($bookings as $booking){
                                    if($booking['booking_status'] == 'pending'){
                                        echo '<tr class="table-warning">';
                                    }elseif ($booking['booking_status'] == 'reject') {
                                        echo '<tr class="table-danger">';
                                    }else{
                                        echo '<tr>';
                                    }
                                            echo '<td>'. $booking['booking_id'] .'</td>';
                                            echo '<td>'. $booking['tourist_firstname'] .' '. $booking['tourist_lastname'] .'</td>';
                                            echo '<td>'. $booking['tourist_email'] .'</td>';
                                            echo '<td>'. $booking['tourist_contact'] .'</td>';

                                            //Package Name Read Query
                                            $package = readPackage($booking['package_id']);

                                            echo '<td><a href="../package.php?package_id='. $booking['package_id'] .'">'. $package['package_name'] .'</a></td>';

                                            echo '<td>'. ucwords($booking['travel_style']) .'</td>';
                                            echo '<td>'. $booking['persons'] .'</td>';

                                            if($booking['travel_style'] == 'luxury'){
                                                $total = $package['lux_price'] * $booking['persons'];
                                            }elseif($booking['travel_style'] == 'comfortable'){
                                                $total = $package['comfort_price'] * $booking['persons'];
                                            }else{
                                                $total = $package['budget_price'] * $booking['persons'];
                                            }
                                            echo '<td>'. $total .'</td>';
                                            echo '<td>'. ucwords($booking['booking_status']) .'</td>';
                                            echo '<td>'. $booking['date'] .'</td>';

                                        if($booking['booking_status'] == 'pending' || $booking['booking_status'] == 'reject'){
                                            echo '<td><a href="bookings.php?confirm='. $booking['booking_id'] .'" class="btn btn-success mt-1">Confirm</a></td>';
                                            echo '<td><a href="bookings.php?pending='. $booking['booking_id'] .'" class="btn btn-secondary mt-1">Pending</a></td>';
                                            echo '<td><a href="bookings.php?reject='. $booking['booking_id'] .'" class="btn btn-danger mt-1">Reject</a></td>';
                                        }else{
                                            echo '<td><a href="bookings.php?confirm='. $booking['booking_id'] .'" class="btn btn-outline-success mt-1">Confirm</a></td>';
                                            echo '<td><a href="bookings.php?pending='. $booking['booking_id'] .'" class="btn btn-outline-secondary mt-1">Pending</a></td>';
                                            echo '<td><a href="bookings.php?reject='. $booking['booking_id'] .'" class="btn btn-outline-danger mt-1">Reject</a></td>';
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