<?php

    function readDates($date_id){
        include '../includes/db.php';

        $stmt = $pdo->prepare('SELECT * FROM package_dates WHERE date_id = :date_id');
        $stmt->execute([':date_id' => $date_id]);
        $package_dates = $stmt->fetch(PDO::FETCH_ASSOC);
        return $package_dates;

    }
    function updateDates($status, $date_id, $date, $agency_id, $package_id){
        include '../includes/db.php';

        if(isset($_POST['update_date'])){
            $last_date      = $_POST['last_date'];
            $travel_date    = $_POST['travel_date'];
            
            if(empty($last_date) || empty($travel_date)){
                $_SESSION['error'] = 'All Fields are Required';
                header('Location: packages.php?page=add_date&package='. $package_id);
                return;
            }else{
                $stmt = $pdo->prepare('UPDATE package_dates SET package_id = :package_id, agency_id = :agency_id, last_date = :last_date, travel_date = :travel_date, status = :status, date = :date WHERE date_id = :date_id');

                $stmt->execute(['date_id'       => $date_id,
                                ':package_id'   => $package_id,
                                ':agency_id'    => $agency_id,
                                ':last_date'    => $last_date,
                                ':travel_date'  => $travel_date,
                                ':status'       => $status,
                                ':date'         => $date]);

                $_SESSION['success'] = 'Dates Are Updated';
                header('Location: packages.php?page=package_date');
                return;
            }
        }
    }

    if(isset($_SESSION['agency_id'])){
        $agency_id  = $_SESSION['agency_id'];
        
        if(isset($_GET['edit'])){
            $date_id    = $_GET['edit'];

            $dates = readDates($date_id);

            $package_id = $dates['package_id'];
            $status     = 'booking on';
            $date       = $dates['date'];

            updateDates($status, $date_id, $date, $agency_id, $package_id);
        }
        else if(isset($_GET['extend'])){
            $date_id    = $_GET['extend'];

            $dates = readDates($date_id);

            $package_id = $dates['package_id'];
            $status     = 'extended';
            $date       = $dates['date'];

            updateDates($status, $date_id, $date, $agency_id, $package_id);
        }
    }

?>

<div class="container">
    <h2 class="p-2 pb-5">Update Travel & Last Booking Dates</h2>

    <?php
        include '../includes/flash_msg.php';
    ?>

    <form action="" method="post" class="col-md-8">
        <div class="form-group pb-2">
            <label for="last_date">Last Booking Date</label>
            <input type="date" name="last_date" value="<?php echo $dates['last_date']; ?>" id="" class="form-control">
        </div>
        <div class="form-group pb-2">
            <label for="travel_date">Travel Date</label>
            <input type="date" name="travel_date" value="<?php echo $dates['travel_date']; ?>" id="" class="form-control">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Update" name="update_date" class="btn btn-primary">
            <a href="packages.php?page=package_date" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>
