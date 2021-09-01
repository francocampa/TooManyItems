<?php 
    class Ubicacion extends Controller{
        public function __construct(){
            
        }
        public function getUbicacionesPorSector($codSector){
            $ubicaciones = [];
            $db = db::conectar();
            $callString = 'SELECT u.codUbicacion, nombre FROM ubicacionsector us RIGHT JOIN ubicacion u on us.codUbicacion=u.codUbicacion WHERE us.codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $ubicaciones[] = $filas;
            }
            return $ubicaciones;
        }
    }