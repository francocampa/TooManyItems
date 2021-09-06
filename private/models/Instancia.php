<?php
    class Instancia{
        public function __construct(){
            
        }
        public function getComprasPorInsumo($codInsumo, $codSector){
            $compras=[];
            $db= db::conectar();
            $callString='SELECT * FROM Compra c WHERE c.codInsumo='.$codInsumo.' AND c.codSector="'.$codSector.'"';
            $consulta= $db->query($callString);
            while($filas = $consulta->fetch_assoc()){
                $compras[]=$filas;
            }
            for ($i=0;$i<count($compras); $i++) {
                $callString='SELECT g.codGarantia,tipo,fechaInicio,fechaTerminacion FROM garantiacompra gc JOIN garantia g ON gc.codGarantia=g.codGarantia WHERE gc.codInsumo='.$compras[$i]['codInsumo']. ' AND gc.codSector="'.$compras[$i]['codSector'].'"';
                $consulta=$db->query($callString);
                $garantia= $consulta->fetch_assoc();
                $compras[$i]['garantia']=$garantia;

                $callString = 'SELECT ic.codInfoCompra,costo,tipo,cantidad,fechaAdquisicion FROM infoCompracompra icc JOIN infoCompra ic ON icc.codInfoCompra=ic.codInfoCompra WHERE icc.codInsumo=' . $compras[$i]['codInsumo'] . ' AND icc.codSector="' . $compras[$i]['codSector'] . '"';
                $consulta = $db->query($callString);
                $infoCompra = $consulta->fetch_assoc();
                    $callString='SELECT p.* from proveedorinfocompra pic JOIN proveedor p ON pic.codProveedor=p.codProveedor WHERE pic.codInfoCompra='.$infoCompra['codInfoCompra'];
                    $consulta = $db->query($callString);
                    $proveedor = $consulta->fetch_assoc();
                    $infoCompra['proveedor']=$proveedor;
                $compras[$i]['infoCompra'] = $infoCompra;

                $callString = 'SELECT ic.codInstancia,identificador FROM instanciacompra ic JOIN instancia i ON ic.codInstancia=i.codInstancia WHERE ic.codInsumo=' . $compras[$i]['codInsumo'] . ' AND ic.codSector="' . $compras[$i]['codSector'] . '"';
                $consulta = $db->query($callString);
                $instancias=[];
                $j=0;
                while ($filas = $consulta->fetch_assoc()) { //Las instancias tienen su informaci[on dividida por lo que se requieren m[as consultas
                    $instancias[] = $filas;

                    $callString= 'SELECT estado FROM estadoinstancia ei WHERE ei.codInstancia='.$instancias[$j]['codInstancia']. ' AND ei.fecha=(SELECT max(fecha) FROM estadoInstancia ei WHERE ei.codInstancia=' . $instancias[$j]['codInstancia'] . ')';
                    $subConsulta=$db->query($callString);
                    $estado=$subConsulta->fetch_assoc()['estado'];
                    $instancias[$j]['estado']=$estado;

                    $callString = 'SELECT u.* FROM ubicacioninstancia ui JOIN ubicacion u ON ui.codUbicacion=u.codUbicacion WHERE ui.codInstancia=' . $instancias[$j]['codInstancia'] . ' AND ui.fecha=(SELECT max(fecha) FROM ubicacioninstancia ui WHERE ui.codInstancia=' . $instancias[$j]['codInstancia'] . ')';
                    $subConsulta = $db->query($callString);
                    $ubicacion = $subConsulta->fetch_assoc();
                    $instancias[$j]['ubicacion'] = $ubicacion;

                    $j++;
                }
                $compras[$i]['instancias'] = $instancias;
            }
            return $compras;
        }
        public function insertInstancias($codInsumo, $codSector, $instancias, $infoCompra, $garantia){
            $db= db::conectar();

            //Ingresar info de compra
            $callString= 'CALL insertCompra(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codInsumo.',"'.$codSector.'")';
            $consulta = $db->query($callString);
            $consulta = $db->query("SELECT max(codCompra) FROM Compra");
            $codCompra = $consulta->fetch_assoc()['max(codCompra)'];
            if($infoCompra != -1){
                $callString= 'CALL insertInfoCompra(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'.$codCompra.','.$codInsumo.',"'.$codSector.'",'.$infoCompra['costo'].',"'.$infoCompra['tipo'].'",'.$infoCompra['cantidad'].',"'.$infoCompra['fechaCompra'].'",'.$infoCompra['codProveedor'].')';
                $consulta=$db->query($callString);
                var_dump($db);
            }
            if($garantia != -1){
                $callString= 'CALL insertGarantia(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$garantia['tipo'].'","'.$garantia['fechaInicio'].'","'.$garantia['fechaLimite'].'")';
                $consulta = $db->query($callString);
            }
            if($instancias != -1){
                foreach ($instancias as $instancia) {
                    $callString= 'CALL insertInstancia(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",'. $codCompra . ',' . $codInsumo . ',"' . $codSector . '","'.$instancia['identificador'].'","'.$instancia['estado'].'",'.$instancia['ubicacion'].')';
                    $consulta = $db->query($callString);
                }
            }
            //Ingresar garantia

            //Ingresar instancias

        }
    }