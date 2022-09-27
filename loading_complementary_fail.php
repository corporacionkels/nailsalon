<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cita || Espacio Teodora</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php
include "connect.php";
include "Includes/functions/functions.php";
include "Includes/templates/header.php";
require 'config/conexion.php';
//include "Includes/templates/navbar.php";


// Chequeo de Servicios Existentes//


    ?>	
<script type="text/javascript">
swal({
    title: "Servicios Complementarios",
    text: "Agendar Servicios Complementarios!",
    icon: "warning",
    buttons: ["Sin Servicios?", "Ir a Configuracion de Sistema?"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
       window.location = "javascript:history.back()";
    } else {
    
       window.location = "categorias.php";

    }
});

</script>
<?php	
   


//


//echo 'Los Empleados que pueden atenderme ';
//echo $hola;
//echo 'Los Empleados que estan ocupados ';
//echo $hola - $atiende;
//echo 'Los Empleados que estan disponibles ';
//echo $atiende;
