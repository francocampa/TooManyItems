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
                'origen' => 'materiales'

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
                'origen' => 'materiales'
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
                'origen' => 'materiales'
            ];
            $this->view("inventarios/insumos", $data);
        }
    }