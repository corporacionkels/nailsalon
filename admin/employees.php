<?php
ob_start();
session_start();

//Page Title
$pageTitle = 'Employees';

//Includes
include 'connect.php';
include 'Includes/functions/functions.php';
include 'Includes/templates/header_tables.php';

//Extra JS FILES
echo "<script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>";

//Check If user is already logged in
if (isset($_SESSION['username_barbershop_Xw211qAAsq4']) && isset($_SESSION['password_barbershop_Xw211qAAsq4'])) {
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Profesionales</h1>

        </div>

        <?php
        $do = '';

        if (isset($_GET['do']) && in_array($_GET['do'], array('Add', 'Edit'))) {
            $do = htmlspecialchars($_GET['do']);
        } else {
            $do = 'Manage';
        }

        if ($do == 'Manage') {
            $stmt = $con->prepare("SELECT * FROM employees");
            $stmt->execute();
            $rows_employees = $stmt->fetchAll();

        ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profesionales</h6>
                </div>
                <div class="card-body">

                    <!-- ADD NEW Employee BUTTON -->
                    <a href="employees.php?do=Add" class="btn btn-success btn-sm" style="margin-bottom: 10px;">
                        <i class="fa fa-plus"></i>
                        Agregar Profesional
                    </a>

                    <!-- Employees Table -->
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Telefono</th>
                                    <th scope="col">correo</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($rows_employees as $employee) {
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $employee['first_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['last_name'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['phone_number'];
                                    echo "</td>";
                                    echo "<td>";
                                    echo $employee['email'];
                                    echo "</td>";
                                    echo "<td>";
                                    $delete_data = "delete_employee_" . $employee["employee_id"];
                                ?>
                                    <ul class="list-inline m-0">

                                        <!-- EDIT BUTTON -->

                                        <li class="list-inline-item" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-success btn-sm rounded-0">
                                                <a href="employees.php?do=Edit&employee_id=<?php echo $employee['employee_id']; ?>" style="color: white;">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </button>
                                        </li>

                                        <!-- DELETE BUTTON -->

                                        <li class="list-inline-item" data-toggle="tooltip" title="Delete">
                                            <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="modal" data-target="#<?php echo $delete_data; ?>" data-placement="top"><i class="fa fa-trash"></i></button>

                                            <!-- Delete Modal -->

                                            <div class="modal fade" id="<?php echo $delete_data; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $delete_data; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Eliminar Profesional</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Estas Seguro de Eliminar este Profesional?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                            <button type="button" data-id="<?php echo $employee['employee_id']; ?>" class="btn btn-danger delete_employee_bttn">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                <?php
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        } elseif ($do == 'Add') {
        ?>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Agregar Nuevo Profesional</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="employees.php?do=Add">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_fname">Nombre</label>
                                    <input type="text" class="form-control" value="<?php echo (isset($_POST['employee_fname'])) ? htmlspecialchars($_POST['employee_fname']) : '' ?>" placeholder="Nombre" name="employee_fname">
                                    <?php
                                    $flag_add_employee_form = 0;
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_fname']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Nombre Profesional es Requerido.
                                            </div>
                                    <?php

                                            $flag_add_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_lname">Apellido</label>
                                    <input type="text" class="form-control" value="<?php echo (isset($_POST['employee_lname'])) ? htmlspecialchars($_POST['employee_lname']) : '' ?>" placeholder="Apellido" name="employee_lname">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_lname']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Apellido Profesional es Requerido.
                                            </div>
                                    <?php

                                            $flag_add_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_phone">Telefono</label>
                                    <input type="text" class="form-control" value="<?php echo (isset($_POST['employee_phone'])) ? htmlspecialchars($_POST['employee_phone']) : '' ?>" placeholder="Numero Telefonico" name="employee_phone">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_phone']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Telefono es Requerido.
                                            </div>
                                    <?php

                                            $flag_add_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_email">correo</label>
                                    <input type="text" class="form-control" value="<?php echo (isset($_POST['employee_email'])) ? htmlspecialchars($_POST['employee_email']) : '' ?>" placeholder="E-mail" name="employee_email">
                                    <?php
                                    if (isset($_POST['add_new_employee'])) {
                                        if (empty(test_input($_POST['employee_email']))) {
                                    ?>
                                            <div class="invalid-feedback" style="display: block;">
                                                Correo es Requerido.
                                            </div>
                                    <?php

                                            $flag_add_employee_form = 1;
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title"></h4>
                                <p class="card-description"><code>Servicios del Profesional</code></p>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">

                                                    <input type="checkbox" name="check_manicure" value="30" class="form-check-input">    Manicure </label>

                                            </div>

                                            <div class="form-check">
                                                <label class="form-check-label">

                                                    <input type="checkbox" name="check_pedicure" value="31" class="form-check-input">    Pedicure </label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="form-check">
                                                <label class="form-check-label">

                                                    <input type="checkbox" name="check_faciales" value="31" class="form-check-input">    Faciales </label>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">

                                                    <input type="checkbox" name="check_corporales" value="32" class="form-check-input">    Masajes </label>

                                            </div>


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <label class="form-check-label">

                                                    <input type="checkbox" name="check_corporales" value="32" class="form-check-input">    Depilacion </label>

                                            </div>


                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- SUBMIT BUTTON -->

                        <button type="submit" name="add_new_employee" class="btn btn-primary">Agregar Profesional</button>

                    </form>

                    <?php

                    /*** ADD NEW EMPLOYEE ***/

                    if (isset($_POST['add_new_employee']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_add_employee_form == 0) {
                        $employee_fname = test_input($_POST['employee_fname']);
                        $employee_lname = $_POST['employee_lname'];
                        $employee_phone = test_input($_POST['employee_phone']);
                        $employee_email = test_input($_POST['employee_email']);

                        try {
                            $stmt = $con->prepare("insert into employees(first_name,last_name,phone_number,email) values(?,?,?,?) ");
                            $stmt->execute(array($employee_fname, $employee_lname, $employee_phone, $employee_email));

                    ?>
                            <!-- SUCCESS MESSAGE -->

                            <script type="text/javascript">
                                swal("Nuevo Profesional", "El Nuevo Profesional se ha creado con Exito", "success").then((value) => {
                                    window.location.replace("employees.php");
                                });
                            </script>

                    <?php

                        } catch (Exception $e) {
                            echo "<div class = 'alert alert-danger' style='margin:10px 0px;'>";
                            echo 'Error occurred: ' . $e->getMessage();
                            echo "</div>";
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        } elseif ($do == 'Edit') {
            $employee_id = (isset($_GET['employee_id']) && is_numeric($_GET['employee_id'])) ? intval($_GET['employee_id']) : 0;

            if ($employee_id) {
                $stmt = $con->prepare("Select * from employees where employee_id = ?");
                $stmt->execute(array($employee_id));
                $employee = $stmt->fetch();
                $count = $stmt->rowCount();

                if ($count > 0) {
            ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Editar Profesional</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="employees.php?do=Edit&employee_id=<?php echo $employee_id; ?>">
                                <!-- Employee ID -->
                                <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_fname">First Name</label>
                                            <input type="text" class="form-control" value="<?php echo $employee['first_name'] ?>" placeholder="First Name" name="employee_fname">
                                            <?php
                                            $flag_edit_employee_form = 0;
                                            if (isset($_POST['edit_employee_sbmt'])) {
                                                if (empty(test_input($_POST['employee_fname']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Nombre Profesional es Requerido.
                                                    </div>
                                            <?php

                                                    $flag_edit_employee_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_lname">Apellido</label>
                                            <input type="text" class="form-control" value="<?php echo $employee['last_name'] ?>" placeholder="Last Name" name="employee_lname">
                                            <?php
                                            if (isset($_POST['edit_employee_sbmt'])) {
                                                if (empty(test_input($_POST['employee_lname']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Apellido Profesional es Requerido.
                                                    </div>
                                            <?php

                                                    $flag_edit_employee_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_phone">Telefono</label>
                                            <input type="text" class="form-control" value="<?php echo $employee['phone_number'] ?>" placeholder="Phone number" name="employee_phone">
                                            <?php
                                            if (isset($_POST['edit_employee_sbmt'])) {
                                                if (empty(test_input($_POST['employee_phone']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Telefono Profesional es Requerido.
                                                    </div>
                                            <?php

                                                    $flag_edit_employee_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employee_email">Correo</label>
                                            <input type="text" class="form-control" value="<?php echo $employee['email'] ?>" placeholder="E-mail" name="employee_email">
                                            <?php
                                            if (isset($_POST['edit_employee_sbmt'])) {
                                                if (empty(test_input($_POST['employee_email']))) {
                                            ?>
                                                    <div class="invalid-feedback" style="display: block;">
                                                        Correo Profesional es Requerido.
                                                    </div>
                                            <?php

                                                    $flag_edit_employee_form = 1;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"></h4>
                                        <p class="card-description"><code>Servicios del Profesional</code></p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">

                                                            <?php

                                                            if ($employee['manicure'] == 1) { ?>

                                                                <input type="checkbox" name="check_manicure" value="30" class="form-check-input" checked>    Manicure </label>
                                                    <?php


                                                            } else {

                                                    ?>
                                                        <input type="checkbox" name="check_manicure" value="30" class="form-check-input">    Manicure </label>
                                                    <?php


                                                            }

                                                    ?>

                                                    </div>
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <?php if ($employee['pedicure'] == 1) { ?>

                                                                <input type="checkbox" name="check_pedicure" value="31" class="form-check-input" checked>    Pedicure </label>
                                                    <?php


                                                            } else {

                                                    ?>
                                                        <input type="checkbox" name="check_pedicure" value="31" class="form-check-input">    Pedicure </label>
                                                    <?php


                                                            }

                                                    ?>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <?php if ($employee['faciales'] == 1) { ?>
                                                                <input type="checkbox" name="check_faciales" value="31" class="form-check-input" checked>    Faciales </label>
                                                    <?php


                                                            } else {

                                                    ?>
                                                        <input type="checkbox" name="check_faciales" value="31" class="form-check-input">    Faciales </label>
                                                    <?php


                                                            }

                                                    ?>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <?php if ($employee['corporales'] == 1) { ?>
                                                                <input type="checkbox" name="check_corporales" value="32" class="form-check-input" checked>    Masajes </label>

                                                    <?php


                                                            } else {

                                                    ?>
                                                        <input type="checkbox" name="check_corporales" value="32" class="form-check-input">    Masajes </label>
                                                    <?php


                                                            }

                                                    ?>

                                                    </div>


                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-check">
                                                        <label class="form-check-label">
                                                            <?php if ($employee['corporales'] == 1) { ?>
                                                                <input type="checkbox" name="check_depilacion" value="33" class="form-check-input" checked>    Depilacion </label>

                                                    <?php


                                                            } else {

                                                    ?>
                                                        <input type="checkbox" name="check_depilacion" value="33" class="form-check-input">    Depilacion </label>
                                                    <?php


                                                            }

                                                    ?>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- SUBMIT BUTTON -->
                                <button type="submit" name="edit_employee_sbmt" class="btn btn-primary">
                                    Editar Profesional
                                </button>
                            </form>
                            <?php
                            /*** EDIT EMPLOYEE ***/
                            if (isset($_POST['edit_employee_sbmt']) && $_SERVER['REQUEST_METHOD'] == 'POST' && $flag_edit_employee_form == 0) {
                                $employee_fname = test_input($_POST['employee_fname']);
                                $employee_lname = $_POST['employee_lname'];
                                $employee_phone = test_input($_POST['employee_phone']);
                                $employee_email = test_input($_POST['employee_email']);
                                $employee_id = $_POST['employee_id'];
                                $check_manicure = 0;
                                $check_pedicure = 0;
                                $check_faciales = 0;
                                $check_corporales = 0;

                                if (isset($_POST['check_manicure'])) {

                                    $check_manicure = 1;
                                } else {

                                    $check_manicure = 0;
                                }

                                if (isset($_POST['check_pedicure'])) {

                                    $check_pedicure = 1;
                                } else {

                                    $check_pedicure = 0;
                                }

                                if (isset($_POST['check_faciales'])) {

                                    $check_faciales = 1;
                                } else {

                                    $check_faciales = 0;
                                }

                                if (isset($_POST['check_corporales'])) {

                                    $check_corporales = 1;
                                } else {

                                    $check_corporales = 0;
                                }



                                try {
                                    $stmt = $con->prepare("update employees set first_name = ?, last_name = ?, phone_number = ?, email = ? , manicure = ? , pedicure = ? , faciales = ? , corporales = ?  where employee_id = ? ");
                                    $stmt->execute(array($employee_fname, $employee_lname, $employee_phone, $employee_email, $check_manicure, $check_pedicure, $check_faciales, $check_corporales, $employee_id));

                            ?>
                                    <!-- SUCCESS MESSAGE -->

                                    <script type="text/javascript">
                                        swal("Profesional Guardado", "El Profesional ha sido actualizado con éxito.", "success").then((value) => {
                                            window.location.replace("employees.php");
                                        });
                                    </script>

                            <?php

                                } catch (Exception $e) {
                                    echo "<div class = 'alert alert-danger' style='margin:10px 0px;'>";
                                    echo 'Error occurred: ' . $e->getMessage();
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
        <?php
                } else {
                    header('Location: employees.php');
                    exit();
                }
            } else {
                header('Location: employees.php');
                exit();
            }
        }
        ?>
    </div>

<?php

    //Include Footer
    include 'Includes/templates/footer_tables.php';
} else {
    header('Location: login.php');
    exit();
}

?>