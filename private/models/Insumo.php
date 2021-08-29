<?php
    class Insumo {
        public function __construct(){
            
        }
        public function insertInsumo($insumo){
            $db = db::conectar();
            $callString = 'CALL insertInsumo("'.$insumo['codSector'].'","'.$insumo['nombre']. '","' . $insumo['modelo'] . '","' . $insumo['categoria'] . '","' . $insumo['tipo'] . '",' . $insumo['stockMinimo'] . ',' . $insumo['codMarca'] . ',@codInsumo)';
            $consulta = $db->query($callString);
            $consulta = $db->query('SELECT @codInsumo');
            $codInsumo = $consulta->fetch_array()['@codInsumo'];
            foreach ($insumo['caraceristicasT'] as $caracteristicaT) {
                $callString = 'CALL insertCaracteristicaT('.$codInsumo.',"'.$insumo['codSector'].'","'.$caracteristicaT['nombre'].'","'.$caracteristicaT['valor'].'")';
                $consulta = $db->query($callString);
            }
        }
        public function getInsumoPorCategoria($codSector, $categoria){
            $insumos=[];
            $db = db::conectar();
            $callString= "SELECT * FROM insumo WHERE insumo.codSector='" . $codSector . "' AND insumo.categoria='" . $categoria . "'";
            $consulta=$db->query($callString);
        //$insumos=$consulta->fetch_array();
            while ($filas = $consulta->fetch_assoc()) {
                $insumos[] = $filas;
            }
            for($i=0 ; $i < count($insumos) ; $i++) {
                $callString = 'SELECT nombre FROM marcainsumo mi RIGHT JOIN marca m ON mi.codMarca=m.codMarca WHERE mi.codInsumo=' . $insumos[$i]['codInsumo'];
                $consulta = $db->query($callString);
                $marca = $consulta->fetch_array()['nombre'];
                $insumos[$i]['marca']=$marca;
            }
            return $insumos;
        }
    }