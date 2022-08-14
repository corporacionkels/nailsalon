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

    $appointment_id = $_GET['id'];
    ?>

    <script type="text/javascript">
        swal({
                title: "Esta Seguro de Cancelar el Agendamiento?",
                text: "Se Cancelara el Agendamiento en Curso!",
                icon: "warning",
                buttons: ["No lo Cancelare", "Si lo Cancelare"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "delete_cancel_appoinment_complementary.php";
                } else {

                    window.location = "javascript:history.back()";

                }
            });
    </script>