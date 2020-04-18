<?php
    require_once '../common/constants.php';
    require_once '../common/functions.php';
    require_once '../common/idispose.php';
    require_once '../entities/category.php';
    require_once '../repositories/exception-dao.php';
    require_once '../repositories/category-dao.php';
    require_once 'exception-bll.php';
    require_once 'validation-exception-bll.php';
    class CategoryBLL implements iDispose
    {
        private $categoryDAO;
        public function __construct()
        {
            $this->categoryDAO = new CategoryDAO();
        }        
        public function dispose() 
        {
            if($this->categoryDAO != null)
                $this->categoryDAO->dispose();
        }
        private function validate($category)
        {
            $errors = array();
            if($category->image != null && $category->image['size'] > 0) //$category->image === $FILES['<field_name>'][0]
            {
                $upload_image_name = $category->image['name'];
                if(empty($upload_image_name))
                    array_push($errors, "Nom de l'image invalide !");
                    
                $upload_image_tmp_name = $category->image['tmp_name'];
                if(!check_file_type($upload_image_tmp_name, IMAGES_ALLOWED))
                    array_push($errors, "Type d'image invalide !");   
            }
            $name = $category->name;
            if(empty($name))
                array_push($errors, "Le nom ne peut pas être nul !");

            $status = $category->status;
            if(empty($status) || !is_numeric($status))
                array_push($errors, "Statut invalide !"); 

            $category_parent_id = $category->category_parent_id;
            if(!empty($category_parent_id) && !is_numeric($category_parent_id))
                array_push($errors, "Catégorie parent invalide !"); 
            
            return $errors;
        }
        public function add($category, $user_token)
        {
            if($category == null)
                throw new BLLException("Null parameter category !");

            $errors = $this->validate($category);
            if(count($errors) > 0)
                throw new BLLValidationException("Erreur de validation", $errors);

            //load image
            $new_file_name = get_new_upload_file_name($category->image['name'], CATEGORY_IMAGE_PREFIX_NAME);
            $destination = $this->save_image($category->image, $new_file_name);            
            try
            {
                $category->image = $new_file_name;
                return $this->categoryDAO->add($category);
            }
            catch(DAOExeption $e)
            {             
                $this->delete_image($destination);       
                error_log("\n\n".$e->errorMessage(), 3, LOG_ERROR_PATH);
                throw new BLLException("Une erreur lors de l'enregistrement! Réessayer plus tard svp.");
            }
            catch(Exception $e)
            { 
                $this->delete_image($destination);       
                error_log("\n\n".$e->errorMessage(), 3, LOG_ERROR_PATH);
                throw new BLLException("Une erreur lors de l'enregistrement! Réessayer plus tard svp.");
            }
            return null;
        }     
        
        private function delete_image($destination)
        {            
            if(!empty($destination) && file_exists($destination))
                unlink($destination);   
        }

        private function save_image($image, $new_file_name)
        {
            $destination = null;
            if($image != null && $image['size'] > 0) //$image === $FILES['<field_name>'][0]
            {               
                $destination = MEDIA_FOLDER.'/'.$new_file_name;
                if(!image_resize($image['tmp_name'] , CATEGORY_IMAGE_SIZE , $destination)) 
                    throw new BLLException("Erreur lors du téléchargement de l'image! Réessayer plus tard svp.");
            }
            return $destination;
        }
    }
?>