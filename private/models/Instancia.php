<?php
    class Instancia{
        public function __construct(){
            
        }
        public function getInstanciasPorInsumo($codInsumo, $codSector){
            $instancias=[];
            $db= db::conectar();
            $callString='SELECT * FROM instancia i WHERE i.codInsumo='.$codInsumo.' i.codSector="'.$codSector.'"';
            $consulta= $db->query($callString);
            // while($filas = $consulta->fetch_assoc()){
            //     $instancias[]=$filas;
            // }
            return $instancias;
        }
        public function insertInstancias($codInsumo, $codSector, $instancias, $infoCompra, $garantia){
            $db= db::conectar();

            //Ingresar info de compra
            $callString='CALL insertCompra('.$codInsumo.',"'.$codSector.'")';
            $consulta = $db->query($callString);
            $consulta = $db->query("SELECT max(codCompra) FROM Compra");
            $codCompra = $consulta->fetch_assoc()['max(codCompra)'];
            if($infoCompra != -1){
                $callString='CALL insertInfoCompra('.$codCompra.','.$codInsumo.',"'.$codSector.'",'.$infoCompra['costo'].',"'.$infoCompra['tipo'].'",'.$infoCompra['cantidad'].',"'.$infoCompra['fechaCompra'].'",'.$infoCompra['codProveedor'].')';
                $consulta=$db->query($callString);
                var_dump($db);
            }
            if($garantia != -1){
                $callString= 'CALL insertGarantia(' . $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$garantia['tipo'].'","'.$garantia['fechaInicio'].'","'.$garantia['fechaLimite'].'")';
                $consulta = $db->query($callString);
            }
            if($instancias != -1){
                foreach ($instancias as $instancia) {
                    $callString='CALL insertInstancia('. $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$instancia['identificador'].'","'.$instancia['estado'].'",'.$instancia['ubicacion'].')';
                    $consulta = $db->query($callString);
                }
            }
            //Ingresar garantia

            //Ingresar instancias

        }
    }