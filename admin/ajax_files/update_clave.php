

<?php
session_start();


require '../../config/conexion.php';

$client_fname = $_POST['client_email'];
$client_user = $_POST['user_admin'];
$client_email = $_POST['admin_email'];

$clavehash = hash("SHA256",$client_fname);


    if (isset($_GET['id'])) {
        $id = $_GET['id'];



        $query = mysqli_query($conexion, "UPDATE barber_admin SET password = '$clavehash' ,

        username = '$client_user' , email = '$client_email'
            WHERE admin_id 	= '1'")
            or die('error: '.mysqli_error($conexion));


        if ($query) {

            //header("location: arquero.php?module=arquero&alert=4");


            echo '<script type="text/javascript">
						window.location.assign("../cambio_clave.php?");
						</script>';
        }
    }


?>