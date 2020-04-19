<?php
    class DuplicateDAOException extends Exception 
    {
        public function errorMessage() 
        {
            $errorMsg = 'DAO Duplicate Error on line '.$this->getLine().' in '.$this->getFile()
            .':\n'.$this->getMessage();
            return $errorMsg;
        }
    }
?>