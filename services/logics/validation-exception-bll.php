<?php
    require_once 'exception-bll.php';
    class BLLValidationException extends BLLException 
    {
        private $errors;
        public function __construct($message, $errors) 
        {
            $this->errors = $errors;
            parent::__construct($message);
        }
        public function getErrors() 
        {
            return $this->errors;
        }
        public function errorMessage() 
        {
            return $this->getMessage();
        }
    }
?>