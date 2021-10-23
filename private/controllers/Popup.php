<?php
    class Popup{
        public function __construct(){
            
        }
        public function marca(){
            require_once APPROOT. '/models/Marca.php';
            $marcaModel = new Marca();
            $marca=[
                'nombre' => $_POST['nombre']
            ];
            $marcaModel->insertMarca($marca, $_POST['sector']);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function proveedor(){
            require_once APPROOT . '/models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedor = [
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono']
            ];
            $proveedorModel->insertProveedor($proveedor, $_POST['sector']);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function ubicacion(){
            require_once APPROOT . '/models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicacion = [
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo']
            ];
            $ubicacionModel->insertUbicacion($ubicacion, $_POST['sector']);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarInsumo($codInsumo, $codSector){
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel= new Insumo();
            $insumoModel->deleteInsumo($codInsumo,$codSector);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarInstancia($codInstancia, $codSector, $codInsumo){
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel= new Instancia();
            $instanciaModel->deleteInstancia($codInstancia, $codSector, $codInsumo);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarCompra($codCompra, $codInsumo, $codSector){
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciaModel->deleteCompra($codCompra, $codInsumo, $codSector);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function agregarFalla($codInstancia){
            var_dump($_POST);
            $falla=[
                'nombre'=>$_POST['inputNombre'],
                'observaciones' => $_POST['inputObservaciones'],
                'diagnostico' => $_POST['inputDiagnostico']
            ];
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciaModel->insertFalla($codInstancia, $falla);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function solucionarFalla($codInstancia, $codFalla){
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciaModel->solucionarFalla($codInstancia, $codFalla);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function agregarPrestamo(){
            $i=1;
            $insumosSeleccionados=[];
            while (isset($_POST['insumo'.$i])) {
                $codInsumo=explode('.',$_POST['insumo' . $i])[0];
                $codSector = explode('.', $_POST['insumo' . $i])[1];
                $codInstancia = explode('.', $_POST['insumo' . $i])[2];
                $cantidad = explode('.', $_POST['insumo' . $i])[3];
                $consumir = explode('.', $_POST['insumo' . $i])[4];
                $insumo=[
                    'codInsumo' => $codInsumo,
                    'codSector' => $codSector,
                    'codInstancia' => $codInstancia,
                    'cantidad' => $cantidad,
                    'consumir' => $consumir
                ];
                array_push($insumosSeleccionados, $insumo);
                $i++;
            }
            $ci=isset($_POST['nombreAlumno']) ? $_POST['nombreAlumno'] : $_SESSION['cuenta']['ci'];
            $prestamo=[
                'clase' => $_POST['claseAlumno'],
                'ciPrestatario' => $ci,
                'fecha' => $_POST['fechaPrestamo'],
                'hora' => $_POST['horaPrestamo'],
                'razon' => $_POST['razonPrestamo'],
                'insumos' => $insumosSeleccionados,
                'tipo' => $_POST['tipo']
            ];
            var_dump($prestamo);
            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamoModel->insertPrestamo($prestamo);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function devolverPrestamo($codPrestamo){
            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamoModel->devolverPrestamo($codPrestamo);
            header('location:' . URLROOT . $_POST['origen']);
        }
    }