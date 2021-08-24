<?php 
    class db{

        public static function conectar(){
            $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            if ($conexion->connect_errno) {
                die('Ocurrio un error');
            } else {
                $db = $conexion;
            }
            return $db;
        }

    }
?>