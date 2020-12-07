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

        //Payment Read Query
        $stmt = $pdo->prepare('SELECT * FROM payments WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $payments = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $payments[] = $row;
        }
    }

    //Tour Travel Query
    if(isset($_GET['travel'])){
        $payment_id = $_GET['travel'];

        $stmt = $pdo->prepare('UPDATE payments SET tour_status = :tour_status WHERE payment_id = :payment_id');
        $stmt->execute([':payment_id'       => $payment_id,
                        ':tour_status'   => 'travelling']);
        $_SESSION['success'] = 'Tour status set to Travelling';
        header('Location: payments.php');
        return;
    }

    //tour complete Query
    if(isset($_GET['complete'])){
        $payment_id = $_GET['complete'];

        $stmt = $pdo->prepare('UPDATE payments SET tour_status = :tour_status WHERE payment_id = :payment_id');
        $stmt->execute([':payment_id'       => $payment_id,
                        ':tour_status'   => 'completed']);
        $_SESSION['success'] = 'Tour status set to Completed';
        header('Location: payments.php');
        return;
    }

    //tour not_start Query
    if(isset($_GET['not_start'])){
        $payment_id = $_GET['not_start'];

        $stmt = $pdo->prepare('UPDATE payments SET tour_status = :tour_status WHERE payment_id = :payment_id');
        $stmt->execute([':payment_id'    => $payment_id,
                        ':tour_status'   => 'not started']);
        $_SESSION['success'] = 'Tour status set to Not Started';
        header('Location: payments.php');
        return;
    }
?>

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
                    <li class="breadcrumb-item active">Payment Details</li>
                </ol>
                <div class="container-fluid">

                <?php

                    include '../includes/flash_msg.php';

                    if(empty($payments)){
                        echo '<h1 class="text-center pt-4">No Payments to Show</h1>';
                    }else {
                    
                ?>

                    <div class="col-xs-12">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Package Name</th>
                                    <th>Booked By</th>
                                    <th>Card Holder Name</th>
                                    <th>Card Number</th>
                                    <th>Expiration Date</th>
                                    <th>Payment Status</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Tour Status</th>
                                    <th>Travelling</th>
                                    <th>Completed</th>
                                    <th>Not Started</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                                foreach($payments as $payment){
                                    if($payment['tour_status'] == 'travelling'){
                                        echo '<tr class="table-warning">';
                                    }elseif ($payment['tour_status'] == 'completed') {
                                        echo '<tr class="table-danger">';
                                    }else{
                                        echo '<tr>';
                                    }
                                            echo '<td>'. $payment['payment_id'] .'</td>';
                                            //Package Name Read Query
                                            $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
                                            $stmt->execute([':booking_id' => $payment['booking_id']]);
                                            $booking = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                                            $stmt->execute([':package_id' => $booking['package_id']]);
                                            $package = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo '<td><a href="../package.php?package_id='. $package['package_id'] .'">'. $package['package_name'] .'</a></td>';

                                            $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
                                            $stmt->execute([':booking_id' => $payment['booking_id']]);
                                            $booking = $stmt->fetch(PDO::FETCH_ASSOC);

                                            echo '<td>'. ucwords($booking['tourist_firstname']) .' '. ucwords($booking['tourist_lastname']) .'</td>';
                                            echo '<td>'. $payment['card_name'] .'</td>';
                                            echo '<td>'. $payment['card_number'] .'</td>';
                                            echo '<td>'. $payment['expire_date'] .'</td>';

                                        if($payment['payment_status'] == 'book_price'){
                                            echo '<td>Booking Price</td>';
                                        }elseif($payment['payment_status'] == 'half'){
                                            echo '<td>Half Paid</td>';
                                        }else{
                                            echo '<td>Full Paid</td>';
                                        }
                                            echo '<td>'. $payment['date'] .'</td>';
                                            echo '<td>'. $payment['amount'] .'</td>';
                                            echo '<td>'. ucwords($payment['tour_status']) .'</td>';

                                        if($payment['tour_status'] == 'travelling' || $payment['tour_status'] == 'completed'){
                                            echo '<td><a href="payments.php?travel='. $payment['payment_id'] .'" class="btn btn-success mt-1">Travelling</a></td>';
                                            echo '<td><a href="payments.php?complete='. $payment['payment_id'] .'" class="btn btn-secondary mt-1">Completed</a></td>';
                                            echo '<td><a href="payments.php?not_start='. $payment['payment_id'] .'" class="btn btn-danger mt-1">Not Started</a></td>';
                                        }else{
                                            echo '<td><a href="payments.php?travel='. $payment['payment_id'] .'" class="btn btn-outline-success mt-1">Travelling</a></td>';
                                            echo '<td><a href="payments.php?complete='. $payment['payment_id'] .'" class="btn btn-outline-secondary mt-1">Completed</a></td>';
                                            echo '<td><a href="payments.php?not_start='. $payment['payment_id'] .'" class="btn btn-outline-danger mt-1">Not Started</a></td>';
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