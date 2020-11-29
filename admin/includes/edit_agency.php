<?php

    if(isset($_GET['edit'])){
        $agency_id = $_GET['edit'];

        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $agency_status = '';
        $agency_date = '';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $agency_status = $row['agency_status'];
            $agency_date = $row['date'];
        }

        if(isset($_POST['update_agency'])){
            $agency_name     = htmlentities($_POST['agency_name']);
            $owner_firstname = htmlentities($_POST['owner_firstname']);
            $owner_lastname  = htmlentities($_POST['owner_lastname']);
            $agency_email    = htmlentities($_POST['agency_email']);
            $agency_contact  = htmlentities($_POST['agency_contact']);
            $agency_address  = htmlentities($_POST['agency_address']);

            $agency_password = htmlentities($_POST['agency_password']);

            //uploading image in images folder
            $logo_img = $_FILES['logo_image']['name'];
            $logo_img_temp = $_FILES['logo_image']['tmp_name'];
            move_uploaded_file($logo_img_temp, "../images/$logo_img");
            if(empty($logo_img)){
                $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                $stmt->execute([':agency_id' => $agency_id]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $logo_img = $row['logo_image'];
                }
            }
            $cover_img = $_FILES['cover_image']['name'];
            $cover_img_temp = $_FILES['cover_image']['tmp_name'];
            move_uploaded_file($cover_img_temp, "../images/$cover_img");
            if(empty($cover_img)){
                $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                $stmt->execute([':agency_id' => $agency_id]);
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $cover_img = $row['cover_image'];
                }
            }

            //contact no validation
            $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
            $contact = '';
            if(!preg_match($pattern, $agency_contact)){
                $_SESSION['error'] = 'Invalid Contact Info';
                header("Location: agencies.php?page=edit_agency&edit=". $agency_id);
                return;
            }else{
                $contact = $agency_contact;
            }

            //Empty Field Validation
            if($agency_name == '' || $owner_firstname == '' || $owner_lastname == '' || $agency_email == '' || $agency_password == '' || $agency_contact == '' || $agency_address == ''){
                $_SESSION['error'] = 'Please Fill the form';
                header("Location: agencies.php?page=edit_agency&edit=". $agency_id);
                return;
            }else{
                $stmt = $pdo->prepare('UPDATE agencies SET agency_name = :agency_name, owner_firstname = :owner_firstname, owner_lastname = :owner_lastname, agency_email = :agency_email, agency_password = :agency_password, logo_image = :logo_image, cover_image = :cover_image, agency_contact = :agency_contact, agency_address = :agency_address, agency_status = :agency_status, date = :date WHERE agency_id = :agency_id');

                $stmt->execute([':agency_id'       => $agency_id,
                                ':agency_name'     => $agency_name,
                                ':owner_firstname' => $owner_firstname,
                                ':owner_lastname'  => $owner_lastname,
                                ':agency_email'    => $agency_email,
                                ':agency_password' => $agency_password,
                                ':logo_image'      => $logo_img,
                                ':cover_image'     => $cover_img,
                                ':agency_contact'  => $contact,
                                ':agency_address'  => $agency_address,
                                ':agency_status'   => $agency_status,
                                ':date'             => $agency_date]);

                $_SESSION['success'] = 'Agency Info Updated';
                header('Location: agencies.php');
                return;
            }
        }
    }
?>

<br>
<div class="container">
    <h2 class="p-2 pb-5">Update Agency</h2>

    <?php
        include '../includes/flash_msg.php';

        //Agency Read Query for specific id
        if(isset($_GET['edit'])){
            $agency_id = $_GET['edit'];

            $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
            $stmt->execute([':agency_id' => $agency_id]);
            $agency = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>

    <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
        <div class="form-group pl-2 pb-2">
            <label for="agency_name">Agency Name</label>
            <input type="text" class="form-control" id="" name="agency_name" value="<?php echo $agency['agency_name']; ?>">
        </div>
        <div class="form-group p-2">
            <label for="owner_firstname">Owner's First Name</label>
            <input type="text" class="form-control" id="" name="owner_firstname" value="<?php echo $agency['owner_firstname']; ?>">
        </div>
        <div class="form-group p-2">
            <label for="owner_lastname">Owner's Last Name</label>
            <input type="text" class="form-control" id="" name="owner_lastname" value="<?php echo $agency['owner_lastname']; ?>">
        </div>
        <div class="form-group p-2">
            <label for="agency_email">Email address</label>
            <input type="email" class="form-control" id="" name="agency_email" value="<?php echo $agency['agency_email']; ?>">
        </div>
        <div class="form-group p-2">
            <label for="agency_password">Password</label>
            <input type="password" class="form-control" id="" name="agency_password" value="">
        </div>
        <div class="form-group p-2">
            <label for="logo_image">Logo</label><br>
            <img src="../images/<?php echo $agency['logo_image']; ?>" width="150" height='120' alt="<?php echo $agency['agency_name']; ?>" ><br><br>
            <input type="file" id="" name="logo_image">
        </div>
        <div class="form-group p-2">
            <label for="cover_image">Cover Photo</label><br>
            <img src="../images/<?php echo $agency['cover_image']; ?>" width="150" height='120' alt="<?php echo $agency['agency_name']; ?>" ><br><br>
            <input type="file" id="" name="cover_image">
        </div>
        <div class="form-group p-2">
            <label for="agency_contact">Contact Number</label>
            <input type="text" class="form-control" id="" name="agency_contact" value="<?php echo $agency['agency_contact']; ?>">
        </div>
        <div class="form-group p-2">
            <label for="agency_address">Office Address</label>
            <input type="text" class="form-control" id="" name="agency_address" value="<?php echo $agency['agency_address']; ?>">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Update Agency" name="update_agency" class="btn btn-primary">

            <a href="agencies.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>