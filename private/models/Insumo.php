<?php
    class Insumo {
        public function __construct(){
            
        }
        public function insertInsumo($insumo){
            $db = db::conectar();
            $callString = 'CALL insertInsumo('.$_SESSION['cuenta']['ci'].',"'. $_SESSION['cuenta']['token'].'","'.$insumo['codSector'].'","'.$insumo['nombre']. '","' . $insumo['modelo'] . '","' . $insumo['categoria'] . '","' . $insumo['tipo'] . '",' . $insumo['stockMinimo'] . ',' . $insumo['codMarca'] . ',@codInsumo)';
            $consulta = $db->query($callString);
            $consulta = $db->query('SELECT codInsumo FROM insumo order by codInsumo desc limit 1');
            $codInsumo = $consulta->fetch_assoc()['codInsumo'];
            foreach ($insumo['caraceristicasT'] as $caracteristicaT) {
                $callString = 'CALL insertCaracteristicaT(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codInsumo.',"'.$insumo['codSector'].'","'.$caracteristicaT['nombre'].'","'.$caracteristicaT['valor'].'")';
                $consulta = $db->query($callString);
            }
        }
        public function updateInsumo($insumo){
            $db= db::conectar();
            $callString= 'CALL updateInsumo(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '","' . $insumo['codSector'] . '", '. $insumo['codInsumo'] .' ,"' . $insumo['nombre'] . '","' . $insumo['modelo'] . '","' . $insumo['categoria'] . '","' . $insumo['tipo'] . '",' . $insumo['stockMinimo'] . ', '.$insumo['stockActual'].' ,' . $insumo['codMarca'].')';
            $consulta= $db->query($callString);
            foreach ($insumo['caraceristicasT'] as $caracteristicaT) {
                $callString = 'CALL updateCaracteristicaT(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '" , "separaciom", ' . $caracteristicaT['codCaracteristicaT'] . ' ,"' . $caracteristicaT['valor'] . '")';
                $consulta = $db->query($callString);
            }
        }
        public function deleteInsumo($codInsumo, $codSector){
            $db= db::conectar();
            $callString= 'CALL deleteInsumo(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '" , "'.$codSector.'", '.$codInsumo.')';
            echo $callString;
            $consulta=$db->query($callString);
        }
        public function getInsumoPorCategoria($codSector, $categoria){
            $insumos=[];
            $db = db::conectar();
            $callString= "SELECT * FROM insumos WHERE codSector='" . $codSector . "' AND categoria='" . $categoria . "'";
            $consulta=$db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $insumos[] = $filas;
            }
            for($i=0 ; $i < count($insumos) ; $i++) {
                $callString = 'SELECT codMarca, nombre FROM marcaPorInsumo WHERE codInsumo=' . $insumos[$i]['codInsumo'].' AND codSector="'.$codSector.'"';
                $consulta = $db->query($callString);
                $marca = $consulta->fetch_assoc();
                $insumos[$i]['marca']=$marca;

                $caracteristicasT=[];
                $callString = "SELECT codCaracteristicaTecnica, nombre, valor FROM caracteristicaTPorInsumo where codInsumo=" . $insumos[$i]['codInsumo'] . " AND codSector='".$codSector."';
";
                $consulta = $db->query($callString);
                while ($filas = $consulta->fetch_assoc()) {
                    $caracteristicasT[] = $filas;
                }
                $insumos[$i]['caracteristicasT']=$caracteristicasT;
            }
            return $insumos;
        }
    }