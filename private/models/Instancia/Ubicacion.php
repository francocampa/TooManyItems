<?php 
    class Ubicacion{
        public function __construct(){
            
        }
        public function insertUbicacion($ubicacion, $codSector){
            $db = db::conectar();
            $callString = 'CALL insertUbicacion(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '","' . $ubicacion['nombre'] . '","' . $ubicacion['tipo'] . '","' . $codSector . '")';
            $consulta = $db->query($callString);
        }
        public function getUbicacionesPorSector($codSector){
            $ubicaciones = [];
            $db = db::conectar();
            $callString = 'SELECT codUbicacion, nombre, tipo FROM ubicacionesPorSector WHERE codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $ubicaciones[] = $filas;
            }
            return $ubicaciones;
        }
    }