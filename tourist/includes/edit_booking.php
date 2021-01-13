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
                $tourist_id     = $_SESSION['tourist_id'];
                $booking_id     = $_GET['edit'];
                $travel_style   = $_POST['travel_style'];
                $persons        = $_POST['persons'];
                $firstname      = htmlentities($_POST['tourist_firstname']);
                $lastname       = htmlentities($_POST['tourist_lastname']);
                $email          = htmlentities($_POST['tourist_email']);
                $contact        = htmlentities($_POST['tourist_contact']);
                $message        = $_POST['enquiry_message'];
                $date           = date("y.m.d");

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

                if($travel_style == '' || $persons == '' || $firstname == '' || $lastname == '' || $email == ''){
                    $_SESSION['error'] = 'Please Fill the Form';
                    header('Location: booking.php?page=edit_booking&edit='. $booking_id);
                    return;
                }else {
                    $stmt = $pdo->prepare('UPDATE bookings SET package_id = :package_id, tourist_id = :tourist_id, agency_id = :agency_id, persons = :persons, travel_style = :travel_style, tourist_firstname = :tourist_firstname, tourist_lastname = :tourist_lastname, tourist_email = :tourist_email, tourist_contact = :tourist_contact, enquiry_msg = :enquiry_msg, booking_status = :booking_status, date = :date WHERE booking_id = :booking_id');

                    $stmt->execute([':booking_id'           => $booking_id,
                                    ':package_id'           => $package_id,
                                    ':tourist_id'           => $tourist_id,
                                    ':agency_id'            => $agency_id,
                                    ':persons'              => $persons,
                                    ':travel_style'         => $travel_style,
                                    ':tourist_firstname'    => $firstname,
                                    ':tourist_lastname'     => $lastname,
                                    ':tourist_email'        => $email,
                                    ':tourist_contact'      => $tourist_contact,
                                    ':enquiry_msg'          => $message,
                                    ':booking_status'       => 'pending',
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
                include 'includes/flash_msg.php';

                $package_id = $booking['package_id'];

                $stmt = $pdo->prepare('SELECT * FROM packages WHERE package_id = :package_id');
                $stmt->execute([':package_id' => $package_id]);
                $package = $stmt->fetch(PDO::FETCH_ASSOC)
            ?>

            <form action="" method="post">
                <div class="my-5 pb-3">
                    <h2 class="p-2">Please Fill this Form</h2>
                    <div class="form-group p-2">
                        <label for="person">Persons</label>
                        <input type="number" name="persons" value="<?php echo $booking['persons']; ?>" id="" class="form-control">
                    </div>
                    <div class="form-group p-2">
                    <label for="travel_style">Travel Style</label>
                    <select name="travel_style" id="" class="custom-select">
                        <option value="<?php echo $booking['travel_style']; ?>"><?php echo ucwords($booking['travel_style']); ?> - 
                            <?php 
                                if($booking['travel_style'] == 'budget'){
                                    echo ucwords($package['budget_details']); 
                                }elseif($booking['travel_style'] == 'comfortable'){
                                    echo ucwords($package['comfort_details']); 
                                }else{
                                    echo ucwords($package['lux_details']); 
                                }
                            ?>
                        </option>
                        <?php
                            if($booking['travel_style'] == 'budget'){
                                echo '<option value="comfortable">Comfortable - '. ucwords($package['comfort_details']) .'</option>';
                                echo '<option value="luxury">Luxury - '. ucwords($package['lux_details']) .'</option>';
                            }elseif($booking['travel_style'] == 'comfortable'){
                                echo '<option value="budget">Budget - '. ucwords($package['budget_details']) .'</option>';
                                echo '<option value="luxury">Luxury - '. ucwords($package['lux_details']) .'</option>';
                            }else{
                                echo '<option value="budget">Budget - '. ucwords($package['budget_details']) .'</option>';
                                echo '<option value="comfortable">Comfortable - '. ucwords($package['comfort_details']) .'</option>';
                            }
                        ?>
                    </select>
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

        <div class="col-sm-4">
            <div class="card mt-5 effect">
                <div class="container">
                    <h2 class="p-2">Package Info</h2>
                    <div>
                        <h3 class="font-italic p-2"><a href="package.php?package_id=<?php echo $package_id; ?>"> <?php echo $package['package_name']; ?></a></h3>
                        <h5 class="font-italic text-info" style="font-size: 1rem;"><i class="fas fa-map-marker-alt"></i> <?php echo $package['location']. ',' .$package['country']; ?></h5>
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
                        <p class="font-weight-bold font-italic ml-2">Price (Per Person):</p>
                        <p class="font-italic" style="font-weight: 600;">
                            <span class="ml-3">Budget:</span> BDT <?php echo $package['budget_price']; ?>/-
                        </p>
                        <p class="font-italic" style="font-weight: 600;">
                            <span class="ml-3">Comfortable:</span> BDT <?php echo $package['comfort_price']; ?>/-
                        </p>
                        <p class="font-italic" style="font-weight: 600;">
                            <span class="ml-3">Luxury:</span> BDT <?php echo $package['lux_price']; ?>/-
                        </p>
                    </div>
                    <hr>
                    <div class="">
                        <p class="font-weight-bold font-italic">
                            <span class="mx-2">Booking Price:</span><?php echo $package['booking_percentage']; ?>%<span class="ml-2">of total price</span>
                        </p> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>