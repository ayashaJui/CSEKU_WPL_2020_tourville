<?php
    include 'layouts/agency_header.php';
    include 'layouts/agency_navbar.php';

    if(empty($_SESSION['agency_login']) || $_SESSION['agency_login'] == ''){
        header('Location: ../includes/login.php');
        return;
    }
?>

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
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card text-white bg-dark mb-3">
                                <div class="card-body">
                                    <h1 class="card-title text-right" style="font-size: 50px;">25</h1>
                                    <p style="font-size: 35px;"><span class="mr-3"><i class="fas fa-list"></i></span>Packages</p>
                                </div>
                                <div class="card-footer  d-flex align-items-center justify-content-between">
                                    <a class=" text-white stretched-link" href="packages.php">view details</a>
                                    <div class=" text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-info mb-3">
                                <div class="card-body ">
                                    <h1 class="card-title text-right" style="font-size: 50px;">20</h1>
                                    <p style="font-size: 35px;"><span class="mr-3"><i class="far fa-file"></i></span>Bookings</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="text-white stretched-link" href="bookings.php">view details</a>
                                    <div class="text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card text-white bg-secondary mb-3">
                                <div class="card-body">
                                    <h1 class="card-title text-right" style="font-size: 50px;">15</h1>
                                    <p style="font-size: 35px;"><span class="mr-3"><i class="fas fa-user fa-fw pr-2"></i></span>Employees</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class=" text-white stretched-link" href="employees.php">view details</a>
                                    <div class=" text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card bg-light mb-3">
                                <div class="card-body">
                                    <h1 class="card-title text-right" style="font-size: 50px;">10</h1>
                                    <p style="font-size: 35px;"><span class="mr-3"><i class="far fa-comments"></i></span>Reviews</p>
                                </div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class=" text-primary stretched-link" href="reviews.php">view details</a>
                                    <div class=" text-primary"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container my-5">
                    <div class="row">
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    
                                    ['Data', 'Count'],
                                    ['Employees', 15],
                                    ['Staff', 10],
                                    ['Packages', 5],
                                    ['Unavailable Packages', 3],
                                    ['Bookings', 15],
                                    ['Pending Bookings', 5],
                                    ['Ratings', 10],
                                    ['comments', 12]
                                
                                ]);

                                var options = {
                                chart: {
                                    title: '',
                                    subtitle: '',
                                }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>

                        
                        <div id="columnchart_material" style="width: 1500px; height: 500px;"></div>

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
    include 'layouts/agency_footer.php';
?>
