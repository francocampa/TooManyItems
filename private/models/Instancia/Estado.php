<?php   
    class Estado extends Controller{
        public function __construct(){
            
        }
        public function getEstados(){
            $estados=[];
            $db=db::conectar();
            $callString='SELECT * FROM estado';
            $consulta=$db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $estados[] = $filas;
            }
            return $estados;
        }
    }