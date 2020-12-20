<?php
    include 'includes/db.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(isset($_GET['booking_id'])){
        $booking_id = $_GET['booking_id'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        $package_id = $booking['package_id'];
        $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
        $stmt->execute([':package_id' => $package_id]);
        $package = $stmt->fetch(PDO::FETCH_ASSOC);

        $tourist_id     = $booking['tourist_id'];
        $agency_id      = $booking['agency_id'];

        // $total = '';
        // $half = '';
        // $book = '';
        if($booking['travel_style'] == 'luxury'){
            $total  = $package['lux_price'] * $booking['persons'];
            $half   = $total / 2;
            $book   = ceil(($package['booking_percentage'] / 100) * $total);
        }elseif($booking['travel_style'] == 'comfortable'){
            $total  = $package['comfort_price'] * $booking['persons'];
            $half   = $total / 2;
            $book   = ceil(($package['booking_percentage'] / 100) * $total);
        }else{
            $total  = $package['budget_price'] * $booking['persons'];
            $half   = $total / 2;
            $book   = ceil(($package['booking_percentage'] / 100) * $total);
        }

        if(isset($_POST['pay'])){
            $payment_status = $_POST['payment'];
            $card_name      = htmlentities($_POST['card_name']);
            $card_number    = htmlentities($_POST['card_number']);
            $expire_date    = htmlentities($_POST['expire_date']);
            $date           = date("y.m.d");

            $amount = '';
            if($payment_status == 'book_price'){
                $amount = $book;
            }elseif($payment_status == 'half'){
                $amount = $half;
            }else{
                $amount = $total;
            }
            if(empty($card_name) || empty($card_number) || empty($expire_date) || empty($amount)){
                $_SESSION['error'] = 'Please Fill the Form';
                header('Location: payment.php?booking_id='. $booking_id);
                return;
            }else{
                $stmt = $pdo->prepare('INSERT INTO payments(booking_id, agency_id, tourist_id, amount, payment_status, card_name, card_number, expire_date, tour_status, date) VALUES(:booking_id,  :agency_id, :tourist_id, :amount, :payment_status, :card_name, :card_number, :expire_date, :tour_status, :date)');

                $stmt->execute([':booking_id'       => $booking_id,
                                ':agency_id'        => $agency_id,
                                ':tourist_id'       => $tourist_id,
                                ':amount'           => $amount,
                                ':payment_status'   => $payment_status,
                                ':card_name'        => $card_name,
                                ':card_number'      => $card_number,
                                ':expire_date'      => $expire_date,
                                ':tour_status'      => 'not stared',
                                ':date'             => $date]);

                $_SESSION['success'] = "Thank You For Trusting Us..";
                header('Location: mybookings.php');
                return;
            }
        }
    }

?>
<head>
    <style>
        .package {
            background-image: url("images/view/payment.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 50vh;
        }

        .star-active {
            color: #fbc02d;
        }

        .star-active:hover {
            color: #f9a825;
            cursor: pointer;
        }

        .star-inactive {
            color: #cfd8dc;
        }

    </style>
    
</head>

<br><br><br>
<div class="jumbotron jumbotron-fluid package">
  <div class="container">
    <h1 class="display-4 text-white text-center font-weight-bold">Package Booking</h1>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-8">
        <?php
            include 'includes/flash_msg.php'
        ?>
            <form action="" method="post">
                <div class="my-5">
                    <h2 class="p-2">Your Credit or Debit Card Information</h2>
                    <div class="form-group p-2">
                        <label for="card_name">Card Holder Name</label>
                        <input type="text" name="card_name" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="card_number">Card Number</label>
                        <input type="number" name="card_number" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="expire_date">Expiration Date</label>
                        <input type="date" name="expire_date" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <input type="radio" name="payment" id="" value="book_price" checked>
                        <label for="book_price">Booking Price: <span class="ml-2"><?php echo $book; ?>/-</span></label><br>
                        <input type="radio" name="payment" id="" value="half">
                        <label for="half">Half Payment: <span class="ml-2"><?php echo $half; ?>/-</span></label><br>
                        <input type="radio" name="payment" id="" value="full">
                        <label for="full">Full Payment: <span class="ml-2"><?php echo $total; ?>/-</span></label><br>
                    </div>
                    <div class="form-group p-2">
                        <input type="submit" value="Pay" name="pay" class="btn btn-primary">

                        <a href="mybookings.php" class="btn btn-secondary float-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <div class="card mt-5">
                <div class="container font-italic">

                <?php
                    $package_id = $booking['package_id'];

                    $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                    $stmt->execute([':package_id' => $package_id]);
                    $package = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>

                    <h3 class="py-2"><a href="package.php?package_id=<?php echo $booking['package_id']; ?>"> <?php echo $package['package_name']; ?></a></h3>
                    
                    <div class="">

                    <?php
                        $agency_id = $booking['agency_id'];

                        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                        $stmt->execute([':agency_id' => $agency_id]);
                        $agency = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                        Arranged by: <br> <a href="agency.php?agency_id=<?php echo $booking['agency_id']; ?>" class="mr-3"><?php echo $agency['agency_name']; ?></a>
                    </div>
                    <hr>
                    <div class="py-2">
                        Travel Style: <br>
                        <?php echo ucwords($booking['travel_style']); ?> - 
                        <?php
                            if($booking['travel_style'] == 'budget'){
                                echo ucwords($package['budget_details']); 
                            }elseif($booking['travel_style'] == 'comfortable'){
                                echo ucwords($package['comfort_details']); 
                            }else{
                                echo ucwords($package['lux_details']); 
                            }
                            
                        ?>
                    </div>
                    <div class="py-2">
                        Persons: <br>
                        <?php echo $booking['persons']; ?>
                    </div>
                    <hr>
                    <div class="">
                        <p class="font-weight-bold font-italic"><span class="ml-2">Price:</span> BDT 
                        <?php
                            if($booking['travel_style'] == 'luxury'){
                                echo $package['lux_price']; 
                            }elseif($booking['travel_style'] == 'comfortable'){
                                echo $package['comfort_price']; 
                            }else{
                                echo ucwords($package['budget_price']); 
                            }
                            
                        ?>/- 
                        <span class="ml-2">per person</span>
                        <p class="font-weight-bold font-italic"><span class="ml-2">Total Price:</span> BDT <?php echo $total; ?>/-
                        <p class="font-weight-bold font-italic text-danger"><span class="mx-2">Booking Price:</span>BDT <?php echo $book; ?>/-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>