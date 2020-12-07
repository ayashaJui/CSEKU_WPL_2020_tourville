<?php
    include 'includes/db.php';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(empty($_SESSION['tourist_login']) || $_SESSION['tourist_login'] == ''){
        header('Location: includes/login.php');
        return;
    }

    if(isset($_SESSION['tourist_email'])){
        $tourist_id = $_SESSION['tourist_id'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $bookings = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $bookings[] = $row;
        }
    }
    if(isset($_GET['delete'])){
        $booking_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);

        $_SESSION['success'] = 'Booking has been Deleted';
        header('Location: mybookings.php');
        return;
    }

?>

<head>
    <style>
        .mybooking {
            background-image: url("images/view/mybooking.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 50vh;
        }
    </style>
</head>

<br><br><br>
<div class="jumbotron jumbotron-fluid mybooking">
  <div class="container"><br>
    <h1 class="display-4 text-white text-center font-weight-bold">My Booking Info</h1>
  </div>
</div>

<div class="container">

    <?php
        include 'includes/flash_msg.php';

        if(empty($bookings)){
            echo '<h1 class="text-center pt-4">No Bookings to Show</h1>';
        }else{

    ?>

    <table class="table table-bordered table-hover mt-5">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Package Name</th>
                <th>Agency Name</th>
                <th>Booking Status</th>
                <th>Check In</th>
                <th>Persons</th>
                <th>Booking Date</th>
                <th>Total Price</th>
                <th>Booking Price</th>
                <th>Payment status</th>
                <th>Tour Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($bookings as $booking){
                echo '<tr>';
                    echo '<td>'. $booking['booking_id'] .'</td>';

                    //Package Name Reading From packages Table
                    $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                    $stmt->execute([':package_id' => $booking['package_id']]);
                    $package = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo '<td><a href="package.php?package_id='. $booking['package_id'] .'">'. $package['package_name'] .'</a></td>';

                    //Agency Name Reading From agencies Table
                    $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                    $stmt->execute([':agency_id' => $package['agency_id']]);
                    $agency = $stmt->fetch(PDO::FETCH_ASSOC);

                    echo '<td><a href="agency.php?agency_id='. $package['agency_id'] .'">'. $agency['agency_name'] .'</a></td>';
                    echo '<td>'. ucwords($booking['booking_status']) .'</td>';
                    echo '<td>'. $booking['check_in'] .'</td>';
                    echo '<td>'. $booking['persons'] .'</td>';
                    echo '<td>'. $booking['date'] .'</td>';

                    $total = $package['package_price'] * $booking['persons'];
                    echo '<td>'. $total .'</td>';

                    $book =  ceil(($package['booking_percentage'] / 100) * $total);
                    echo '<td>'. $book .'</td>';

                    //Reading Payment data
                    $stmt = $pdo->prepare('SELECT * FROM payments WHERE booking_id = :booking_id');
                    $stmt->execute([':booking_id' => $booking['booking_id']]);
                    $payemnt = $stmt->fetch(PDO::FETCH_ASSOC);

                    if($booking['booking_status'] == 'confirm' && empty($payemnt)){
                        echo '<td><a href="payment.php?booking_id='. $booking['booking_id'] .'" class="btn btn-primary">Pay</a></td>';
                    }elseif($booking['booking_status'] == 'confirm' && !empty($payemnt)){
                        // echo '<td><a href="#" class="btn btn-primary" id="payment_id" data-toggle="modal" data-target="#exampleModal">Paid</a></td>';
                        echo '<td class="font-weight-bold">Paid</td>';
                    }else {
                        echo '<td><a href="payment.php?booking_id='. $booking['booking_id'] .'" class="btn btn-primary disabled">Pay</a></td>';
                    }

                    if(!empty($payemnt)){
                        echo '<td>'. ucwords($payemnt['tour_status']) .'</td>';
                    }else{
                        echo '<td></td>';
                    }
                    if($booking['booking_status'] == 'pending'){
                        echo '<td><a  href="booking.php?page=edit_booking&edit='. $booking['booking_id'] .'" class="btn btn-warning mt-1 mr-1"><i class="fas fa-edit"></i></a>';
                        echo '<a href="mybookings.php?delete='. $booking['booking_id'] .'" class="btn btn-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                    }else {
                        echo '<td><a  href="mybooking.php?page=edit_mybooking&edit='. $booking['booking_id'] .'" class="btn btn-warning mt-1 mr-1 disabled"><i class="fas fa-edit"></i></a>';
                        echo '<a href="mybookings.php?delete='. $booking['booking_id'] .'" class="btn btn-danger mt-1 disabled"><i class="fas fa-trash-alt"></i></a></td>';
                    }

                echo '</tr>';
            }
        ?> 
        </tbody>
    </table>

    <?php
        }
    ?>
</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>