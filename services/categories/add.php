<?php
    require_once '../entities/category.php';
    require_once '../logics/category-bll.php';
    require_once '../logics/validation-exception-bll.php';
    require_once '../common/constants.php';
    require_once '../common/json-object.php';
    require_once '../common/headers-api.php';

    $id = isset($_REQUEST['id']) && !empty($_REQUEST['id']) ? $_REQUEST['id'] : null;
    $name = isset($_REQUEST['name'])  && !empty($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $description = isset($_REQUEST['description'])  && !empty($_REQUEST['description']) ? $_REQUEST['description'] : null;
    $status = isset($_REQUEST['status'])  && !empty($_REQUEST['status']) ? $_REQUEST['status'] : null;
    $category_parent_id = isset($_REQUEST['category_parent_id'])  && !empty($_REQUEST['category_parent_id']) ? $_REQUEST['category_parent_id'] : null;
    $image = isset($_FILES['image'])  && !empty($_FILES['image']) ? $_FILES['image'] : null;

    $request_data = new Category(0, $name, $description, $category_parent_id,
    ($image != null ? $image['name'] : null), $status);

    $categoryBLL = null;
    try
    {
        $categoryBLL = new CategoryBLL();
                      
        $category = new Category($id, $name, $description, $category_parent_id, $image, $status);
        $category = $categoryBLL->add($category, $USER_TOKEN);
        echo json_encode(new JsonObject(1, $request_data, $category), JSON_UNESCAPED_UNICODE); 
    }
    catch(BLLValidationException $e)
    {
        echo json_encode(new JsonObject(0, $request_data, $e->getErrors()), JSON_UNESCAPED_UNICODE);
    }
    catch(BLLException $e)
    {
        echo json_encode(new JsonObject(0, $request_data, $e->errorMessage()), JSON_UNESCAPED_UNICODE);
    }
    catch(Exception $e)
    {
        error_log("\n\n".$e->errorMessage(), 3, LOG_ERROR_PATH);
        echo json_encode(new JsonObject(3, $request_data, "Une erreur est survenue! Réessayez plus tard svp."), JSON_UNESCAPED_UNICODE);
    }
    finally
    {
        if($categoryBLL != null)
            $categoryBLL->dispose();
    }
?>