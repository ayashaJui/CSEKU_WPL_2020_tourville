<?php
    include 'includes/db.php';
    include 'layouts/header.php';
    include 'layouts/navbar.php';

    if(empty($_SESSION['tourist_login']) || $_SESSION['tourist_login'] == ''){
        header('Location: includes/login.php');
        return;
    }
?>

<br><br>
<div class="container">
    <h3 class="mt-5 py-2 pl-4">Your Profile Details</h3>
    <div class="container-fluid">

        <?php
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = '';
            }
            switch($page){
                case 'edit_profile':
                    include 'tourist/includes/edit_profile.php';
                break;
                default:
                    include 'tourist/includes/view_profile.php';
            break;
            }
        ?>
        
    </div>
</div>

<footer class='text-center mt-5 p-1' style="background: #E9EAEC;">
  <h6>tourism@tourville &copy;2020</h6>
</footer>

<?php
    include 'layouts/footer.php';
?>