<?php
    $page = 'contact';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

?>
<head>
    <style>
        .about{
            background-image: url("images/view/contact.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            background-color: orange;
            height: 86vh;
        }
    </style>
</head>

<br><br><br>
<div class="container-fluid about">
    <br><br>
    <h1 class="text-white text-center my-5">Conatct Us</h1>
    <div class="container">
        <div class="row text-center">
            <div class="col-sm-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="far fa-envelope"></i></h5>
                        <p class="card-text"> jui1801@cseku.ac.bd <br> sharna1833@cseku.ac.bd</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-phone"></i></h5>
                        <p class="card-text">+8801521410529 <br> +8801763873861</p>
                        
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card border-danger">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-map-marker-alt"></i></h5>
                        <p class="card-text pt-4">Khulna University</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class='text-center p-1' style="background: #000;">
    <h6 class="text-light">tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>