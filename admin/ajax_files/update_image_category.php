<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

</head>
<body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php
require_once "../../config/conexion.php";

$paciente = 'Paciente';

$id_user = mysqli_real_escape_string($conexion, trim($_POST['id_user']));

//echo $services;



$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];

//echo $id_user ;

//Si existe imagen y tiene un tamaño correcto

   //indicamos los formatos que permitimos subir a nuestro servidor
   if (($_FILES["imagen"]["type"] == "image/gif")
   || ($_FILES["imagen"]["type"] == "image/jpeg")
   || ($_FILES["imagen"]["type"] == "image/jpg")
   || ($_FILES["imagen"]["type"] == "image/png"))
   {
      // Ruta donde se guardarán las imágenes que subamos
      $directorio = $_SERVER['DOCUMENT_ROOT'].'/agendas/admin/imagenes/';
      // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
      move_uploaded_file($_FILES['imagen']['tmp_name'],$directorio.$nombre_img);

      $query = mysqli_query($conexion, "UPDATE service_categories SET foto 	= '$nombre_img'
    
      WHERE category_id = '$id_user'")
      or die('error : '.mysqli_error($conexion));
    } 
    else 
    {
       //si no cumple con el formato
       //echo "No se puede subir una imagen con ese formato ";
    }


?>

<script type="text/javascript">
swal({
    title: "Registros Guardados con Exito",
    text: "Proceso de Registro de Pacientes!",
    icon: "success",
    buttons: ["", "Continuar"],
    dangerMode: false,
})
.then((willDelete) => {
    if (willDelete) {
       window.location = "javascript:history.back()";
    } else {
    
       window.location = "javascript:history.back()";

    }
});
</script>
<?php
//echo '<script type="text/javascript">
//window.location.assign("javascript:history.back()");
//</script>';

//echo 'El paciente es ';
//echo $nombre_paciente;
//echo 'Su correo es ';
//echo $correo_paciente;
//echo 'Y su contraseña es ';
//echo $contrasena_paciente ;

?>