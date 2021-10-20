<?php
    class Modificacion extends Controller{
        public function insumo($codInsumo){

            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();                  //requiero y creo el modelo de insumo

            //Todos estos malabares para agarrar las caracter[isticas t[ecnicas de manera din[amica
            $caracteristicas = [];
            $cantCaracteristicasT=$_POST['nCaracteristicasTecnicas'];   //La cantidad para recorrer las keys necesarias del POST
            $postKeys = array_keys($_POST); //Esto me permite trabajar con el m[etodo post como si fuera un array normal y no asociativo
            for ($i= count($postKeys)-1; $i >= count($postKeys)-$cantCaracteristicasT; $i--) { //Recorre solo las posiciones que son caracter[isticas t[ecnicas
                $key=$postKeys[$i];
                $caracteristica=[
                    'codCaracteristicaT' => explode('|',$key)[1],   //Obtengo la clave de la caracter[istica para luego modificar en la base de datos
                    'valor' => $_POST[$key]
                ];
                array_push($caracteristicas, $caracteristica);
            }
            $insumo = [
                'codInsumo' => $codInsumo,
                'codSector' => $_SESSION['sectorInstancia'],
                'categoria' => $_POST['categoria'],
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'codMarca' => $_POST['marca'],
                'modelo' => $_POST['modelo'],
                'stockMinimo' => $_POST['stockMinimo'],
                'stockActual' => $_POST['stockActual'],
                'caraceristicasT' => $caracteristicas,
            ];
            var_dump($insumo);
            $insumoModel->updateInsumo($insumo);
            header('location:' . URLROOT . '/Inventario/instancias/' . $codInsumo . '/' . $_SESSION['sectorInstancia']);

        }
        public function compra($codInsumo, $codSector, $codCompra){
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();

            var_dump($_POST);
            $compra=[
                'codCompra' => $codCompra,
                'codInsumo' => $codInsumo,
                'codSector' => $codSector
            ];
            $instancia=-1;
            if(isset($_POST['identificador'])){
                $instancia = [
                    'codInstancia' => $_POST['codInstancia'],
                    'identificador' => $_POST['identificador'],
                    'estado' => $_POST['estado'],
                    'ubicacion' => $_POST['ubicacion']
                ];
            }
            $infoCompra=-1;
            if (isset($_POST['tipoCompra'])) {
                $infoCompra = [
                    'codInfoCompra' => $_POST['codInfoCompra'],
                    'costo'=> $_POST['costo'],
                    'tipo' => $_POST['tipoCompra'],
                    'fechaCompra' => $_POST['fechaCompra'],
                    'proveedor' => $_POST['proveedor'],

                ];
            }
            $garantia=-1;
            if(isset($_POST['tipoGarantia'])){
                $garantia=[
                    'codGarantia' => $_POST['codGarantia'],
                    'tipo' => $_POST['tipoGarantia'],
                    'fechaInicio' => $_POST['fechaInicio'],
                    'fechaLimite' => $_POST['fechaLimite'],
                ];
            }
            
            $instanciaModel->updateCompra($compra,$instancia,$infoCompra,$garantia);
            var_dump($compra);
            header('location:' . URLROOT . '/Inventario/instancias/' . $codInsumo . '/' . $_SESSION['sectorInstancia']);
        }
    }