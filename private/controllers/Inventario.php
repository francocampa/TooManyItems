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
            require_once APPROOT . '/Models/Marca.php';
            $marcaModel = new Marca();
            $marcas = $marcaModel->getMarcasPorSector('IN');
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
            $instancias= $instanciasModel->getInstanciasPorInsumo($codInsumo, 'IN');
            $instancias_json = json_encode($instancias);
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
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
                'insumo' => $insumo_json,
                'instancias_json' => $instancias_json,
                'marcas' => $marcas,
                'origen' => $origen
            ];
            $this->view('inventarios/instancias', $data);
        }
    }