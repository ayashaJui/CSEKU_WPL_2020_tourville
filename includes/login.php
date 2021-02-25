<?php
    include 'db.php';
    include '../layouts/header.php';
?>

<br><br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-8 mx-auto">
            <h2 class="text-secondary text-center py-5">Please Log In</h2>

            <ul class="nav nav-pills nav-fill">
                <li class="nav-item subnav">
                    <a class="nav-link tourist active" href="#">Tourist</a>
                </li>
                <li class="nav-item subnav">
                    <a class="nav-link agency" href="#">Agency</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="col-sm-6 mx-auto">
    <?php
        include 'flash_msg.php';
    ?>
</div>

<!-- Tourist Login Page -->
<?php   
    //Log In Query..Tourist
    if(isset($_POST['tourist_login'])){
        $email      = htmlentities($_POST['tourist_email']);
        $password   = htmlentities($_POST['tourist_password']);

        if(empty($email) || empty($password)){
            $_SESSION['error'] = 'Please Fill All Fields';
            header('Location: login.php');
            return;
        }

        $stmt = $pdo->prepare('SELECT * FROM tourists WHERE tourist_email = :tourist_email');
        $stmt->execute([':tourist_email'    => $email ]);
        $tourist = $stmt->fetch(PDO::FETCH_ASSOC);

        if($email !== $tourist['tourist_email']){
            //when email with database
            $_SESSION['error'] = 'Info is Wrong';
            header('Location: login.php');
            return;
        }elseif($email == $tourist['tourist_email']){
            if(password_verify($password, $tourist['tourist_password'])){
                $_SESSION['tourist_id']         = $tourist['tourist_id'];
                $_SESSION['tourist_username']   = $tourist['tourist_username'];
                $_SESSION['tourist_email']      = $tourist['tourist_email'];
                $_SESSION['tourist_status']     = $tourist['tourist_status'];

                if($_SESSION['tourist_status'] == 'unapproved'){
                    $_SESSION['error'] = 'You need Admin\'s Approval';
                    header('Location: login.php');
                    return;
                }else{
                    //when tourist is in approved state
                    $_SESSION['tourist_login'] = "Tourist";
                    header('Location: ../index.php');
                    return;
                }
            }else{
                $_SESSION['error'] = 'Wrong Password';
                header('Location: login.php');
                return;
            }
        }
    }
?>

<div class="tourist-container col-sm-6 mx-auto" >
    <form action="" method="post" class=" mx-auto pt-5">
        <div class="form-group p-2">
            <label for="tourist_email">Email address</label> 
            <input type="email" class="form-control" id="" name="tourist_email">
        </div>
        <div class="form-group p-2">
            <label for="tourist_password">Password</label>
            <input type="password" class="form-control" id="" name="tourist_password">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Log In" name="tourist_login" class="btn btn-primary">

            <a href="../index.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>


<!-- Agency Login Page -->
<?php
        //Log In Query..Agency
    if(isset($_POST['agency_login'])){
        $email = htmlentities($_POST['agency_email']);
        $password = htmlentities($_POST['agency_password']);
        $agency_role = $_POST['agency_role'];
        
        if(empty($email) || empty($password) || empty($agency_role)){
            $_SESSION['error'] = 'Please Fill All Fields';
            header('Location: login.php');
            return;
        }

        if($agency_role == "owner"){
            $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_email = :agency_email');
            $stmt->execute([':agency_email'    => $email ]);
            $agency = $stmt->fetch(PDO::FETCH_ASSOC);

            if($email !== $agency['agency_email']){
                //when email & password doesnot match with database
                $_SESSION['error'] = 'Info is Wrong';
                header('Location: login.php');
                return;
            }elseif($email === $agency['agency_email'] ){
                if(password_verify($password, $agency['agency_password'])){
                    $_SESSION['agency_id']     = $agency['agency_id'];
                    $_SESSION['agency_name']   = $agency['agency_name'];
                    $_SESSION['owner_firstname'] = $agency['owner_firstname'];
                    $_SESSION['agency_email']  = $agency['agency_email'];
                    $_SESSION['agency_status'] = $agency['agency_status'];

                    if($_SESSION['agency_status'] == 'unapproved'){
                        $_SESSION['error'] = 'You need Admin\'s Approval';
                        header('Location: login.php');
                        return;
                    }else{
                        //when agency is in approved state
                        $_SESSION['agency_login']  = "AgencyOwner";
                        header('Location: ../agency');
                        return;
                    }
                }else{
                    $_SESSION['error'] = 'Wrong Password';
                    header('Location: login.php');
                    return;
                }
            }
        }else{
            $stmt = $pdo->prepare('SELECT * FROM agency_employees WHERE employee_email = :employee_email');
            $stmt->execute([':employee_email'    => $email ]);
            $employee = $stmt->fetch(PDO::FETCH_ASSOC);

            if($email !== $employee['employee_email']){
                //when email & password doesnot match with database
                $_SESSION['error'] = 'Info is Wrong';
                header('Location: login.php');
                return;
            }elseif($email === $employee['employee_email']){
                if(password_verify($password, $employee['employee_password'])){
                    $_SESSION['employee_id']        = $employee['employee_id'];
                    $_SESSION['agency_id']          = $employee['agency_id'];
                    $_SESSION['employee_firstname'] = $employee['employee_firstname'];
                    $_SESSION['role']               = $employee['role'];
                    $_SESSION['employee_email']     = $employee['employee_email'];

                    $stmt = $pdo->prepare('SELECT * FROM agencies WHERE agency_id = :agency_id');
                    $stmt->execute([':agency_id'    => $_SESSION['agency_id']]);
                    $agency = $stmt->fetch(PDO::FETCH_ASSOC);

                    $_SESSION['agency_name']    = $agency['agency_name'];
                    $_SESSION['agency_status']  = $agency['agency_status'];

                    if($_SESSION['agency_status'] == 'unapproved'){
                        $_SESSION['error'] = 'You need Admin\'s Approval';
                        header('Location: login.php');
                        return;
                    }else{
                    //when agency is in approved state
                    $_SESSION['agency_login']  = "AgencyEmployee";
                    header('Location: ../agency');
                    return;
                    }
                }else{
                    $_SESSION['error'] = 'Wrong Password';
                    header('Location: login.php');
                    return;
                }
            }
        }
    }
?>

<div class="agency-container col-sm-6 mx-auto" style="display: none;">
    <form action="" method="post" class=" mx-auto pt-5">
        <div class="form-group p-2">
            <label for="agency_email">Email address</label>
            <input type="email" class="form-control" id="" name="agency_email">
        </div>
        <div class="form-group p-2">
            <label for="">Log In As</label>
            <select name="agency_role" id="" class="form-control custom-select">
                <option value="">Please Select</option>
                <option value="owner">Owner</option>
                <option value="manager">Manager</option>
                <option value="staff">Staff</option>
            </select>
        </div>
        <div class="form-group p-2">
            <label for="agency_password">Password</label>
            <input type="password" class="form-control" id="" name="agency_password">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Log In" name="agency_login" class="btn btn-primary">

            <a href="../index.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>

<script>
    //Toggle Active State...
    const navState = document.querySelectorAll(".subnav"),
    current = document.querySelector(".nav");

    for (let i = 0; i < navState.length; i++) {
        navState[i].addEventListener("click", (e) => {
            current.querySelector(".active").classList.remove("active");
            e.target.classList.add("active");
        });
    }

    //change according to click
    const touristContainer = document.querySelector('.tourist-container');
    const agencyContainer = document.querySelector('.agency-container');

    document.querySelector('.tourist').addEventListener('click', touristState);
    document.querySelector('.agency').addEventListener('click', agencyState);

    function touristState(e){
        touristContainer.style.display = 'block';
        agencyContainer.style.display = 'none';
        e.preventDefault();
    }
    function agencyState(e){
        touristContainer.style.display = 'none';
        agencyContainer.style.display = 'block';
        e.preventDefault();
    }
</script>

<?php
    include '../layouts/footer.php';
?>
