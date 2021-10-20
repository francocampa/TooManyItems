<?php
    class Inventario extends Controller{
        public function __construct()
        {
            require_once '../private/models/Insumo.php';
        }
        public function materiales(){
            require_once APPROOT . '/models/Insumo.php';
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
                'tipo' => 'insumo',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos",$data);
        }
        public function herramientas(){
            require_once APPROOT . '/models/Insumo.php';
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
                'tipo' => 'insumo',
                'rutaAnterior' => $rutaAnterior

            ];
            //var_dump($insumos);
            //echo $insumos_json;
            $this->view("inventarios/insumos", $data);
        }
        public function maquinaria(){
            require_once APPROOT . '/models/Insumo.php';
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
                'tipo' => 'insumo',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function informatico(){
            require_once APPROOT . '/models/Insumo.php';
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
                'tipo' => 'insumo',
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function instancias($codInsumo, $sector){
            //Cargo los proveedores, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedores = $proveedorModel->getProveedoresPorSector($sector);

            //Cargo las ubicaciones, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicaciones = $ubicacionModel->getUbicacionesPorSector($sector);

            //Cargo los estados, se necesitan para la modificaci[on de las instancias
            require_once APPROOT . '/models/Instancia/Estado.php';
            $estadoModel= new Estado();
            $estados= $estadoModel->getEstados();

            //Cargo las marcas, se necesitan para la modificaci[on de insumo
            require_once APPROOT . '/models/Marca.php';
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

        public function marcas($sector){
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');

            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();

            require_once APPROOT . '/models/Marca.php';
            $marcaModel = new Marca();
            $marcas = $marcaModel->getMarcasPorSector($sector);
            for ($i = 0; $i < count($marcas); $i++) {
                $marcas[$i]['fallas'] = $marcaModel->countFallasPorMarca($marcas[$i]['codMarca']);
                $marcas[$i]['insumos'] = $insumoModel->getInsumoPorMarca($sector, $marcas[$i]['codMarca']);
                for ($j=0; $j < count($marcas[$i]['insumos']); $j++) {
                   $marcas[$i]['insumos'][$j]['fallas']=$insumoModel->getFallasPorInsumo($marcas[$i]['insumos'][$j]['codInsumo'],$sector);
                }
            }

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
                'rutaAnterior' => $rutaAnterior,
                'sector' => $sector
            ];
            $this->view('inventarios/marcas', $data);
        }
        public function proveedores($sector)
        {
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');

            require_once APPROOT . '/models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedores = $proveedorModel->getProveedoresPorSector($sector);

            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            for ($i = 0; $i < count($proveedores); $i++) {
                $proveedores[$i]['fallas'] = $proveedorModel->countFallasPorProveedor($proveedores[$i]['codProveedor']);
                $proveedores[$i]['instancias'] = $instanciaModel->getInstanciasPorProveedor($sector, $proveedores[$i]['codProveedor']);
                for ($j = 0; $j < count($proveedores[$i]['instancias']); $j++) {
                    $proveedores[$i]['instancias'][$j]['fallas'] = $instanciaModel->getFallasPorInstancia($proveedores[$i]['instancias'][$j]['codInstancia']);
                }
            }
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
                'rutaAnterior' =>$rutaAnterior,
                'sector' => $sector
            ];
            $this->view('inventarios/proveedores', $data);
        }
        public function ubicaciones($sector)
        {
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');

            require_once APPROOT . '/models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicaciones = $ubicacionModel->getUbicacionesPorSector($sector);

            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            for ($i = 0; $i < count($ubicaciones); $i++) {
                //$ubicaciones[$i]['fallas'] = $ubicacionModel->countFallasPorUbicacion($ubicaciones[$i]['codUbicacion']);
                $ubicaciones[$i]['instancias'] = $instanciaModel->getInstanciasPorUbicacion($ubicaciones[$i]['codUbicacion'], $sector);
                for ($j = 0; $j < count($ubicaciones[$i]['instancias']); $j++) {
                    $ubicaciones[$i]['instancias'][$j]['fallas'] = $instanciaModel->getFallasPorInstancia($ubicaciones[$i]['instancias'][$j]['codInstancia']);
                }
            }

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
                'rutaAnterior' =>$rutaAnterior,
                'sector' => $sector
            ];
            $this->view('inventarios/ubicaciones', $data);
        }
        public function stockBajo($codSector){
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos = $insumoModel->getInsumoStockBajo($codSector);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Insumos con stock insuficiente',
                'permisos' => $permisos,
                'insumos' => $insumos,
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/insumosStockBajo", $data);
        }
        public function instanciasFalladas($codSector){
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            $instancias = $instanciaModel->getInstanciasConFalla($codSector);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Fallas activas',
                'permisos' => $permisos,
                'instancias' => $instancias,
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("inventarios/instanciasFalladas", $data);
        }
    }
   