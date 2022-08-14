<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Cita || Espacio Teodora</title>
</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php

    require 'config/conexion.php';


    // Selected SERVICES

   // $selected_services = $_POST['selected_services'];

    $query = mysqli_query($conexion, "SELECT * FROM  tempory_appoinments")
        or die('error: ' . mysqli_error($conexion));

    $data_appoinment = mysqli_fetch_assoc($query);

    $appointment_id = $data_appoinment['appoinments_id'];

    $appoinment_next = $appointment_id + 1;

    //echo $appointment_id;

    $query = mysqli_query($conexion,  "DELETE FROM appointments WHERE appointment_id='$appointment_id'")
        or die('error: ' . mysqli_error($conexion));

    $query = mysqli_query($conexion,  "DELETE FROM services_booked WHERE appointment_id='$appointment_id'")
        or die('error: ' . mysqli_error($conexion));   
        
    $query = mysqli_query($conexion,  "DELETE FROM appointments WHERE appointment_id='$appoinment_next'")
        or die('error: ' . mysqli_error($conexion));

    $query = mysqli_query($conexion,  "DELETE FROM services_booked WHERE appointment_id='$appoinment_next'")
        or die('error: ' . mysqli_error($conexion));        
    


    $query = mysqli_query($conexion,  "DELETE FROM tempory_appoinments")
        or die('error: ' . mysqli_error($conexion));
    


    ?>
    <script type="text/javascript">
        swal({
                title: "Su Agendamiento fue Cancelado",
                text: "Canelacion de Agendamiento!",
                icon: "info",
                buttons: ["Deseo Salir", "Desea Realizar uno Nuevo?"],
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "categorias.php";
                } else {

                    window.location = "https://www.espacioteodora.cl";

                }
            });
    </script>