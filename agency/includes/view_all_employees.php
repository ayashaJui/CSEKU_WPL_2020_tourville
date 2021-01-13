<?php
    //Employee Read Query.. for only one Agency
    if($_SESSION['agency_id']){
        $agency_id = $_SESSION['agency_id'];

        $stmt = $pdo->prepare('SELECT * FROM agency_employees WHERE agency_id = :agency_id');
        $stmt->execute([':agency_id' => $agency_id]);
        $employees = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $employees[] = $row;
        }
    }

    //Employee Delete Query
    if(isset($_GET['delete'])){
        $employee_id = $_GET['delete'];

        $stmt = $pdo->prepare('DELETE FROM agency_employees WHERE employee_id = :employee_id');
        $stmt->execute([':employee_id' => $employee_id]);

        $_SESSION['success'] = 'Employee has been Deleted';
        header('Location: employees.php');
        return;
    }
?>

<div class="container-fluid">

<?php
    include '../includes/flash_msg.php';

    if(empty($employees)){
        echo '<h1 class="text-center pt-4">No Employee Found</h1>';
    }else{
?>

    <div class="col-xs-12">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Role</th>
                <th>Join Date</th>
                <?php
                    if($_SESSION['agency_login'] == 'AgencyOwner'){
                ?>
                <th>Action</th>

                <?php
                    }
                ?>
            </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                foreach($employees as $employee){
                    echo '<tr>';
                        echo '<td>'. $i++ .'</td>';
                        echo '<td>'. $employee['employee_firstname'] .'</td>';
                        echo '<td>'. $employee['employee_lastname'] .'</td>';
                        echo '<td>'. $employee['employee_email'] .'</td>';
                        echo '<td>'. $employee['employee_contact'] .'</td>';
                        echo '<td>'. $employee['employee_address'] .'</td>';
                        echo '<td>'. ucwords($employee['role']) .'</td>';
                        echo '<td>'. $employee['date'] .'</td>';

                    if($_SESSION['agency_login'] == 'AgencyOwner'){
                        echo '<td><a  href="employees.php?page=edit_employee&edit='. $employee['employee_id'] .'" class="btn btn-outline-warning mt-1 mr-1"><i class="fas fa-edit"></i></a>';
                        echo '<a href="employees.php?delete='. $employee['employee_id'] .'" class="btn btn-outline-danger mt-1"><i class="fas fa-trash-alt"></i></a></td>';
                    }
                    echo '</tr>';
                }
            ?>
            </tbody>
        </table>
    </div>
    <?php
        }
    ?>
</div>