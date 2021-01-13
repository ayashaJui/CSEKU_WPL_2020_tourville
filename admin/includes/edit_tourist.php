<?php

    if(isset($_GET['edit'])){
        $tourist_id = $_GET['edit'];

        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $tourist_status = '';
        $tourist_date = '';
        $tourist_stripe_id = '';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourist_status = $row['tourist_status'];
            $tourist_date = $row['date'];
            $tourist_stripe_id  = $row['tourist_stripe'];
        }

        if(isset($_POST['update_tourist'])){
            $username   = htmlentities($_POST['tourist_username']);
            $firstname  = htmlentities($_POST['tourist_firstname']);
            $lastname   = htmlentities($_POST['tourist_lastname']);
            $email      = htmlentities($_POST['tourist_email']);
            $contact    = htmlentities($_POST['tourist_contact']);
            $address    = htmlentities($_POST['tourist_address']);

            $password   = htmlentities($_POST['tourist_password']);

            $tourist_stripe = $stripe->customers->update(
                $tourist_stripe_id,
                ['name'  => $firstname." ".$lastname,
                'email'  => $email]
            );
            
             //uploading image in images folder
            $profile_img = $_FILES['profile_image']['name'];
            $profile_img_temp = $_FILES['profile_image']['tmp_name'];
            move_uploaded_file($profile_img_temp, "../images/$profile_img");
            if(empty($profile_img)){
                $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
                $stmt->execute(array(':tourist_id' => $tourist_id));
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $profile_img = $row['profile_image'];
                }
            }

            //contact no validation
            $tourist_contact = '';
            if(!empty($contact)){
                $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
                if(!preg_match($pattern, $contact)){
                    $_SESSION['error'] = 'Invalid Contact Info';
                    header("Location: tourists.php?page=edit_tourist&edit=". $tourist_id);
                    return;
                }else{
                    $tourist_contact = $contact;
                }
            }

            //Empty Field Validation
            if($username == '' || $firstname == '' || $lastname == '' || $email == '' || $password == ''){
                $_SESSION['error'] = 'Please Fill the Form';
                header('Location: tourists.php?page=edit_tourist&edit='. $tourist_id);
                return;
            }else{
                $stmt = $pdo->prepare('UPDATE tourists SET tourist_stripe = :tourist_stripe, tourist_username = :tourist_username, tourist_firstname = :tourist_firstname, tourist_lastname = :tourist_lastname, tourist_email = :tourist_email, tourist_password = :tourist_password, profile_image = :profile_image,  tourist_contact = :tourist_contact, tourist_address = :tourist_address, tourist_status = :tourist_status, date = :date WHERE tourist_id = :tourist_id');

                $stmt->execute(['tourist_stripe'        => $tourist_stripe->id,
                                ':tourist_id'           => $tourist_id,
                                ':tourist_username'     => $username,
                                ':tourist_firstname'    => $firstname,
                                ':tourist_lastname'     => $lastname,
                                ':tourist_email'        => $email,
                                ':tourist_password'     => $password,
                                ':profile_image'        => $profile_img,
                                ':tourist_contact'      => $user_contact,
                                ':tourist_address'      => $address,
                                ':tourist_status'       => $tourist_status,
                                ':date'                 => $date]);

                $_SESSION['success'] = 'Tourist Info Updated';
                header('Location: tourists.php');
                return;
            }

        }
    }
?>

<br><br>
<div class="container" >
    <h2 class="p-2 pb-5">Update Tourist</h2>
    
    <?php
        include '../includes/flash_msg.php';

        //Tourist Read Query for specific id
        if(isset($_GET['edit'])){
            $tourist_id = $_GET['edit'];

            $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
            $stmt->execute([':tourist_id' => $tourist_id]);
            $tourist = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>

    <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
        <div class="form-group pb-2">
            <label for="tourist_username">Username</label>
            <input type="text" class="form-control" value="<?php echo $tourist['tourist_username']; ?>" id="" name="tourist_username">
        </div>
        <div class="form-group p-2">
            <label for="tourist_firstname">First Name</label>
            <input type="text" class="form-control" value="<?php echo $tourist['tourist_firstname']; ?>" id="" name="tourist_firstname">
        </div>
        <div class="form-group p-2">
            <label for="tourist_lastname">Last Name</label>
            <input type="text" class="form-control" id="" value="<?php echo $tourist['tourist_lastname']; ?>" name="tourist_lastname">
        </div>
        <div class="form-group p-2">
            <label for="tourist_email">Email address</label>
            <input type="email" class="form-control" value="<?php echo $tourist['tourist_email']; ?>" id="" name="tourist_email">
        </div>
        <div class="form-group p-2">
            <label for="tourist_password">Password</label>
            <input type="password" class="form-control" value="" id="" name="tourist_password">
        </div>
        <div class="form-group p-2">
            <label for="profile_image">Profile Picture</label><br>
            <img src="../images/<?php echo $tourist['profile_image']; ?>" width="150" height='120' alt="<?php echo $tourist['tourist_username']; ?>" ><br><br>
            <input type="file" id="" name="profile_image">
        </div>
        <div class="form-group p-2">
            <label for="tourist_contact">Contact Number</label>
            <input type="text" class="form-control" value="<?php echo $tourist['tourist_contact']; ?>" id="" name="user_contact">
        </div>
        <div class="form-group p-2">
            <label for="user_address">Address</label>
            <input type="text" class="form-control" value="<?php echo $tourist['tourist_address']; ?>" id="" name="tourist_address">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Update Tourist" name="update_tourist" class="btn btn-primary">

            <a href="tourists.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>