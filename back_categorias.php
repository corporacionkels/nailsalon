<?php

require 'config/conexion.php';


// Selected SERVICES

$query = mysqli_query($conexion, "DELETE FROM  tempory_appoinments")
		or die('error: ' . mysqli_error($conexion));


        echo '<script type="text/javascript">
                
			  window.location.assign("categorias.php");
			  </script>';


?>