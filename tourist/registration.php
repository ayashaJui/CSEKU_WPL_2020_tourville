<?php
    include "../config/api_key.php";
    include '../includes/db.php';
    include '../layouts/header.php';
    require '../vendor/autoload.php';

    // Stripe API Key
    $stripe = new \Stripe\StripeClient(STRIPE_KEY);

    //Tourist Insert Query.... Tourist Registration
    if(isset($_POST['tourist_register'])){
        $username   = htmlentities($_POST['tourist_username']);
        $firstname  = htmlentities($_POST['tourist_firstname']);
        $lastname   = htmlentities($_POST['tourist_lastname']);
        $email      = htmlentities($_POST['tourist_email']);
        $contact    = htmlentities($_POST['tourist_contact']);
        $address    = htmlentities($_POST['tourist_address']);
        $date       = date("y.m.d");

        $password   = htmlentities($_POST['tourist_password']);

        //Create a Stripe Customer with every 
        $customer = $stripe->customers->create([
            'name'  => $firstname." ".$lastname,
            'email' => $email 
        ]);

         //uploading image in images folder
        $profile_img = $_FILES['profile_image']['name'];
        $profile_img_temp = $_FILES['profile_image']['tmp_name'];
        move_uploaded_file($profile_img_temp, "../images/$profile_img");

        //Empty Field Validation
        if($username == '' || $firstname == '' || $lastname == '' || $email == '' || $password == ''){
            $_SESSION['error'] = 'Please Fill the Form';
            header('Location: registration.php');
            return;
        }

        //contact no validation
        $tourist_contact = '';
        if(!empty($contact)){
            $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
            if(!preg_match($pattern, $contact)){
                $_SESSION['error'] = 'Invalid Contact Info';
                header("Location: registration.php");
                return;
            }else{
                $tourist_contact = $contact;
            }
        }

        //Username Validation
        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_username = :tourist_username');
        $stmt->execute([':tourist_username' => $username]);
        $tourist_usernames = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourist_usernames[] = $row;
        }
        if(!empty($tourist_usernames)){
            $_SESSION['error'] = 'Username already exist. Please try something else';
            header('Location: registration.php');
            return;
        }

        //Email Validation
        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_email = :tourist_email');
        $stmt->execute([':tourist_email' => $email]);
        $tourist_emails = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $tourist_emails[] = $row;
        }
        if(!empty($tourist_emails)){
            $_SESSION['error'] = 'Email Address already exist. Please try something else';
            header('Location: registration.php');
            return;
        }
        else{
            $hash_password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            $stmt = $pdo->prepare('INSERT INTO tourists(tourist_stripe, tourist_username, tourist_firstname, tourist_lastname, tourist_email, tourist_password, profile_image, tourist_contact, tourist_address, tourist_status, date) VALUES(:tourist_stripe, :tourist_username, :tourist_firstname, :tourist_lastname, :tourist_email, :tourist_password, :profile_image, :tourist_contact, :tourist_address, :tourist_status, :date)');

            $stmt->execute([':tourist_stripe'      => $customer->id,
                            ':tourist_username'    => $username,
                            ':tourist_firstname'   => $firstname,
                            ':tourist_lastname'    => $lastname,
                            ':tourist_email'       => $email,
                            ':tourist_password'    => $hash_password,
                            ':profile_image'       => $profile_img,
                            ':tourist_contact'     => $tourist_contact,
                            ':tourist_address'     => $address,
                            ':tourist_status'      => 'approved',
                            ':date'                => $date]);

            header('Location: ../includes/login.php');
            return;
        }
    }

?>

<br><br><br>
<div class="container mb-5">
    <h2 class="text-secondary text-center p-2 pb-4">Tourist Register</h2><br>
    <form action="" method="post" enctype="multipart/form-data" class="col-md-8 mx-auto mb-5">
    
    <?php
        include '../includes/flash_msg.php';
    ?>
        
        <div class="form-group p-2">
            <label for="tourist_username">Username</label>
            <input type="text" class="form-control" id="" name="tourist_username">
        </div>
        <div class="form-group p-2">
            <label for="tourist_firstname">First Name</label>
            <input type="text" class="form-control" id="" name="tourist_firstname">
        </div>
        <div class="form-group p-2">
            <label for="tourist_lastname">Last Name</label>
            <input type="text" class="form-control" id="" name="tourist_lastname">
        </div>
        <div class="form-group p-2">
            <label for="tourist_email">Email address</label>
            <input type="email" class="form-control" id="" name="tourist_email">
        </div>
        <div class="form-group p-2">
            <label for="tourist_password">Password</label>
            <input type="password" class="form-control" id="" name="tourist_password">
        </div>
        <div class="form-group p-2">
            <label for="profile_image">Profile Picture</label><br>
            <input type="file" id="" name="profile_image">
        </div>
        <div class="form-group p-2">
            <label for="tourist_contact">Contact</label>
            <input type="text" class="form-control" id="" name="tourist_contact">
        </div>
        <div class="form-group p-2">
            <label for="tourist_address">Address</label>
            <input type="text" class="form-control" id="" name="tourist_address">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Register" name="tourist_register" class="btn btn-primary">

            <a href="../index.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>

<?php
    include '../layouts/footer.php';
?>