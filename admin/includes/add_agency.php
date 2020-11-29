<?php

    //Agency Insert Query....Added by Admin
    if(isset($_POST['create_agency'])){
        $agency_name     = htmlentities($_POST['agency_name']);
        $owner_firstname = htmlentities($_POST['owner_firstname']);
        $owner_lastname  = htmlentities($_POST['owner_lastname']);
        $agency_email    = htmlentities($_POST['agency_email']);
        $agency_contact  = htmlentities($_POST['agency_contact']);
        $agency_address  = htmlentities($_POST['agency_address']);
        $date            = date("y.m.d");

        $agency_password = htmlentities($_POST['agency_password']);

         //Empty Field Validation
        if($agency_name == '' || $owner_firstname == '' || $owner_lastname == '' || $agency_email == '' || $agency_password == '' || $agency_contact == '' || $agency_address == ''){
            $_SESSION['error'] = 'All fields are required';
            header('Location: agencies.php?page=add_agency');
            return;
        }

        //contact no validation
        $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
        $contact = '';
        if(!preg_match($pattern, $agency_contact)){
            $_SESSION['error'] = 'Invalid Contact Info';
            header("Location: agencies.php?page=add_agency");
            return;
        }else{
            $contact = $agency_contact;
        }

        //Agency Name Validation
        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_name = :agency_name');
        $stmt->execute([':agency_name' => $agency_name]);
        $agency_names = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agency_names[] = $row;
        }
        if(!empty($agency_names)){
            $_SESSION['error'] = 'Agency Name already exist. Please try something else';
            header('Location: agencies.php?page=add_agency');
            return;
        }

        //Agency Email Validation
        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_email = :agency_email');
        $stmt->execute([':agency_email' => $agency_email]);
        $agency_emails = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agency_emails[] = $row;
        }
        if(!empty($agency_emails)){
            $_SESSION['error'] = 'Email Address already exist. Please try something else';
            header('Location: agencies.php?page=add_agency');
            return;
        }
        else{
            $stmt = $pdo->prepare('INSERT INTO agencies(agency_name, owner_firstname, owner_lastname, agency_email, agency_password, logo_image, cover_image, agency_contact, agency_address, agency_status, date) VALUES(:agency_name, :owner_firstname, :owner_lastname, :agency_email, :agency_password, :logo_image, :cover_image, :agency_contact, :agency_address, :agency_status, :date)');

            $stmt->execute([':agency_name'      => $agency_name,
                            ':owner_firstname'  => $owner_firstname,
                            ':owner_lastname'   => $owner_lastname,
                            ':agency_email'     => $agency_email,
                            ':agency_password'  => $agency_password,
                            ':logo_image'       => '',
                            ':cover_image'      => '',
                            ':agency_contact'   => $contact,
                            ':agency_address'   => $agency_address,
                            ':agency_status'    => 'approved',
                            ':date'             => $date]);

            $_SESSION['success'] = 'New Agency Added';
            header('Location: agencies.php');
            return;
        }
    }
?>

<br>
<div class="container">
    <h2 class="p-2 pb-5">Add Agency</h2>

    <?php
        include '../includes/flash_msg.php';
    ?>
    
    <form action="" method="post" class="col-md-8">
        <div class="form-group pb-2">
            <label for="agency_name">Agency Name</label>
            <input type="text" class="form-control" id="" name="agency_name">
        </div>
        <div class="form-group p-2">
            <label for="owner_firstname">Owner's First Name</label>
            <input type="text" class="form-control" id="" name="owner_firstname">
        </div>
        <div class="form-group p-2">
            <label for="owner_lastname">Owner's Last Name</label>
            <input type="text" class="form-control" id="" name="owner_lastname">
        </div>
        <div class="form-group p-2">
            <label for="agency_email">Email address</label>
            <input type="email" class="form-control" id="" name="agency_email">
        </div>
        <div class="form-group p-2">
            <label for="agency_password">Password</label>
            <input type="password" class="form-control" id="" name="agency_password">
        </div>
        <div class="form-group p-2">
            <label for="agency_contact">Contact Number</label>
            <input type="text" class="form-control" id="" name="agency_contact">
        </div>
        <div class="form-group p-2">
            <label for="agency_address">Office Address</label>
            <input type="text" class="form-control" id="" name="agency_address">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Add Agency" name="create_agency" class="btn btn-primary">

            <a href="agencies.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>