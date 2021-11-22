<?php
    class Instancia{
        public function __construct(){
            
        }
        public function getComprasPorInsumo($codInsumo, $codSector){
            $compras=[];
            $db= db::conectar();
            $callString= 'SELECT * FROM comprasPorInsumo c WHERE c.codInsumo='.$codInsumo.' AND c.codSector="'.$codSector.'"';
            $consulta= $db->query($callString);
            while($filas = $consulta->fetch_assoc()){
                $compras[]=$filas;
            }
            for ($i=0;$i<count($compras); $i++) {
                $callString= 'SELECT codGarantia,tipo,fechaInicio,fechaTerminacion FROM garantiaPorCompra WHERE codInsumo='.$compras[$i]['codInsumo']. ' AND codSector="'.$compras[$i]['codSector']. '" AND codCompra=' . $compras[$i]['codCompra'];
                $consulta=$db->query($callString);
                $garantia= $consulta->fetch_assoc();
                $compras[$i]['garantia']=$garantia;
            
                $callString = 'SELECT codInfoCompra,costo,tipo,fechaAdquisicion FROM infoCompraPorCompra WHERE codInsumo=' . $compras[$i]['codInsumo'] . ' AND codSector="' . $compras[$i]['codSector'] . '" AND codCompra=' . $compras[$i]['codCompra'];
                $consulta = $db->query($callString);
                $infoCompra = $consulta->fetch_assoc();
                if($infoCompra !=null){
                    $callString = 'SELECT codProveedor,nombre,telefono from proveedorPorInfoCompra WHERE codInfoCompra=' . $infoCompra['codInfoCompra'];
                    $consulta = $db->query($callString);
                    $proveedor = $consulta->fetch_assoc();
                    $infoCompra['proveedor'] = $proveedor;
                }
                $compras[$i]['infoCompra'] = $infoCompra;

                $callString = 'SELECT codInstancia,identificador FROM instanciasPorCompra WHERE codInsumo=' . $compras[$i]['codInsumo'] . ' AND codSector="' . $compras[$i]['codSector'] . '" AND codCompra='.$compras[$i]['codCompra'];
                $consulta = $db->query($callString);
                $instancias=[];
                $j=0;
                while ($filas = $consulta->fetch_assoc()) { //Las instancias tienen su informaci[on dividida por lo que se requieren m[as consultas
                    $instancias[] = $filas;

                    $callString= 'SELECT estado FROM estadoPorInstancia WHERE codInstancia='.$instancias[$j]['codInstancia'];
                    $subConsulta=$db->query($callString);
                    $estado=[];
                    while($subFilas= $subConsulta->fetch_assoc()['estado']){
                        $estado[]=$subFilas;
                    }
                    $instancias[$j]['estado']=end($estado);

                    $callString = 'SELECT codUbicacion,nombreUbicacion,tipo FROM ubicacionPorInstancia WHERE codInstancia=' . $instancias[$j]['codInstancia'];
                    $subConsulta = $db->query($callString);
                    $ubicacion = [];
                    while ($subFilas = $subConsulta->fetch_assoc()) {
                        $ubicacion[] = $subFilas;
                    }
                    $instancias[$j]['ubicacion'] = end($ubicacion);

                    $callString = 'SELECT codFalla, nombre, observaciones,diagnostico,fechaInicio,fechaFinal FROM fallasPorInstancia WHERE codInstancia=' . $instancias[$j]['codInstancia'];
                    $subConsulta = $db->query($callString);
                    $falla = [];
                    while ($subFilas = $subConsulta->fetch_assoc()) {
                        $falla[] = $subFilas;
                    }
                    if(end($falla)['fechaFinal']==null){    //Si es null significa que no se solucion[o
                        $instancias[$j]['falla'] = end($falla);
                    }else{
                        $instancias[$j]['falla'] = false;
                    }
                    $j++;
                }
                $compras[$i]['instancias'] = $instancias;
            }
            return $compras;
        }
        public function getInstanciasPorInsumo($codInsumo, $codSector){
            $db=db::conectar();
            $callString='SELECT codInstancia, identificador FROM instanciasPorInsumo ipi WHERE ipi.codInsumo='.$codInsumo.' AND ipi.codSector="'.$codSector.'"';
            $consulta=$db->query($callString);
            $instancias = [];
            while ($filas = $consulta->fetch_assoc()) {
                $instancias[] = $filas;
            }
            return $instancias;
        }
        public function insertInstancias($codInsumo, $codSector, $instancias, $infoCompra, $garantia, $cantidad){
            $db= db::conectar();

            //Ingresar info de compra
            $callString= 'CALL insertCompra(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codInsumo.',"'.$codSector. '",' . $cantidad . ')';
            $consulta = $db->query($callString);
            $consulta = $db->query("SELECT max(codCompra) FROM comprasPorInsumo");
            $codCompra = $consulta->fetch_assoc()['max(codCompra)'];
            if($infoCompra != -1){
                $callString= 'CALL insertInfoCompra(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codCompra.','.$codInsumo.',"'.$codSector.'",'.$infoCompra['costo'].',"'.$infoCompra['tipo'].'","'.$infoCompra['fechaCompra'].'",'.$infoCompra['codProveedor'].')';
                $consulta=$db->query($callString);
            }
            echo "<br>";
            if($garantia != -1){
                $callString= 'CALL insertGarantia(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$garantia['tipo'].'","'.$garantia['fechaInicio'].'","'.$garantia['fechaLimite'].'")';
                $consulta = $db->query($callString);
            }
            echo "<br>";

            if($instancias != -1){
                foreach ($instancias as $instancia) {
                    $callString= 'CALL insertInstancia(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'. $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$instancia['identificador'].'","'.$instancia['estado'].'",'.$instancia['ubicacion'].')';
                    $consulta = $db->query($callString);
                }
            }
            //Ingresar garantia

            //Ingresar instancias

        }
        public function updateCompra($compra, $instancia, $infoCompra, $garantia){
            $db=db::conectar();
            $token= ' "'.$_SESSION['cuenta']['token'].'"';
            if($instancia != -1){
                $callString = 'CALL updateInstancia(' . $_SESSION['cuenta']['ci'] . ',' . $token . ',"' . $compra['codSector'] . '",' . $compra['codInsumo'] . ',' . $compra['codCompra'] . ', "' . $instancia['identificador'] . '" , "' . $instancia['estado'] . '", ' . $instancia['ubicacion'] . ', '.$instancia['codInstancia'].')';
                $consulta=$db->query($callString);
            }
            if ($infoCompra != -1) {
                $callString = 'CALL updateInfoCompra(' . $_SESSION['cuenta']['ci'] . ',' . $token . ',"' . $compra['codSector'] . '",' . $compra['codInsumo'] . ',' . $compra['codCompra'] . ',' . $infoCompra['costo'] . ',"' . $infoCompra['tipo'] . '","' . $infoCompra['fechaCompra'] . '",' . $infoCompra['proveedor'] . ', '.$infoCompra['codInfoCompra'].')';
                $consulta = $db->query($callString);
            }
            if($garantia != -1){
                $callString = 'CALL updateGarantia(' . $_SESSION['cuenta']['ci'] . ',' . $token . ',"' . $compra['codSector'] . '",' . $compra['codInsumo'] . ',' . $compra['codCompra'] . ',"' . $garantia['tipo'] . '","' . $garantia['fechaInicio'] . '","' . $garantia['fechaLimite'] . '", '. $garantia['codGarantia'].')';
                $consulta = $db->query($callString);
            }
           
        }

        public function deleteInstancia($codInstancia, $codSector, $codInsumo){
            $db = db::conectar();
            $callString= 'CALL deleteInstancia(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '", '. $codInstancia . ', ' .$codInsumo.' ,"' . $codSector . '")';
            $consulta=$db->query($callString);
            //var_dump($db);
        }
        public function deleteCompra($codCompra, $codInsumo, $codSector){
            $db = db::conectar();
            $callString = 'CALL deleteCompra(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '", "' . $codSector . '",' . $codInsumo . ',' . $codCompra . ' )';
            $consulta = $db->query($callString);
            //var_dump($db);
        }

        public function insertFalla($codInstancia, $falla){
            $db = db::conectar();
            $callString = 'CALL insertFalla(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codInstancia . ',"' . $falla['nombre'] . '","' . $falla['observaciones'] . '", "'.$falla['diagnostico'].'" )';
            echo $callString;
            $consulta = $db->query($callString);
            //var_dump($db);
        }
        public function solucionarFalla($codInstancia, $codFalla){
            $db = db::conectar();
            $callString = 'CALL solucionarFalla(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codInstancia . ',' . $codFalla . ')';
            echo $callString;
            $consulta = $db->query($callString);
            //var_dump($db);
        }

        public function countInstanciasConFallasPorSector($codSector){
            $db=db::conectar();
            $callString= 'SELECT count(codFalla) FROM fallasActivas WHERE codSector="'.$codSector.'"';
            $consulta=$db->query($callString);
            $instanciasFalladas=$consulta->fetch_assoc()['count(codFalla)'];
            return $instanciasFalladas;
        }

        public function getInstanciasPorProveedor($codSector, $codProveedor){
            $db = db::conectar();
            $callString = 'SELECT identificador, codInstancia, codSector, nombre FROM instanciasPorProveedor WHERE codSector="' . $codSector . '" AND codProveedor='.$codProveedor.'';
            $consulta = $db->query($callString);
            $instancias = [];
            while ($filas = $consulta->fetch_assoc()) {
                $instancias[] = $filas;
            }
            return $instancias;
        }
        public function getFallasPorInstancia($codInstancia){
            $db = db::conectar();
            $callString = 'SELECT codFalla, nombre, fechaInicio,fechaFinal FROM fallasPorProveedor WHERE codInstancia=' . $codInstancia . '';
            $consulta = $db->query($callString);
            $instancias = [];
            while ($filas = $consulta->fetch_assoc()) {
                $instancias[] = $filas;
            }
            return $instancias;
        }

        public function getInstanciasPorUbicacion($codUbicacion,$codSector){
            $db = db::conectar();
            $callString = 'SELECT identificador, codInstancia, codSector, nombre FROM ubicacionPorInstancia WHERE codSector="' . $codSector . '" AND codUbicacion=' . $codUbicacion . '';
            $consulta = $db->query($callString);
            $instancias = [];
            while ($filas = $consulta->fetch_assoc()) {
                $instancias[] = $filas;
            }
            return $instancias;
        }

        public function getInstanciasConFalla($codSector){
            $db = db::conectar();
            $callString = 'SELECT identificador, codInstancia,codSector, codInsumo,codFalla,fechaInicio FROM insumosConFallasPorInstancia WHERE codSector="' . $codSector . '" AND fechaFinal IS NULL';
            $consulta = $db->query($callString);
            $instancias = [];
            while ($filas = $consulta->fetch_assoc()) {
                $instancias[] = $filas;
            }
            for ($i=0; $i < count($instancias); $i++) {
                $subCallString = 'SELECT nombre as nombreInsumo, modelo FROM insumos WHERE codInsumo=' . $instancias[$i]['codInsumo'] . ' AND codSector="'.$instancias[$i]['codSector'].'"';
                $subConsulta = $db->query($subCallString);
                $instancias[$i]['insumo'] = $subConsulta->fetch_assoc();

                $subCallString = 'SELECT nombre FROM marcaPorInsumo WHERE codInsumo=' . $instancias[$i]['codInsumo'] . ' AND codSector="' . $instancias[$i]['codSector'] . '"';
                $subConsulta = $db->query($subCallString);
                $instancias[$i]['marca'] = $subConsulta->fetch_assoc();

                $callString = 'SELECT nombre, observaciones,diagnostico,fechaInicio,fechaFinal FROM fallasPorInstancia WHERE codFalla=' . $instancias[$i]['codFalla'];
                $subConsulta = $db->query($callString);
                $instancias[$i]['falla'] = $subConsulta->fetch_assoc();
            }
            return $instancias;
        }
        public function getComprasPorMes($codSector){
            $db=db::conectar();
            $callString= 'SELECT * FROM auditorias a WHERE year(fecha)=year(now()) AND tipo="a" AND tabla="Compra" AND SUBSTRING_INDEX(SUBSTRING_INDEX(codigo,"|",-2),"|",1)="'.$codSector.'"';
            //echo $callString;
            $consulta=$db->query($callString);
            $compras=[];
            while($filas = $consulta->fetch_assoc()){
                $compras []=$filas;
            }
            return $compras;
        }
    }