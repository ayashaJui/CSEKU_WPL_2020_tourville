<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav pt-5 mt-5">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapseAgencies" aria-expanded="false" aria-controls="collapseLayouts">
                    Agencies
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAgencies" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="agencies.php">View All Agencies</a>
                        <a class="nav-link" href="agencies.php?page=add_agency">Add Agency</a>
                    </nav>
                </div>
                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapseSubs" aria-expanded="false" aria-controls="collapsePages">
                    Tourists
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseSubs" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="tourists.php">View All Tourists</a>
                        <a class="nav-link" href="tourists.php?page=add_tourist">Add Tourist</a>
                    </nav>
                </div>
                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapseAdmins" aria-expanded="false" aria-controls="collapsePages">
                    Admins
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseAdmins" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="admins.php">View All Admins</a>
                        <a class="nav-link" href="admins.php?page=add_admin">Add Admin</a>
                    </nav>
                </div>
                <a class="nav-link py-3" href="packages.php">
                    Packages
                </a>
                <a class="nav-link collapsed py-3" href="#" data-toggle="collapse" data-target="#collapseReviews" aria-expanded="false" aria-controls="collapsePages">
                    Reviews
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseReviews" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="reviews.php">Agency Reviews</a>
                        <a class="nav-link" href="comments.php">Package Comments</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            TMS_Admin
        </div>
    </nav>
</div>