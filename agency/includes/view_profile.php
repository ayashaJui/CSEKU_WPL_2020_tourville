<?php

    if(isset($_SESSION['agency_id'])){
        $user_id = $_SESSION['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<div class="container-fluid">
    <!-- Cover & Logo -->
    <div class="jumbotron jumbotron-fluid agency mb-5">
        <div class="container">
            <h2 class="display-4 font-weight-bold text-info text-center"></h2>
            <p class="lead"></p>
        </div>
        <div class="mb-5">
            <img src="../images/<?php echo $agency['logo_image']; ?>" class="rounded mx-auto d-block rounded-circle agency-logo" width="200" height="200" alt="<?php echo $agency['agency_name']; ?>">
        </div>
    </div>
    <div class="container lead mt-5 py-5">
    
    <?php
        include '../includes/flash_msg.php';
    ?>
        <div class="text-center font-italic pt-5">
            <div class="p-2">
                <span class="font-weight-bold mr-3">Agency Name:</span> <?php echo $agency['agency_name']; ?>
            </div>
            <hr>
            <div class="p-2">
                <span class="font-weight-bold mr-3">Owner:</span> <?php echo $agency['owner_firstname'] .' '. $agency['owner_lastname']; ?>
            </div>
            <hr>
            <div class="p-2">
                <span class="font-weight-bold mr-3">Office:</span> <?php echo $agency['agency_address']; ?>
            </div>
            <hr>
            <div class="p-2">
                <span class="font-weight-bold mr-3">Contact:</span> <?php echo $agency['agency_contact']; ?>
            </div>
            <hr>
            <div class="p-2">
                <span class="font-weight-bold mr-3">Email:</span> <?php echo $agency['agency_email']; ?>
            </div>
            <hr>

            <?php
                if($_SESSION['agency_login'] == 'AgencyOwner'){
            ?>

            <div class="p-2">
                <a href="profile.php?page=edit_profile&edit=<?php echo $agency['agency_id']; ?>" class="btn btn-primary">Edit Info</a>
            </div>

            <?php
                }
            ?>
        </div>
    </div>
</div>