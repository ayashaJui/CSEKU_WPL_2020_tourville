<?php

    include '../includes/db.php';
    include '../includes/functions.php';
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
    }

    $stmt = $pdo->query('SELECT * FROM payments ORDER BY payment_id DESC');
    $stmt->execute();

    $payments = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $payments[] = $row;
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
                    <li class="breadcrumb-item active">Payments Information</li>
                </ol>

                <?php
                    if(empty($payments)){
                        echo '<h1 class="text-center pt-4">No Payment Found</h1>';
                    }else{
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tourist Name</th>
                                    <th>Package Name</th>
                                    <th>Agency Name</th>
                                    <th>Name on Card</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Transaction ID</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i = 1;
                                foreach($payments as $payment){
                                    echo '<tr>';
                                        echo '<td>'. $i++ .'</td>';

                                        //read tourist name
                                        $tourist = readTourist($payment['tourist_id']);
                                        echo '<td>'. ucwords($tourist['tourist_firstname']) .' '. ucwords($tourist['tourist_lastname']) .'</td>';

                                        //read package name
                                        $package = readPackage($payment['package_id']);
                                        echo '<td><a href="../package.php?package_id='. $payment['package_id'] .'">'. $package['package_name'] .'</a></td>';

                                        //read agency name
                                        $agency = readAgency($payment['agency_id']);
                                        echo '<td><a href="../agency.php?agency_id='. $payment['agency_id'] .'">'. $agency['agency_name'] .'</a></td>';

                                        echo '<td>'. $payment['card_name'] .'</td>';
                                        echo '<td>'. strtoupper($payment['currency']) ." ". $payment['amount'] .'</td>';
                                        echo '<td>'. ucwords($payment['payment_status']) .'</td>';
                                        echo '<td>'. $payment['txn_id'] .'</td>';
                                        echo '<td>'. $payment['date'] .'</td>';
                                    echo '</tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
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
    include 'layouts/admin_footer.php';
?>
