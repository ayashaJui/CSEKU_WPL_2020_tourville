<?php
    //date insert query
    if(isset($_SESSION['agency_id'])){
        if(isset($_POST['set_date'])){
            $agency_id      = $_SESSION['agency_id'];
            $package_id     = $_GET['package'];
            $last_date      = $_POST['last_date'];
            $travel_date    = $_POST['travel_date'];
            $date           = date("y.m.d");

            if(empty($last_date) || empty($travel_date)){
                $_SESSION['error'] = 'All Fields are Required';
                header('Location: packages.php?page=add_date&package='. $package_id);
                return;
            }else{
                $stmt = $pdo->prepare('INSERT INTO package_dates(package_id, agency_id, last_date, travel_date, status, date) VALUES(:package_id, :agency_id, :last_date, :travel_date, :status, :date)');

                $stmt->execute([':package_id'   => $package_id,
                                ':agency_id'     => $agency_id,
                                ':last_date'    => $last_date,
                                ':travel_date'  => $travel_date,
                                ':status'       => 'booking on',
                                ':date'         => $date]);

                $_SESSION['success'] = 'Dates Are Added';
                header('Location: packages.php?page=package_date');
                return;
            }
        }
    }
?>

<div class="container">
    <h2 class="p-2 pb-5">Add Travel & Last Booking Dates</h2>

    <?php
        include '../includes/flash_msg.php';
    ?>

    <form action="" method="post" class="col-md-8">
        <div class="form-group pb-2">
            <label for="last_date">Last Booking Date</label>
            <input type="date" name="last_date" id="" class="form-control">
        </div>
        <div class="form-group pb-2">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" id="" class="form-control">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Set Date" name="set_date" class="btn btn-primary">
            <a href="packages.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>