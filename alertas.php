<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Cita || Espacio Teodora</title>
</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php


if ($_GET['act']=='insert') {
   
}

elseif ($_GET['act']=='update') {
    
        
    ?>	
	<script type="text/javascript">
	swal({
    title: "La Seleccion de la Hora esta fuera del Horario de Atencion",
    text: "Agendar Servicios!",
    icon: "warning",
    buttons: ["Deseas Salir?", "Deseas Seleccionarlo otro Horario?"],
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
}

elseif ($_GET['act']=='delete') {
   
 
    ?>	
	<script type="text/javascript">
	swal({
    title: "La Seleccion del Dia esta fuera del Horario de Atencion",
    text: "Agendar Servicios!",
    icon: "warning",
    buttons: ["Deseas Salir?", "Deseas Seleccionarlo otro Horario?"],
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
   
   
}       

?>