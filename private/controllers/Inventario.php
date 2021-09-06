<?php
    class Inventario extends Controller{
        public function __construct()
        {
            require_once '../private/models/Insumo.php';
        }
        public function materiales(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos = $insumoModel->getInsumoPorCategoria('IN', 'material');
            $insumos_json=json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data=[
                'titulo' => 'Inventario de Materiales',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'materiales'
            ];
            $this->view("inventarios/insumos",$data);
        }
        public function herramientas(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos = $insumoModel->getInsumoPorCategoria('IN', 'herramienta');
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Herramientas',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'herramientas'

            ];
            $this->view("inventarios/insumos", $data);
        }
        public function maquinaria(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos = $insumoModel->getInsumoPorCategoria('IN', 'maquinaria');
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Maquinarias',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'maquinaria'
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function informatico(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos = $insumoModel->getInsumoPorCategoria('IN', 'informatico');
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Equipamiento Informatico',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'informatico'
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function instancias($codInsumo){
            //Cargo los proveedores, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedores = $proveedorModel->getProveedoresPorSector('IN');

            //Cargo las ubicaciones, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicaciones = $ubicacionModel->getUbicacionesPorSector('IN');

            //Cargo los estados, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Estado.php';
            $estadoModel= new Estado();
            $estados= $estadoModel->getEstados();

            //Cargo las marcas, se necesitan para la modificaci[on de insumo
            require_once APPROOT . '/Models/Marca.php';
            $marcaModel = new Marca();
            $marcas = $marcaModel->getMarcasPorSector('IN');    

            //Requiero el modelo de insumo, se parsean a json los insumos, y se busca el insumo seleccionado del que se va a mostrar el inventario de instancias
            require_once APPROOT . '/models/Instancia.php';
            $instanciasModel = new Instancia();
            $insumo=[];
            $insumos = json_decode($_SESSION['insumos'], true); 
            foreach ($insumos as $i) {
                if($i['codInsumo'] == $codInsumo){
                    $insumo=$i;
                    break;
                }
            }
            $insumo_json=json_encode($insumo);

            //Cargo las instancias del insumo y las parseo a json
            $compras= $instanciasModel->getComprasPorInsumo($codInsumo, 'IN');
            $compras_json = json_encode($compras);

            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            //Este origen permite volver al inventario anterior 
            $origen="";
            switch ($insumo['categoria']) {
                case 'material':
                    $origen="materiales";
                    break;
                case 'herramienta':
                    $origen="herramientas";
                    break;
                case 'maquinaria':
                    $origen="maquinaria";
                    break;
                case 'informatico':
                    $origen="informatico";
                    break;
                default:
                    # code...
                    break;
            }
            $data = [
                'titulo' => 'Inventario de ',
                'permisos' => $permisos,
                'codInsumo' => $codInsumo,
                'insumo' => $insumo_json,
                'compras_json' => $compras_json,
                'marcas' => $marcas,
                'estados' => $estados,
                'ubicaciones' => $ubicaciones,
                'proveedores' => $proveedores,
                'origen' => $origen
            ];
           $this->view('inventarios/instancias', $data);
        }
    }