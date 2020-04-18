<?php
    require_once '../common/idispose.php';
    class MySQL implements iDispose
    {
        private     $server;
        private     $user_id;
        private     $password;
        private     $options;
        protected   $con;
        
        public function __construct()
        {           
            $config             = parse_ini_file("config.ini", true);
            $this->server       = "mysql:host=".$config["MySQL"]["host"].";";
            $this->server      .= "mysql:host=".$config["MySQL"]["port"].";";
            $this->server      .= "dbname=".$config["MySQL"]["database"].";";
            $this->server      .= "charset=".$config["MySQL"]["charset"];
            $this->user_id     .= $config["MySQL"]["user_id"];
            $this->password    .= $config["MySQL"]["password"];
            $this->options     = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            $this->con = new PDO($this->server, $this->user_id, $this->password, $this->options);                
        }

        public function save($query, $params)
        {
            $stmt = $this->con->prepare($query);
            if(!empty($params))            
                $stmt->execute($params);
            else
                $stmt->execute();
            $id = $this->con->lastInsertId();
            return $id;
        }
        public function read($query, $params)
        {
            $stmt = $this->con->prepare($query) ;            
            if(!empty($params))            
                $stmt->execute($params);
            else
                $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }        
        public function value($query, $params)
        { 
            $stmt = $this->con->prepare($query) ;            
            if(!empty($params))            
                $stmt->execute($params);
            else
                $stmt->execute();
            return $stmt->fetchColumn(); 
        }
        public function dispose() 
        {
            $this->con = null;
        }
    }
    
?>
