<?php
    class JsonObject
    {
        public $status_code;
        public $status_message;
        public $request_data;
        public $response_data;
        private $status_messages = array('error', 'success', 'warning', 'critical');
        public function __construct($status_code, $request_data, $response_data)
        {
            $this->status_code      = $status_code;
            $this->status_message   = $this->status_messages[$status_code];
            $this->request_data     = $request_data;
            $this->response_data    = $response_data;
        }
    }
?>