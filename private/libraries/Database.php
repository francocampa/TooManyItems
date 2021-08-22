<?php 
    class db{
        private $dbHost = DB_HOST;
        private $dbUser = DB_USER;
        private $dbPass = DB_PASS;
        private $dbName = DB_NAME;

        public function conectar(){
            $conexion = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
            if ($conexion->connect_errno) {
                die('Ocurrio un error');
            } else {
                $db = $conexion;
            }
            return $db;
        }

    }
?>