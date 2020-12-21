<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #04234D;">
        <div class="sb-sidenav-menu">
            <div class="nav pt-5 mt-5">
                <a class="nav-link" href="index.php">
                    Dashboard
                </a>
                <?php
                    if( $_SESSION['agency_login'] == 'AgencyOwner' || $_SESSION['role'] !== 'staff'){
                ?>

                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapsePackages" aria-expanded="false" aria-controls="collapseLayouts">
                    Packages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePackages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="packages.php">View All Packages</a>
                        <a class="nav-link" href="packages.php?page=add_package">Add Package</a>
                        <a href="packages.php?page=package_date" class="nav-link">Package Dates</a>
                    </nav>
                </div>

                <?php
                    }else {
                ?>

                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapsePackages" aria-expanded="false" aria-controls="collapseLayouts">
                    Packages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePackages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="packages.php">View All Packages</a>
                        <a href="packages.php?page=package_date" class="nav-link">Package Dates</a>
                    </nav>
                </div>

                <?php
                    }
                ?>
                <a class="nav-link py-3" href="bookings.php">
                    Booking List
                </a>
                <a class="nav-link py-3" href="payments.php">
                    Payment List
                </a>
                <a class="nav-link py-3" href="reviews.php">
                    Agency Reviews
                </a>
                <a class="nav-link py-3" href="comments.php">
                    Package Comments
                </a>

                <?php
                    if($_SESSION['agency_login'] == 'AgencyOwner'){
                ?>

                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapseEmployees" aria-expanded="false" aria-controls="collapseLayouts">
                    Employees
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEmployees" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="employees.php">View All Employees</a>
                        <a class="nav-link" href="employees.php?page=add_employee">Add Employee</a>
                    </nav>
                </div>

                <?php
                    }else {
                ?>
                <a class="nav-link py-3" href="employees.php">
                    Employees
                </a>

                <?php
                    }
                ?>

            </div>
        </div>
        <div class="sb-sidenav-footer" style="background-color: #04234D;">
            <div class="small">Logged in as:</div>
            Agency
        </div>
    </nav>
</div>