<?php
    class DAOException extends Exception 
    {
        public function errorMessage() 
        {
            $errorMsg = 'DAO Error on line '.$this->getLine().' in '.$this->getFile()
            .':\n'.$this->getMessage();
            return $errorMsg;
        }
    }
?>