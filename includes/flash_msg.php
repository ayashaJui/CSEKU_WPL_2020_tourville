<?php
    if (isset($_SESSION['error'])) {
        echo    '<div class="alert alert-danger my-2" role="alert">'. htmlentities($_SESSION['error']) .'</div>';
        unset($_SESSION['error']);
    }elseif(isset($_SESSION['success'])){
        echo    '<div class="alert alert-success my-2" role="alert">'. htmlentities($_SESSION['success']) .'</div>';
        unset($_SESSION['success']);
    }
?>