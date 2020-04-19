<?php
    class Category
    {
        public $id;
        public $name;
        public $description;
        public $category_parent_id;
        public $image;
        public $image_link;
        public $status;

        public function __construct($id, $name, $description, $category_parent_id, $image,
        $image_link, $status)
        {
            $this->id                   = $id;
            $this->name                 = $name;
            $this->description          = $description;
            $this->category_parent_id   = $category_parent_id;
            $this->image                = $image;
            $this->image_link           = $image_link;
            $this->status               = $status;
        }
    }
?>