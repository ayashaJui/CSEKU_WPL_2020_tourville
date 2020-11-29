<?php
    include 'layouts/admin_header.php';
    include 'layouts/admin_navbar.php';

    if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] == ''){
        header('Location: index.php');
        return;
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
                    <li class="breadcrumb-item active">Ratings & Comments Details</li>
                </ol>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Author</th>
                                    <th>Email</th>
                                    <th>Rating</th>
                                    <th>Comment</th>
                                    <th>Agency</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Publish</th>
                                    <th>Unpublish</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Samia</td>
                                    <td>samia@gmail.com</td>
                                    <td>3</td>
                                    <td>New Comment</td>
                                    <td><a href="../agency.php?agency_id=1">Last Minute Vacation</a></td>
                                    <td>Published</td>
                                    <td>2020-10-12</td>
                                    <td><a href='reviews.php?approve=1' class='btn btn-outline-success mt-1'>Publish</a></td>
                                    <td><a href='reviews.php?unapprove=1' class='btn btn-outline-secondary mt-1'>Unpublish</a></td>
                                    <td><a onclick=" javascript: return confirm('Are you sure??');" href='reviews.php?delete=1' class='btn btn-outline-danger mt-1'>Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
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
