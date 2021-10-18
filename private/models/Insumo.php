<?php
    class Insumo {
        public function __construct(){
            
        }
        public function insertInsumo($insumo){
            $db = db::conectar();
            $callString = 'CALL insertInsumo('.$_SESSION['cuenta']['ci'].',"'. $_SESSION['cuenta']['token'].'","'.$insumo['codSector'].'","'.$insumo['nombre']. '","' . $insumo['modelo'] . '","' . $insumo['categoria'] . '","' . $insumo['tipo'] . '",' . $insumo['stockMinimo'] . ',' . $insumo['codMarca'] . ', "'.$insumo['rutaImagen'].'")';
            $consulta = $db->query($callString);
            $consulta = $db->query('SELECT codInsumo FROM insumo order by codInsumo desc limit 1');
            $codInsumo = $consulta->fetch_assoc()['codInsumo'];
            foreach ($insumo['caraceristicasT'] as $caracteristicaT) {
                $callString = 'CALL insertCaracteristicaT(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codInsumo.',"'.$insumo['codSector'].'","'.$caracteristicaT['nombre'].'","'.$caracteristicaT['valor'].'")';
                $consulta = $db->query($callString);
                var_dump($db);
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
        public function getInsumo($codInsumo, $codSector){
            $insumo = [];
            $db = db::conectar();
            $callString = "SELECT * FROM insumos WHERE codSector='" . $codSector . "' AND codInsumo=" . $codInsumo . "";
            $consulta = $db->query($callString);
            $insumo= $consulta->fetch_assoc();
            
            $callString = 'SELECT codFoto,ruta,nombre FROM imagenPorInsumo WHERE codInsumo=' . $codInsumo . ' AND codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            $foto = $consulta->fetch_assoc();
            $insumo['foto'] = $foto;

            $callString = 'SELECT codMarca, nombre FROM marcaPorInsumo WHERE codInsumo=' . $codInsumo . ' AND codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            $marca = $consulta->fetch_assoc();
            $insumo['marca'] = $marca;

            $caracteristicasT = [];
            $callString = "SELECT codCaracteristicaTecnica, nombre, valor FROM caracteristicaTPorInsumo where codInsumo=" . $codInsumo . " AND codSector='" . $codSector . "';
    ";
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $caracteristicasT[] = $filas;
            }
            $insumo['caracteristicasT'] = $caracteristicasT;

            return $insumo;
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
                $callString = 'SELECT codFoto,ruta,nombre FROM imagenPorInsumo WHERE codInsumo=' . $insumos[$i]['codInsumo'] . ' AND codSector="' . $codSector . '"';
                $consulta = $db->query($callString);
                $foto = $consulta->fetch_assoc();
                $insumos[$i]['foto'] = $foto;

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
        public function getInsumoPorMarca($codSector, $codMarca){
            $insumos = [];
            $db = db::conectar();
            $callString = "SELECT i.* FROM insumos i JOIN marcaPorInsumo mpi ON i.codSector=i.codSector AND i.codInsumo=mpi.codInsumo WHERE i.codSector='" . $codSector . "' AND mpi.codMarca='" . $codMarca . "'";
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $insumos[] = $filas;
            }
            for ($i = 0; $i < count($insumos); $i++) {
                $callString = 'SELECT codMarca, nombre FROM marcaPorInsumo WHERE codInsumo=' . $insumos[$i]['codInsumo'] . ' AND codSector="' . $codSector . '"';
                $consulta = $db->query($callString);
                $marca = $consulta->fetch_assoc();
                $insumos[$i]['marca'] = $marca;

                $caracteristicasT = [];
                $callString = "SELECT codCaracteristicaTecnica, nombre, valor FROM caracteristicaTPorInsumo where codInsumo=" . $insumos[$i]['codInsumo'] . " AND codSector='" . $codSector . "';
    ";
                $consulta = $db->query($callString);
                while ($filas = $consulta->fetch_assoc()) {
                    $caracteristicasT[] = $filas;
                }
                $insumos[$i]['caracteristicasT'] = $caracteristicasT;
            }
            return $insumos;
        }
        public function countInsumoPorCategoria($codSector, $categoria)
        {
            $insumos = [];
            $db = db::conectar();
            $callString = "SELECT count(codInsumo) FROM insumos WHERE codSector='" . $codSector . "' AND categoria='" . $categoria . "'";
            $consulta = $db->query($callString);
            $insumos=$consulta->fetch_assoc()['count(codInsumo)'];
            return $insumos;
        }
        public function countInsumosStockBajoPorSector($codSector){
            $insumos = [];
            $db = db::conectar();
            $callString = "SELECT count(codInsumo) FROM insumos WHERE codSector='" . $codSector . "' AND stockMinimo>stockActual";
            $consulta = $db->query($callString);
            $insumos = $consulta->fetch_assoc()['count(codInsumo)'];
            return $insumos;
        }
        public function getFallasPorInsumo($codInsumo,$codSector){
            $fallas=[];
            $db=db::conectar();
            $callString= 'SELECT nombre, fechaInicio, fechaFinal from insumosConFallasPorInstancia WHERE codInsumo='.$codInsumo.' AND codSector="'.$codSector.'"';
            $consulta=$db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $fallas[]=$filas;
            }
            return $fallas;
        }
        public function getInsumoStockBajo($codSector){
            $insumos = [];
            $db = db::conectar();
            $callString = "SELECT * FROM insumos WHERE codSector='" . $codSector . "' AND stockActual < stockMinimo";
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $insumos[] = $filas;
            }
            for ($i = 0; $i < count($insumos); $i++) {
                $callString = 'SELECT codFoto,ruta,nombre FROM imagenPorInsumo WHERE codInsumo=' . $insumos[$i]['codInsumo'] . ' AND codSector="' . $codSector . '"';
                $consulta = $db->query($callString);
                $foto = $consulta->fetch_assoc();
                $insumos[$i]['foto'] = $foto;

                $callString = 'SELECT codMarca, nombre FROM marcaPorInsumo WHERE codInsumo=' . $insumos[$i]['codInsumo'] . ' AND codSector="' . $codSector . '"';
                $consulta = $db->query($callString);
                $marca = $consulta->fetch_assoc();
                $insumos[$i]['marca'] = $marca;

                $caracteristicasT = [];
                $callString = "SELECT codCaracteristicaTecnica, nombre, valor FROM caracteristicaTPorInsumo where codInsumo=" . $insumos[$i]['codInsumo'] . " AND codSector='" . $codSector . "';
    ";
                $consulta = $db->query($callString);
                while ($filas = $consulta->fetch_assoc()) {
                    $caracteristicasT[] = $filas;
                }
                $insumos[$i]['caracteristicasT'] = $caracteristicasT;
            }
            return $insumos;
        }
    }