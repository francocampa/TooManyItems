<?php
    class PrestamoModel{
        public function __construct()
        {
            
        }
        public function insertPrestamo($prestamo){
            $db=db::conectar();
            $callString= 'CALL insertPrestamo(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$prestamo['ciPrestatario'].',"'.$prestamo['clase'].'","'.$prestamo['fecha'].'","'.$prestamo['hora'].'","'.$prestamo['razon'].'","'.$prestamo['tipo'].'")';
            $consulta=$db->query($callString);
            var_dump($db);
            $consulta=$db->query('SELECT max(codPrestamo) FROM prestamos');
            $codPrestamo=$consulta->fetch_assoc()['max(codPrestamo)'];
            foreach ($prestamo['insumos'] as $insumo) {
                //Detecta si se est[a prestando una instancia o una cantidad de un insumo
                if(!strcmp($insumo['cantidad'],'-1')){       //Se presta una instancia      
                    $callString = 'CALL insertInstanciaParaPrestamo(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '", ' . $insumo['codInstancia'] . ',' . $codPrestamo . ')';
                    $consulta = $db->query($callString);
                }else{                              //Se presta un insumo con cantidad
                    $callString = 'CALL insertInsumoParaPrestamo(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '", '.$insumo['codInsumo'].',"'. $insumo['codSector'].'",'.$codPrestamo.','. $insumo['cantidad'].')';
                    $consulta = $db->query($callString);
                }
            }
        }
        public function getPrestamosPaniol(){
            $prestamos = [];
            $db = db::conectar();
            $callString = 'SELECT * FROM prestamos WHERE tipo="p"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $prestamos[] = $filas;
            }
            for ($i=0; $i < count($prestamos); $i++) {
                $prestamos[$i]['insumos'] = [];
                $callString = 'SELECT codInstancia from instanciasPorPrestamo WHERE codPrestamo=' . $prestamos[$i]['codPrestamo'];
                $consulta = $db->query($callString);
                while ($subfilas = $consulta->fetch_assoc()) {
                    $prestamos[$i]['insumos'][] = $subfilas;
                }
                $callString = 'SELECT codInsumo,codSector,cantidad from insumosPorPrestamo WHERE codPrestamo=' . $prestamos[$i]['codPrestamo'];
                $consulta = $db->query($callString);
                while ($subfilas = $consulta->fetch_assoc()) {
                    $prestamos[$i]['insumos'][] = $subfilas;
                }

                for ($j=0; $j < count($prestamos[$i]['insumos']); $j++) { 
                    if(isset($prestamos[$i]['insumos'][$j]['codInstancia'])){
                        $callString = 'SELECT codInsumo, codSector, identificador FROM instanciasPorInsumo WHERE codInstancia='. $prestamos[$i]['insumos'][$j]['codInstancia'];
                        $consulta = $db->query($callString);
                        $resultado=$consulta->fetch_assoc();
                        $prestamos[$i]['insumos'][$j]['codInsumo']=$resultado['codInsumo'];
                        $prestamos[$i]['insumos'][$j]['codSector'] = $resultado['codSector'];
                        $prestamos[$i]['insumos'][$j]['identificador'] = $resultado['identificador'];
                    }
                    $callString = 'SELECT mi.nombre AS nombreMarca, i.modelo, i.categoria, i.nombre FROM marcaPorInsumo mi right join insumos i ON i.codInsumo=mi.codInsumo AND i.codSector=mi.codSector WHERE i.codInsumo=' . $prestamos[$i]['insumos'][$j]['codInsumo'] . ' AND i.codSector="' . $prestamos[$i]['insumos'][$j]['codSector'] . '"';
                    $consulta = $db->query($callString);
                    $resultado = $consulta->fetch_assoc();
                    $prestamos[$i]['insumos'][$j]['nombreMarca'] = $resultado['nombreMarca'];
                    $prestamos[$i]['insumos'][$j]['nombre'] = $resultado['nombre'];
                    $prestamos[$i]['insumos'][$j]['modelo'] = $resultado['modelo'];
                    $prestamos[$i]['insumos'][$j]['categoria'] = $resultado['categoria'];
                }
            }
            return $prestamos;
        }
        public function getPrestamosClases(){

        }
    }