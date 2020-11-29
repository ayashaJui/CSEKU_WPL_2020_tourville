<?php

    //Booking Read Query
    if(isset($_GET['edit'])){
        $booking_id = $_GET['edit'];

        $stmt = $pdo->prepare('SELECT * FROM bookings WHERE booking_id = :booking_id');
        $stmt->execute([':booking_id' => $booking_id]);
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $package_id     = $booking['package_id'];
    $agency_id      = $booking['agency_id'];
    $booking_status = $booking['booking_status'];

    if(isset($_SESSION['tourist_email'])){
        if(isset($_GET['edit'])){
            if(isset($_POST['update_book'])){
                $tourist_id = $_SESSION['tourist_id'];
                $booking_id = $_GET['edit'];
                $check_in   = $_POST['check_in'];
                $persons    = $_POST['persons'];
                $firstname  = htmlentities($_POST['tourist_firstname']);
                $lastname   = htmlentities($_POST['tourist_lastname']);
                $email      = htmlentities($_POST['tourist_email']);
                $contact    = htmlentities($_POST['tourist_contact']);
                $message    = $_POST['enquiry_message'];
                $date       = date("y.m.d");

                // $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                // $stmt->execute([':package_id' => $package_id]);
                // $package = $stmt->fetch(PDO::FETCH_ASSOC);

                //$total_price = $package['package_price']*persons;

                //contact no validation
                $tourist_contact = '';
                if(!empty($contact)){
                    $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
                    if(!preg_match($pattern, $contact)){
                        $_SESSION['error'] = 'Invalid Contact Info';
                        header('Location: booking.php?page=edit_booking&edit='. $booking_id);
                        return;
                    }else{
                        $tourist_contact = $contact;
                    }
                }

                if($check_in == '' || $persons == '' || $firstname == '' || $lastname == '' || $email == ''){
                    $_SESSION['error'] = 'Please Fill the Form';
                    header('Location: booking.php?page=edit_booking&edit='. $booking_id);
                    return;
                }else {
                    $stmt = $pdo->prepare('UPDATE bookings SET package_id = :package_id, tourist_id = :tourist_id, agency_id = :agency_id, persons = :persons, check_in = :check_in, tourist_firstname = :tourist_firstname, tourist_lastname = :tourist_lastname, tourist_email = :tourist_email, tourist_contact = :tourist_contact, enquiry_msg = :enquiry_msg, booking_status = :booking_status, date = :date WHERE booking_id = :booking_id');

                    $stmt->execute([':booking_id'           => $booking_id,
                                    ':package_id'           => $package_id,
                                    ':tourist_id'           => $tourist_id,
                                    ':agency_id'            => $agency_id,
                                    ':persons'              => $persons,
                                    ':check_in'             => $check_in,
                                    ':tourist_firstname'    => $firstname,
                                    ':tourist_lastname'     => $lastname,
                                    ':tourist_email'        => $email,
                                    ':tourist_contact'      => $tourist_contact,
                                    ':enquiry_msg'          => $message,
                                    ':booking_status'       => $booking_status,
                                    ':date'                 => $date]);

                    $_SESSION['success'] = "Your Request has been Submitted. PLease Wait...";
                    header('Location: mybookings.php');
                    return;
                }
            }
        }
    }
?>

<div class="container">
    <h2 class="p-2">Edit Booking Info</h2>

    <div class="row">
        <div class="col-sm-8">
            
            <?php
                include 'includes/flash_msg.php'
            ?>

            <form action="" method="post">
                <div class="my-5 pb-3">
                    <h2 class="p-2">Please Fill this Form</h2>
                    <div class="form-group p-2">
                        <label for="check_in">Check In</label>
                        <input type="date" name="check_in" value="<?php echo $booking['check_in']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="person">Persons</label>
                        <input type="number" name="persons" value="<?php echo $booking['persons']; ?>" id="" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="my-5 pt-2">
                    <h2 class="p-2">Your Personal Information</h2>
                    <div class="form-group p-2">
                        <label for="firstname">First Name</label>
                        <input type="text" name="tourist_firstname" value="<?php echo $booking['tourist_firstname']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="firstname">Last Name</label>
                        <input type="text" name="tourist_lastname" value="<?php echo $booking['tourist_lastname']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="email">Email</label>
                        <input type="email" name="tourist_email" value="<?php echo $booking['tourist_email']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="contact">Contact</label>
                        <input type="text" name="tourist_contact" value="<?php echo $booking['tourist_contact']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                        <label for="enquiry_message">Message To Agency</label>
                        <textarea name="enquiry_message" value="<?php echo $booking['enquiry_msg']; ?>" id="body" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group p-2">
                    <input type="submit" value="Update" name="update_book" class="btn btn-primary">
                    <!-- <a href="mybooking.php" type="submit" name="book" class="btn btn-primary">Book</a> -->
                    <a href="mybookings.php" class="btn btn-secondary float-right">Cancel</a>
                </div>
            </form>
        </div>

        <?php
            $package_id = $booking['package_id'];

            $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
            $stmt->execute([':package_id' => $package_id]);
            $package = $stmt->fetch(PDO::FETCH_ASSOC)
            
        ?>

        <div class="col-sm-4">
            <div class="card mt-5">
                <div class="container">
                    <h2 class="p-2">Package Info</h2>
                    <div>
                        <h3 class="font-italic p-2"><a href="package.php?package_id=<?php echo $package_id; ?>"> <?php echo $package['package_name']; ?></a></h3>
                        <h5 class="font-italic text-info" style="font-size: 1rem;"><i class="fas fa-map-marker-alt"></i> <?php echo $package['location']. ',' .$package['country']; ?></h5>
                    </div>
                    <div>
                        <p class="float-right" style="position: relative; top: -30px; font-size: .8rem;">
                            <span class="text-muted mr-1">4.0</span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-active"></span>
                            <span class="fa fa-star star-inactive"></span>
                        </p>
                    </div>
                    <hr>

                    <?php
                        $agency_id = $booking['agency_id'];

                        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                        $stmt->execute([':agency_id' => $agency_id]);
                        $agency = $stmt->fetch(PDO::FETCH_ASSOC)
                    ?>

                    <div class="">
                        Arranged by: <a href="agency.php?agency_id=<?php echo $package['agency_id']; ?>" class="mr-3"><?php echo $agency['agency_name']; ?></a>
                    </div>
                    <hr>
                    <div class="">
                        <p>
                            <span class="mr-1"><i class="far fa-clock"></i></span>
                            <?php echo $package['num_days']. ' days '. $package['num_nights'] .' nights'; ?>
                        </p>
                    </div>
                    <hr>
                    <div class="">
                        <p class="font-weight-bold font-italic"><span class="ml-2">Price:</span> BDT <?php echo $package['package_price']; ?>/-<span class="ml-2">per person</span></p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>