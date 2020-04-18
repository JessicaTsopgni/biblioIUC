<?php
    require_once '../common/idispose.php';
    require_once '../db/mysql.php';
    require_once '../entities/category.php';
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
                    'image'                 => $category->image,
                    'status'                => $category->status
                ];
                $category->id = $this->mysql->save($query, $data);
            }
            catch(Exception $e)
            {
                throw new DAOException($e->errorMessage());
            }
            return $category;
        }
    }
?>