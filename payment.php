<?php
    include 'includes/db.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

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
            <form action="" method="post">
                <div class="my-5">
                    <h2 class="p-2">Your Credit or Debit Card Information</h2>
                    <div class="form-group p-2">
                        <label for="card_holder_name">Card Holder Name</label>
                        <input type="text" name="card_holder_name" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="card_number">Card Number</label>
                        <input type="number" name="card_number" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="expiration_date">Expiration Date</label>
                        <input type="date" name="expiration_date" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <input type="radio" name="payment_type" id="" value="full" checked>
                        <label for="full">Full Payment</label><br>
                        <input type="radio" name="payment_type" id="" value="half">
                        <label for="half">Half Payment</label>
                    </div>
                    <div class="form-group p-2">
                        <input type="submit" value="Submit" name="booked" class="btn btn-primary">

                        <a href="mybookings.php" class="btn btn-secondary float-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <?php
            if(isset($_GET['booking_id'])){
                $booking_id = $_GET['booking_id'];

                $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
                $stmt->execute([':booking_id' => $booking_id]);
                $booking = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        ?>

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
                    <div>
                        <p class="float-right" style="position: relative; top: -30px;">
                            <span class="text-muted mr-3">4.0</span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-inactive"></span>
                        </p>
                    </div>
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
                        Check in Date: <br>
                        <?php echo $booking['check_in']; ?>
                    </div>
                    <div class="py-2">
                        Persons: <br>
                        <?php echo $booking['persons']; ?>
                    </div>
                    <hr>
                    <div class="">
                        <p class="font-weight-bold font-italic"><span class="ml-2">Total Price:</span> BDT <?php echo $package['package_price']*$booking['persons']; ?>/-
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