<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';


    if(isset($_GET['payment_id'])){
        $payment_id = $_GET['payment_id'];

        $stmt = $pdo->prepare('SELECT * FROM payments WHERE payment_id = :payment_id');
        $stmt->execute([':payment_id'   => $payment_id]);
        $payment = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<head>
    <style>
        .package {
            background-image: url("images/view/success.jpg");
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
    <h1 class="display-4 text-center text-success font-weight-bold">
        <?php
            if(isset($_GET['payment_id'])){
                echo 'Payment';
            }
        ?>
    </h1>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card my-5 effect" style="background: #F4F6F6;">
                <div class="card-body p-5">
                    <h2 class="p-2 text-center font-weight-bold" style="color: #015022;">Your Transaction Has Been Completed</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">
        <h3 class="text-center mb-5"><span class="border-bottom border-5 border-primary p-2">Your Payment Details</span></h3>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 mx-auto" style="font-size: 1.2rem;">
                    <div class="card" style="border: none;">
                        <div class="card-body">
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Transaction ID: </span><?php echo $payment['txn_id']; ?>
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Payment Status: </span><?php echo ucwords($payment['payment_status']); ?>
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Amount: </span><?php echo strtoupper($payment['currency']) ." ". $payment['amount']; ?>/-
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Name on Card: </span><?php echo $payment['card_name']; ?>
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Payment Date: </span><?php echo $payment['date']; ?>
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Package: </span>
                                <?php 
                                    $package = readPackage($payment['package_id']); 
                                    echo '<a href="package.php?package_id='. $payment['package_id'] .'">'. ucwords($package['package_name']) .'</a>';
                                ?>
                            </div>
                            <hr>
                            <div class="p-2">
                                <span class="font-weight-bold mr-3">Agency: </span>
                                <?php 
                                    $agency= readAgency($payment['agency_id']); 
                                    echo '<a href="agency.php?agency_id='. $payment['agency_id'] .'">'. ucwords($agency['agency_name']) .'</a>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card mt-5" style="border: none;">
                <div class="card-body">
                    <h4 class="text-center text-success font-wight-bold font-italic" style="font-size: 2rem;">Thank You</h4>
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