<?php
    class Inventario extends Controller{
        public function __construct()
        {
            require_once '../private/models/Insumo.php';
        }
        public function materiales(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            foreach ($_SESSION['sectores'] as $sector) {
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'material');
            }
            $insumos_json=json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data=[
                'titulo' => 'Inventario de Materiales',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'materiales',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos",$data);
        }
        public function herramientas(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos=[];
            foreach ($_SESSION['sectores'] as $sector) {
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'herramienta');
            }
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Inventario de Herramientas',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'herramientas',
                'rutaAnterior' => $rutaAnterior

            ];
            //var_dump($insumos);
            //echo $insumos_json;
            $this->view("inventarios/insumos", $data);
        }
        public function maquinaria(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            foreach ($_SESSION['sectores'] as $sector) {
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'maquinaria');
            }
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Inventario de Maquinarias',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'maquinaria',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function informatico(){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            foreach ($_SESSION['sectores'] as $sector) {
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'informatico');
            }
            $insumos_json = json_encode($insumos);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Inventario de Equipamiento Informatico',
                'permisos' => $permisos,
                'insumos_json' => $insumos_json,
                'origen' => 'informatico',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function instancias($codInsumo, $sector){
            //Cargo los proveedores, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedores = $proveedorModel->getProveedoresPorSector($sector);

            //Cargo las ubicaciones, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicaciones = $ubicacionModel->getUbicacionesPorSector($sector);

            //Cargo los estados, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/Models/Instancia/Estado.php';
            $estadoModel= new Estado();
            $estados= $estadoModel->getEstados();

            //Cargo las marcas, se necesitan para la modificaci[on de insumo
            require_once APPROOT . '/Models/Marca.php';
            $marcaModel = new Marca();
            $marcas = $marcaModel->getMarcasPorSector($sector);    

            //Requiero el modelo de insumo, se parsean a json los insumos, y se busca el insumo seleccionado del que se va a mostrar el inventario de instancias
            require_once APPROOT . '/models/Instancia.php';
            $instanciasModel = new Instancia();

            //Requiero el modelo de insumo, se parsean a json los insumos, y se busca el insumo seleccionado del que se va a mostrar el inventario de instancias
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            $insumo=$insumoModel->getInsumo($codInsumo, $sector);
            $insumo_json=json_encode($insumo);

            //Cargo las instancias del insumo y las parseo a json
            $compras= $instanciasModel->getComprasPorInsumo($codInsumo, $sector);
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
            $rutaAnterior ='/'.rtrim($_GET['url'], '/');
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
                'origen' => $origen,
                'rutaAnterior' => $rutaAnterior,
                'sectorInstancia' => $sector
            ];
           $this->view('inventarios/instancias', $data);
        }

        public function marcas(){
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            
            require_once APPROOT . '/Models/Marca.php';
            $marcaModel = new Marca();
            $marcas = $marcaModel->getMarcasPorSector('IN');   

            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => false,
                'docente' => false
            ];
            $data = [
                'titulo' => 'Inventario de Marcas',
                'permisos' => $permisos,
                'marcas' => $marcas,
                'marcas_json' => json_encode($marcas),
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view('inventarios/marcas', $data);
        }
        public function proveedores()
        {
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');

            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedores = $proveedorModel->getProveedoresPorSector('IN');

            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => false,
                'docente' => false
            ];
            $data = [
                'titulo' => 'Inventario de Proveedores',
                'permisos' => $permisos,
                'proveedores' => $proveedores,
                'proveedores_json' => json_encode($proveedores),
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view('inventarios/proveedores', $data);
        }
        public function ubicaciones()
        {
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');

            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicaciones = $ubicacionModel->getUbicacionesPorSector('IN');

            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => false,
                'docente' => false
            ];
            $data = [
                'titulo' => 'Inventario de Ubicaciones',
                'permisos' => $permisos,
                'ubicaciones' => $ubicaciones,
                'ubicaciones_json' => json_encode($ubicaciones),
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view('inventarios/ubicaciones', $data);
        }
    }