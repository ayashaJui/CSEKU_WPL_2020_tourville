<?php
    include '../includes/db.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
    }

    if(isset($_SESSION['admin_id'])){
        $admin_id = $_SESSION['admin_id'];

        $stmt = $pdo->prepare('SELECT * FROM admins WHERE admin_id = :admin_id');
        $stmt->execute([':admin_id' => $admin_id]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        $username       = $admin['username'];
        $admin_email    = $admin['admin_email'];
        $admin_status   = $admin['admin_status'];
        $admin_date     = $admin['date'];

        if(isset($_POST['update_profile'])){
            $admin_firstname    = htmlentities($_POST['admin_firstname']);
            $admin_lastname     = htmlentities($_POST['admin_lastname']);
            $admin_password     = htmlentities($_POST['admin_password']);

            if($admin_firstname == '' || $admin_lastname == '' || $admin_password == ''){
                $_SESSION['error'] = 'All Fields Are Required';
                header('Location: profile.php');
                return;
            }else{
                $stmt = $pdo->prepare('UPDATE admins SET username = :username, admin_firstname = :admin_firstname, admin_lastname = :admin_lastname, admin_email = :admin_email, admin_password = :admin_password, admin_status = :admin_status, date = :date WHERE admin_id = :admin_id');

                $stmt->execute([':admin_id'         => $admin_id,
                                ':username'         => $username,
                                ':admin_firstname'  => $admin_firstname,
                                ':admin_lastname'   => $admin_lastname,
                                ':admin_email'      => $admin_email,
                                ':admin_password'   => $admin_password,
                                ':admin_status'     => $admin_status,
                                ':date'             => $admin_date]);
                $_SESSION['success'] = 'Profile Updated';
                header('Location: profile.php');
                return;
            }

        }
    }
?>

<div id="layoutSidenav">
    <?php
        include 'layouts/admin_sidenav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to Admin ...</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
                <?php
                    include '../includes/flash_msg.php';
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="" method="post" enctype="multipart/form-data" class="col-md-8">
                            <!-- <div class="form-group p-2">
                                <label for="username">username</label>
                                <input type="text" class="form-control" value="<?php echo $admin['username']; ?>" id="" name="username">
                            </div> -->
                            <div class="form-group p-2">
                                <label for="admin_firstname">First Name</label>
                                <input type="text" class="form-control" value="<?php echo $admin['admin_firstname']; ?>" id="" name="admin_firstname">
                            </div>
                            <div class="form-group p-2">
                                <label for="admin_lastname">Last Name</label>
                                <input type="text" class="form-control" value="<?php echo $admin['admin_lastname']; ?>" id="" name="admin_lastname">
                            </div>
                            <div class="form-group p-2">
                                <label for="admin_password">Password</label>
                                <input type="password" class="form-control" value="" id="" name="admin_password">
                            </div>
                            <div class="form-group p-2">
                                <input type="submit" value="Update" name="update_profile" class="btn btn-primary">

                                <a href="dashboard.php" type="button" class="btn btn-secondary float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-3 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">tourism@tourville &copy;2020</div>
                    <div class="text-muted">by AyashaJui & SamiaShorna</div>
                </div>
            </div>
        </footer>
    </div>
</div>

<?php
    include 'layouts/admin_footer.php';
?>
