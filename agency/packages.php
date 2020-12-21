<?php
    include '../includes/db.php';
    include 'layouts/agency_header.php';
    include 'layouts/agency_navbar.php';

    if(empty($_SESSION['agency_login']) || $_SESSION['agency_login'] == ''){
        header('Location: ../includes/login.php');
        return;
    }
?>

<!-- <head>
    <link rel="stylesheet" href="../css/agency.php">
</head> -->

<div id="layoutSidenav">
    <?php
        include 'layouts/agency_sidenav.php';
    ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Welcome to 
                <?php
                    if(isset($_SESSION['employee_id'])){
                        echo ucwords($_SESSION['agency_name']) ." (". ucwords($_SESSION['role']) .")";
                    }elseif($_SESSION['agency_id']){
                        echo ucwords($_SESSION['agency_name']) ." (Owner)";
                    }
                ?>
                </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Package Details</li>
                </ol>
                <?php
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = '';
                    }
                    switch($page){
                        case 'add_package':
                            include 'includes/add_package.php';
                        break;
                        case 'edit_package':
                            include 'includes/edit_package.php';
                        break;
                        case 'package_date':
                            include 'includes/package_date.php';
                        break;
                        case 'add_date':
                            include 'includes/add_date.php';
                        break;
                        case 'update_date':
                            include 'includes/update_date.php';
                        break;
                        default:
                            include 'includes/view_all_packages.php';
                    break;
                    }
                ?>
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
    include 'layouts/agency_footer.php';
?>