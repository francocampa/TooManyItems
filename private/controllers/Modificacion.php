<?php
    class Modificacion extends Controller{
        public function insumo($codInsumo, $sector){
            if(!($_SESSION['permisos']['admin'] || $_SESSION['permisos']['coord'])){
                header('location:' . URLROOT . '/ErrorController/permisos');
            }
            if (!in_array($sector, $_SESSION['sectores'])) {
                header('location:' . URLROOT . '/error/');
            }
            // require_once APPROOT . '/models/Insumo.php';
            // $insumoModel = new Insumo();
            // $insumo = $insumoModel->getInsumo($codInsumo, $sector);
            // $insumo_json = json_encode($insumo);
            // if ($insumo_json == '{"foto":null,"marca":null,"caracteristicasT":[]}') {
            //     header('location:' . URLROOT . '/error/');
            // }
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
            var_dump($_FILES);
            $imagen = $_FILES['imagenInsumo'];
            if ($imagen['name'] == '') {
                $rutaImagenDB = -1;
            } else {
                $extension = explode('.', $imagen['name'])[1];
                $nombreArchivo = uniqid('', true);
                $rutaImagen = PUBLICROOT . '/public/img/insumosUploads/' . $nombreArchivo . '.' . $extension;
                move_uploaded_file($imagen['tmp_name'], $rutaImagen);
                $rutaImagenDB = $nombreArchivo . '.' . $extension;
            }
            $insumo = [
                'codInsumo' => $codInsumo,
                'codSector' => $sector,
                'categoria' => $_POST['categoria'],
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo'],
                'codMarca' => $_POST['marca'],
                'modelo' => $_POST['modelo'],
                'stockMinimo' => $_POST['stockMinimo'],
                'stockActual' => $_POST['stockActual'],
                'caraceristicasT' => $caracteristicas,
                'rutaImagen' => $rutaImagenDB
            ];
            var_dump($insumo);
            $insumoModel->updateInsumo($insumo);
            header('location:' . URLROOT . '/Inventario/instancias/' . $codInsumo . '/' . $sector);

        }
        public function compra($codInsumo, $codSector, $codCompra){
            if (!in_array($codSector, $_SESSION['sectores'])) {
                header('location:' . URLROOT . '/error/');
            }
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
            header('location:' . URLROOT . '/Inventario/instancias/' . $codInsumo . '/' . $codSector);
        }
        public function cuenta(){
            require_once APPROOT . '/models/Cuenta.php';
            $cuentaModel = new Usuario();
            $usuario=[
                'nombre'=>$_POST['nombre'],
                'apellido' => $_POST['apellido'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email']
            ];
            //Lo actualizo manualmente en la aplicaci[on para no tener que consultar la base de datos
            $_SESSION['cuenta']['nombre']= $_POST['nombre'];
            $_SESSION['cuenta']['apellido'] = $_POST['apellido'];
            $_SESSION['cuenta']['telefono'] = $_POST['telefono'];
            $_SESSION['cuenta']['email'] = $_POST['email'];

            $cuentaModel->updateCuenta($usuario);
            header('location:' . URLROOT . '/Cuenta/ver');
        }
    }