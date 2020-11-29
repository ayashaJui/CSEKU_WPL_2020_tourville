<?php
    if(isset($_SESSION['tourist_id'])){
        $tourist_id = $_SESSION['tourist_id'];

        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_id = :tourist_id');
        $stmt->execute([':tourist_id' => $tourist_id]);
        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>

<div class="my-5">
    <img src="images/<?php echo $tourist['profile_image']; ?>" width="200" class="rounded float-right" alt="<?php echo $tourist['tourist_username']; ?>">
</div>
<div class="lead py-5 col-sm-8">

<?php
    include 'includes/flash_msg.php';
?>

    <div class="font-italic">
        <div class="p-2">
            <span class="font-weight-bold mr-3">Username:</span><?php echo $tourist['tourist_username']; ?>
        </div>
        <hr>
        <div class="p-2">
            <span class="font-weight-bold mr-3">First Name:</span><?php echo $tourist['tourist_firstname']; ?>
        </div>
        <hr>
        <div class="p-2">
            <span class="font-weight-bold mr-3">Last Name:</span><?php echo $tourist['tourist_lastname']; ?>
        </div>
        <hr>
        <div class="p-2">
            <span class="font-weight-bold mr-3">Email:</span><?php echo $tourist['tourist_email']; ?>
        </div>
        <hr>
        <div class="p-2">
            <span class="font-weight-bold mr-3">Contact:</span><?php echo $tourist['tourist_contact']; ?>
        </div>
        <hr>
        <div class="p-2">
            <span class="font-weight-bold mr-3">Address:</span><?php echo $tourist['tourist_address']; ?>
        </div>
        <hr>
        <div class="p-2">
            <a href="profile.php?page=edit_profile&edit=<?php echo $tourist['tourist_id']; ?>" class="btn btn-primary">Edit Info</a>
        </div>
    </div>
</div>