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
    $image_link = ($image != null ? $image['name'] : null);
    $request_data = new Category(0, $name, $description, $category_parent_id,
    $image, $image_link, $status);

    $categoryBLL = null;
    try
    {
        $categoryBLL = new CategoryBLL();
                      
        $category = new Category($id, $name, $description, $category_parent_id, $image, $image_link, $status);
        $category = $categoryBLL->add($category, $USER_TOKEN);
        echo json_encode(new JsonObject(1, $request_data, $category), JSON_UNESCAPED_UNICODE); 
    }
    catch(BLLValidationException $e)
    {
        http_response_code(400);
        echo json_encode(new JsonObject(0, $request_data, $e->getErrors()), JSON_UNESCAPED_UNICODE);
    }
    catch(BLLException $e)
    {
        http_response_code(500);
        echo json_encode(new JsonObject(0, $request_data, array($e->getMessage())), JSON_UNESCAPED_UNICODE);
    }
    catch(Exception $e)
    {
        http_response_code(500);
        error_log("\n\n".$e->getMessage(), 3, LOG_ERROR_PATH);
        echo json_encode(new JsonObject(3, $request_data, array("Une erreur est survenue! Réessayez plus tard svp.")), JSON_UNESCAPED_UNICODE);
    }
    finally
    {
        if($categoryBLL != null)
            $categoryBLL->dispose();
    }
?>