

<?php
session_start();


require '../../config/conexion.php';

$category_id = $_POST['category_id'];
$category_name = $_POST['category_name'];
$service_category = $_POST['service_category'];
//$check_child = $_POST['flexCheckDefault'];

echo $category_id;
echo $category_name;

if (isset($_POST['flexCheckDefault'])) {

echo $service_category;



}


?>