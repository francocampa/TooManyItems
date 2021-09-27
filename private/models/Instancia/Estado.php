<?php   
    class Estado{
        public function __construct(){
            
        }
        public function getEstados(){
            $estados=[];
            $db=db::conectar();
            $callString='SELECT * FROM estados';
            $consulta=$db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $estados[] = $filas;
            }
            return $estados;
        }
    }