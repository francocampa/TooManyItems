<?php
    class Marca{
        public function __construct(){
            
        }
        public function getMarcasPorSector($codSector){
            $marcas=[];
            $db = db::conectar();
            $callString= 'SELECT m.codMarca, nombre FROM sectormarca sm RIGHT JOIN marca m on sm.codMarca=m.codMarca WHERE sm.codSector="'.$codSector.'"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $marcas[] = $filas;
            }
            return $marcas;
        }
    }
    