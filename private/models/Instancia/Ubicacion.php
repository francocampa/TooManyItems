<?php 
    class Ubicacion{
        public function __construct(){
            
        }
        public function insertUbicacion($ubicacion, $codSector){
            $db = db::conectar();
            $callString = 'CALL insertUbicacion(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '","' . $ubicacion['nombre'] . '","' . $ubicacion['tipo'] . '","' . $codSector . '")';
            $consulta = $db->query($callString);
        }
        public function deleteUbicacion($codUbicacion)
        {
            $db = db::conectar();
            $callString = 'CALL deleteUbicacion(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codUbicacion . ')';
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
        public function countUbicacionesPorSector($codSector)
        {
            $ubicaciones = [];
            $db = db::conectar();
            $callString = 'SELECT count(codUbicacion) FROM ubicacionesPorSector WHERE codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            $ubicaciones=$consulta->fetch_assoc()['count(codUbicacion)'];
            return $ubicaciones;
        }
        public function countFallasPorUbicacion($codUbicacion){
            $ubicaciones = [];
            $db = db::conectar();
            $callString = 'SELECT count(codUbicacion) FROM fallasPorUbicacion WHERE codUbicacion="' . $codUbicacion . '"';
            $consulta = $db->query($callString);
            $ubicaciones = $consulta->fetch_assoc()['count(codUbicacion)'];
            return $ubicaciones;
        }
    }