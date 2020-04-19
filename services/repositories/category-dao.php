<?php
    require_once '../common/constants.php';
    require_once '../common/idispose.php';
    require_once '../db/mysql.php';
    require_once '../entities/category.php';
    require_once 'exception-dao.php';
    require_once 'duplicate-exception-dao.php';
    class CategoryDAO implements iDispose
    {
        private $mysql;
        public function __construct()
        {
            $this->mysql = new MySQL();
        }
        function dispose() {
            if($this->mysql != null)
                $this->mysql->dispose();
        }
        public function add($category)
        {
            try
            {
                if($category == null)
                    throw new DAOException("Null parameter category!");
                $query  = "INSERT INTO `category`";
                $query .= "(";
                $query .= "`name`,";
                $query .= "`description`,";
                $query .= "`category_parent_id`,";
                $query .= "`image`,";
                $query .= "`status`";
                $query .= ")";
                $query .= "VALUES";
                $query .= "(";
                $query .= ":name,";
                $query .= ":description,";
                $query .= ":category_parent_id,";
                $query .= ":image,";
                $query .= ":status";
                $query .= ")";
                $data = [
                    'name'                  => $category->name,
                    'description'           => $category->description,
                    'category_parent_id'    => $category->category_parent_id,
                    'image'                 => $category->image_link,
                    'status'                => $category->status
                ];
                $category->id = $this->mysql->save($query, $data);
            }
            catch(PDOException $e)
            {
                if(in_array($e->getCode(), MYSQL_DUPLICATE_CODES))
                    throw new DuplicateDAOException($e->getMessage());
                throw new DAOException($e->getMessage());
            }
            catch(Exception $e)
            {
                throw new DAOException($e->getMessage());
            }
            return $category;
        }
    }
?>