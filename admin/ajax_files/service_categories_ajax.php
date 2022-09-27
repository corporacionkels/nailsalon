<?php include '../connect.php'; ?>
<?php include '../Includes/functions/functions.php'; ?>


<?php
	
	if(isset($_POST['do']) && $_POST['do'] == "Add")
	{
        $category_name = test_input($_POST['category_name']);

        $checkItem = checkItem("category_name","service_categories",$category_name);

        if($checkItem != 0)
        {
            $data['alert'] = "Warning";
            $data['message'] = "Este nombre de categoría ya existe!";
            echo json_encode($data);
            exit();
        }
        elseif($checkItem == 0)
        {
        	//Insert into the database
            $stmt = $con->prepare("insert into service_categories(category_name) values(?) ");
            $stmt->execute(array($category_name));

            $data['alert'] = "Success";
            $data['message'] = "La nueva categoría ha sido insertada con éxito !";
            echo json_encode($data);
            exit();
        }
            
	}

    if(isset($_POST['action']) && $_POST['action'] == "Delete")
	{
        $category_id = $_POST['category_id'];
        
        try
        {
            $con->beginTransaction();

            $stmt_services = $con->prepare("SELECT * FROM services_booked as a inner join services as b on b.service_id=a.service_id where b.category_id = ?");
            $stmt_services->execute(array($category_id));
            $services = $stmt_services->fetchAll();
            $services_count = $stmt_services->rowCount();

            if($services_count > 0)
            {
                $data['alert'] = "Warning";
                $data['message'] = "No se puede Eliminar hay Transacciones !";
                echo json_encode($data);
                exit();
            }else{

            $stmt = $con->prepare("DELETE from service_categories where category_id = ?");
            $stmt->execute(array($category_id));
            $con->commit();
            $data['alert'] = "Success";
            $data['message'] = "Categoría ha sido Eliminada con éxito !";
            echo json_encode($data);
            exit();
            }
            
        }
        catch(Exception $exp)
        {
            echo $exp->getMessage() ;
            $con->rollBack();
            $data['alert'] = "Warning";
            $data['message'] =  $exp->getMessage() ;
            echo json_encode($data);
            exit();
        }

    }
    
    if(isset($_POST['action']) && $_POST['action'] == "Edit")
	{
        $category_id = $_POST['category_id'];
        $category_name = test_input($_POST['category_name']);
      

        $checkItem = checkItem("category_name","service_categories",$category_name);

        if($checkItem != 0)
        {
            $data['alert'] = "Warning";
            $data['message'] = "Este nombre de categoría ya existe!";
            echo json_encode($data);
            exit();
        }
        elseif($checkItem == 0)
        {

            try
            {
                $stmt = $con->prepare("UPDATE service_categories set category_name = ? where category_id = ?");
                $stmt->execute(array($category_name, $category_id));

                $data['alert'] = "Success";
                $data['message'] = "El nombre de la categoría se ha actualizado correctamente!";
                echo json_encode($data);
                exit();
            }   
            catch(Exception $e)
            {
                $data['alert'] = "Warning";
                $data['message'] = $e->getMessage();
                echo json_encode($data);
                exit();
            }

            
        }
    }
	
?>