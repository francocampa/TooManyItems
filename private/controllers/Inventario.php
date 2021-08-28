<?php
    class Inventario extends Controller{
        public function __construct()
        {
            require_once '../private/models/Insumo.php';
        }
        public function materiales(){
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data=[
                'titulo' => 'Inventario de Materiales',
                'permisos' => $permisos
            ];
            $this->view("inventarios/insumos",$data);
        }
        public function herramientas(){
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Herramientas',
                'permisos' => $permisos
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function maquinaria(){
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Maquinarias',
                'permisos' => $permisos
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function informatico(){
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $data = [
                'titulo' => 'Inventario de Equipamiento Informatico',
                'permisos' => $permisos
            ];
            $this->view("inventarios/insumos", $data);
        }
    }