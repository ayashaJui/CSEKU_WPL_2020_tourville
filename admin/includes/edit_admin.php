<?php
    
    //Admin Update Query
    if(isset($_GET['edit'])){
        $admin_id = $_GET['edit'];
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE admin_id = :admin_id');
        $stmt->execute([':admin_id' => $admin_id]);
        $admin_status = '';
        $admin_date = '';
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $admin_status = $row['admin_status'];
            $admin_date = $row['date'];
        }

        if(isset($_POST['update_admin'])){
            $username = htmlentities($_POST['username']);
            $admin_firstname = htmlentities($_POST['admin_firstname']);
            $admin_lastname = htmlentities($_POST['admin_lastname']);
            $admin_email = htmlentities($_POST['admin_email']);
            // $date = date("y.m.d");

            $admin_password = htmlentities($_POST['admin_password']);

            //Empty Field Validation
            if($username == '' || $admin_firstname == '' || $admin_lastname == '' || $admin_email == '' || $admin_password == ''){
                $_SESSION['error'] = 'All fields are required';
                header('Location: admins.php?page=edit_admin&edit='. $admin_id);
                return;
            }else{
                $hash_password = password_hash($admin_password, PASSWORD_BCRYPT, ['cost' => 12]);
                $stmt = $pdo->prepare('UPDATE admins SET username = :username, admin_firstname = :admin_firstname, admin_lastname = :admin_lastname, admin_email = :admin_email, admin_password = :admin_password, admin_status = :admin_status, date = :date WHERE admin_id = :admin_id');

                $stmt->execute([':admin_id'        => $admin_id,
                                ':username'        => $username,
                                ':admin_firstname' => $admin_firstname,
                                ':admin_lastname'  => $admin_lastname,
                                ':admin_email'     => $admin_email,
                                ':admin_password'  => $hash_password,
                                ':admin_status'    => $admin_status,
                                ':date'            => $admin_date]);
                $_SESSION['success'] = 'Admin Info Updated';
                header('Location: admins.php');
                return;
            }
        }
    }
?>

<br><br>
<div class="container" >
    <h2 class="p-2 pb-5">Update Admin</h2>

    <?php
        include '../includes/flash_msg.php';

        if(isset($_GET['edit'])){
            //Admin Read Query for specific id
            $admin_id = $_GET['edit'];
            $stmt = $pdo->prepare('SELECT * FROM admins WHERE admin_id = :admin_id');
            $stmt->execute([':admin_id' => $admin_id]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <form action="" method="post" class="col-md-8">
        <div class="form-group pb-2">
            <label for="username">Username</label>
            <input type="text" class="form-control" value="<?php echo $admin['username']; ?>" id="" name="username">
        </div>
        <div class="form-group p-2">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" value="<?php echo $admin['admin_firstname']; ?>" id="" name="admin_firstname">
        </div>
        <div class="form-group p-2">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="" value="<?php echo $admin['admin_lastname']; ?>" name="admin_lastname">
        </div>
        <div class="form-group p-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" value="<?php echo $admin['admin_email']; ?>" id="" name="admin_email">
        </div>
        <div class="form-group p-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="" name="admin_password">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Update Admin" name="update_admin" class="btn btn-primary">

            <a href="admins.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>

    <?php
        }
    ?>
</div>