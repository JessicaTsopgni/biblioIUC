<?php
    class BLLException extends Exception 
    {
        public function errorMessage() 
        {
            $errorMsg = 'BLL Error on line '.$this->getLine().' in '.$this->getFile()
            .':\n'.$this->getMessage();
            return $errorMsg;
        }
    }
?>