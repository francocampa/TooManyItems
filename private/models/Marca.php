<?php
    class Marca{
        public function __construct(){
            
        }
        public function insertMarca($marca, $codSector){
            $db=db::conectar();
            $callString= 'CALL insertMarca(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '","'.$marca['nombre'].'","'.$codSector.'")';
            $consulta=$db->query($callString);
            var_dump($db);
        }
        public function deleteMarca($codMarca){
            $db = db::conectar();
            $callString = 'CALL deleteMarca(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codMarca . ')';
            $consulta = $db->query($callString);
        }
        public function getMarcasPorSector($codSector){
            $marcas=[];
            $db = db::conectar();
            $callString= 'SELECT codMarca, nombre FROM marcaPorSector WHERE codSector="'.$codSector.'"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $marcas[] = $filas;
            }
            return $marcas;
        }
        public function countMarcasPorSector($codSector)
        {
            $marcas = [];
            $db = db::conectar();
            $callString = 'SELECT count(codMarca) FROM marcaPorSector WHERE codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            $marcas=$consulta->fetch_assoc()['count(codMarca)'];
            return $marcas;
        }
        public function countFallasPorMarca($codMarca)
        {
            $db = db::conectar();
            $callString = 'SELECT count(codMarca) FROM fallasPorMarca WHERE codMarca="' . $codMarca . '"';
            $consulta = $db->query($callString);
            $marcas = $consulta->fetch_assoc()['count(codMarca)'];
            return $marcas;
        }
    }
    