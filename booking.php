<?php
    include 'includes/db.php';
    $page = 'packages';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(empty($_SESSION['tourist_login']) || $_SESSION['tourist_login'] == ''){
        header('Location: includes/login.php');
        return;
    }

?>
<head>
    <style>
        .booking {
            background-image: url("images/view/booking.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            height: 50vh;
        }

        .effect:hover{
            box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            -webkit-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            -moz-box-shadow: 4px 4px 15px 0px rgba(0,0,0,0.44);
            transition: box-shadow 0.2s ease-in-out;
        }

    </style>

    <script src="js/script.js"></script>
</head>

<br><br><br>
<div class="jumbotron jumbotron-fluid booking">
  <div class="container">
    <h1 class="display-4 text-white text-center font-weight-bold">Package Booking</h1>
  </div>
</div>

<div class="container">
    
    <?php
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = '';
        }
        switch($page){
            case 'edit_booking':
                include 'tourist/includes/edit_booking.php';
            break;
            default:
                include 'tourist/includes/add_booking.php';
        break;
        }
    ?>

</div>

<footer class='text-center p-1 mt-5' style="background: #E9EAEC;">
    <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>