<?php

    //Admin Insert Query
    if(isset($_POST['create_admin'])){
        $username        = htmlentities($_POST['username']);
        $admin_firstname = htmlentities($_POST['admin_firstname']);
        $admin_lastname  = htmlentities($_POST['admin_lastname']);
        $admin_email     = htmlentities($_POST['admin_email']);
        $date            = date("y.m.d");

        $admin_password = htmlentities($_POST['admin_password']);

        //Empty Field Validation
        if($username == '' || $admin_firstname == '' || $admin_lastname == '' || $admin_email == '' || $admin_password == ''){
            $_SESSION['error'] = 'All fields are required';
            header('Location: admins.php?page=add_admin');
            return;
        }
        
        //Username Validation
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
        $stmt->execute([':username' => $username]);
        $username_validate = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $username_validate[] = $row;
        }
        if(!empty($username_validate)){
            $_SESSION['error'] = 'Username already exist. Please try something else';
            header('Location: admins.php?page=add_admin');
            return;
        }

        //Email Validation
        $stmt = $pdo->prepare('SELECT * FROM admins WHERE admin_email = :admin_email');
        $stmt->execute([':admin_email' => $admin_email]);
        $email_validate = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $email_validate[] = $row;
        }
        if(!empty($email_validate)){
            $_SESSION['error'] = 'Email address already exist.Please try something else';
            header('Location: admins.php?page=add_admin');
            return;
        }
        
        else{
            $stmt = $pdo->prepare('INSERT INTO admins(username, admin_firstname, admin_lastname, admin_email, admin_password, admin_status, date) VALUES(:username, :admin_firstname, :admin_lastname, :admin_email, :admin_password, :admin_status, :date)');

            $stmt->execute([':username'        => $username,
                            ':admin_firstname' => $admin_firstname,
                            ':admin_lastname'  => $admin_lastname,
                            ':admin_email'     => $admin_email,
                            ':admin_password'  => $admin_password,
                            ':admin_status'    => 'approved',
                            ':date'            => $date]);
            $_SESSION['success'] = 'New Admin Added';
            header('Location: admins.php');
            return;
        }
    }
    
?>

<br><br>
<div class="container" >
    <h2 class="p-2 pb-4">Add Admin</h2>
    
    <?php
        include '../includes/flash_msg.php';
    ?>

    <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
        <div class="form-group p-2">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="" name="username">
        </div>
        <div class="form-group p-2">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="" name="admin_firstname">
        </div>
        <div class="form-group p-2">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="" name="admin_lastname">
        </div>
        <div class="form-group p-2">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="" name="admin_email">
        </div>
        <div class="form-group p-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="" name="admin_password">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Create Admin" name="create_admin" class="btn btn-primary">

            <a href="admins.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>