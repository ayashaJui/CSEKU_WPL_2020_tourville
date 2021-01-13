<?php
    include 'includes/db.php';
    include 'includes/functions.php';
    require 'vendor/autoload.php';

    // Stripe API Key
    $stripe = new \Stripe\StripeClient(
    'sk_test_51I2VszFRq96Mv30adt48SkZsYWrICf1xCl47sv40GxlV9GFZWcu3O0e9fsUaIZy6fBhKgRGLuQcUxDGEh8xd0iEC000wfHTLWc'
    );

    $stripeToken = $_POST['stripeToken'];

    if(isset($_GET['booking_id'])){
        $booking_id = $_GET['booking_id'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        $package = readPackage($booking['package_id']);
        $tourist = readTourist($booking['tourist_id']);

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


        $payment_type   = $_POST['payment'];
        $card_name      = htmlentities($_POST['card_name']);
        $date           = date("y.m.d");

        $amount = '';
        if($payment_type == 'book_price'){
            $amount = $book;
        }elseif($payment_type == 'half'){
            $amount = $half;
        }else{
            $amount = $total;
        }

        //card token
        $card = $stripe->customers->createSource(
            $tourist['tourist_stripe'],
            ['source' => $stripeToken]
        );

        //Chareg customer
        $charge = $stripe->charges->create([
            'amount' => $amount*100,
            'currency' => 'BDT',
            'customer' => $tourist['tourist_stripe'],
        ]);

        if(empty($card_name)){
            $_SESSION['error'] = 'Please Fill the Card Holder Name';
            header('Location: payment.php?booking_id='. $booking_id);
            return;
        }else{
            $stmt = $pdo->prepare('INSERT INTO payments(booking_id, package_id, agency_id, tourist_id, amount, currency, txn_id, payment_type, payment_status, card_name,  tour_status, date) VALUES(:booking_id, :package_id,  :agency_id, :tourist_id, :amount, :currency, :txn_id, :payment_type, :payment_status, :card_name, :tour_status, :date)');

            $stmt->execute([':booking_id'       => $booking_id,
                            ':package_id'       => $package_id,
                            ':agency_id'        => $agency_id,
                            ':tourist_id'       => $tourist_id,
                            ':amount'           => $amount,
                            ':currency'         => $charge->currency,
                            ':txn_id'           => $charge->balance_transaction,
                            ':payment_type'     => $payment_type,
                            ':payment_status'   => $charge->status,
                            ':card_name'        => $card_name,
                            ':tour_status'      => 'not stared',
                            ':date'             => $date]);

            //$_SESSION['success'] = "Thank You For Trusting Us..";
            header('Location: success.php?payment_id='. $pdo->lastInsertId());
            return;
        }
    }
?>