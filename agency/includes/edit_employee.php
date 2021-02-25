<?php

    if(isset($_GET['edit'])){
        if(isset($_POST['update_employee'])){
            $employee_id        = $_GET['edit'];
            $agency_id          = $_SESSION['agency_id'];
            $employee_firstname = htmlentities($_POST['employee_firstname']);
            $employee_lastname  = htmlentities($_POST['employee_lastname']);
            $employee_email     = htmlentities($_POST['employee_email']);
            $employee_password  = htmlentities($_POST['employee_password']);
            $employee_contact   = htmlentities($_POST['employee_contact']);
            $employee_address   = htmlentities($_POST['employee_address']);
            $role               = $_POST['agency_role'];
            $date               = $_POST['date'];

            //contact no validation
            $contact = '';
            if(!empty($employee_contact)){
                $pattern = "/(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$/";
                
                if(!preg_match($pattern, $employee_contact)){
                    $_SESSION['error'] = 'Invalid Contact Info';
                    header("Location: employees.php?page=edit_employee&edit=". $employee_id);
                    return;
                }else{
                    $contact = $employee_contact;
                }
            }

            //Empty Field Validation
            if(empty($employee_firstname) || empty($employee_lastname) || empty($employee_email) || empty($employee_password) || empty($employee_contact) || empty($employee_address) || empty($role)){
                $_SESSION['error'] = 'All fields are required';
                header("Location: employees.php?page=edit_employee&edit=". $employee_id);
                return;
            }else{
                $hash_password = password_hash($employee_password, PASSWORD_BCRYPT, ['cost' => 12]);
                $stmt = $pdo->prepare('UPDATE agency_employees SET agency_id = :agency_id, employee_firstname = :employee_firstname, employee_lastname = :employee_lastname, employee_email = :employee_email, employee_password = :employee_password, employee_contact = :employee_contact, employee_address = :employee_address, role = :role, date = :date WHERE employee_id = :employee_id');

                $stmt->execute([':employee_id'          => $employee_id,
                                ':agency_id'            => $agency_id,
                                ':employee_firstname'   => $employee_firstname,
                                ':employee_lastname'    => $employee_lastname,
                                ':employee_email'       => $employee_email,
                                ':employee_password'    => $hash_password,
                                ':employee_contact'     => $contact,
                                ':employee_address'     => $employee_address,
                                ':role'                 => $role,
                                ':date'                 => $date]);
                $_SESSION['success'] = 'Updated Employee Info';
                header('Location: employees.php');
                return;
            }
        }
    }
?>

<br>
<div class="container">
    <h2 class="p-2 pb-5">Edit Employee</h2>

    <?php
        include '../includes/flash_msg.php';

        if(isset($_GET['edit'])){
            $employee_id = $_GET['edit'];

            $stmt = $pdo->prepare('SELECT * FROM agency_employees WHERE employee_id = :employee_id');
            $stmt->execute([':employee_id' => $employee_id]);
            $employee = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    ?>
    
    <form action="" method="post" class="col-md-8">
        <div class="form-group pb-2">
            <label for="employee_firstname">Employee Firstname</label>
            <input type="text" class="form-control" id="" value="<?php echo $employee['employee_firstname']; ?>" name="employee_firstname">
        </div>
        <div class="form-group p-2">
            <label for="employee_firstname">Employee's LastName</label>
            <input type="text" class="form-control" id="" value="<?php echo $employee['employee_lastname']; ?>" name="employee_lastname">
        </div>
        <div class="form-group p-2">
            <label for="employee_email">Email address</label>
            <input type="email" class="form-control" id="" value="<?php echo $employee['employee_email']; ?>" name="employee_email">
        </div>
        <div class="form-group p-2">
            <label for="agency_password">Password</label>
            <input type="password" class="form-control" id="" name="employee_password">
        </div>
        <div class="form-group p-2">
            <label for="agency_role">Role</label><br>
            <select name="agency_role" id="" class="custom-select">
                <option value="<?php echo $employee['role'] ?>"><?php echo $employee['role'] ?></option>
                <?php
                    if($employee['role'] == 'manager'){
                        echo '<option value="staff">staff</option>';
                    }else{
                        echo '<option value="manager">Manager</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group p-2">
            <label for="agency_contact">Contact Number</label>
            <input type="text" class="form-control" id="" value="<?php echo $employee['employee_contact'] ?>" name="employee_contact">
        </div>
        <div class="form-group p-2">
            <label for="agency_address">Address</label>
            <input type="text" class="form-control" id="" value="<?php echo $employee['employee_address'] ?>" name="employee_address">
        </div>
        <div class="form-group p-2">
            <label for="date">Join Date</label>
            <input type="date" class="form-control" id="" value="<?php echo $employee['date']; ?>" name="date">
        </div>
        <div class="form-group p-2">
            <input type="submit" value="Update Employee" name="update_employee" class="btn btn-primary">

            <a href="employees.php" type="button" class="btn btn-secondary float-right">Cancel</a>
        </div>
    </form>
</div>