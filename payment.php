<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';


    if(isset($_GET['booking_id'])){
        $booking_id = $_GET['booking_id'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        $package_id = $booking['package_id'];
        $package = readPackage($booking['package_id']);

        $tourist_id     = $booking['tourist_id'];
        $package_id     = $booking['package_id'];
        $agency_id      = $booking['agency_id'];

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
    }

?>
<head>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .package {
            background-image: url("images/view/payment.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 50vh;
        }

        .effect:hover{
            box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            -webkit-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            -moz-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            transition: box-shadow 0.2s ease-in-out;
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
            <form action="charge.php?booking_id=<?php if(isset($_GET['booking_id'])){echo $_GET['booking_id'];} ?>" method="post" id="payment-form">
                <div class="my-5">
                    <h2 class="p-2">Your Credit or Debit Card Information</h2>
                    <div class="form-group p-2">
                        <label for="card_name">Name on Card</label>
                        <input type="text" name="card_name" id="" class="form-control StripeElement">
                    </div>

                    <div class="form-group p-2">
                        <label for="">Card Information</label>
                        <div id="card-element" class="form-control">
                        <!-- A Stripe Element will be inserted here. -->
                        </div>
                        <!-- Used to display form errors. -->
                        <div id="card-errors" role="alert"></div>
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
                        <button class="btn btn-primary">Submit Payment</button>

                        <a href="mybookings.php" class="btn btn-secondary float-right">Cancel</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <div class="card mt-5 effect">
                <div class="container font-italic">

                <?php
                    $package_id = $booking['package_id'];
                    $package = readPackage($package_id);
                ?>

                    <h3 class="py-2"><a href="package.php?package_id=<?php echo $booking['package_id']; ?>"> <?php echo $package['package_name']; ?></a></h3>
                    
                    <div class="">

                    <?php
                        $agency_id = $booking['agency_id'];
                        $agency = readAgency($agency_id);
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
<script src="js/stripe.js"></script>

<?php
    include 'layouts/footer.php';
?>