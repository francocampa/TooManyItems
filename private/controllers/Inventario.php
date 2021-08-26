<?php
    class Inventario extends Controller{
        public function __construct()
        {
            require_once '../private/models/Insumo.php';
        }
        public function materiales(){
            $data=[
                'titulo' => 'Inventario de Materiales'
            ];
            $this->view("inventarios/insumos",$data);
        }
        public function herramientas(){
            $data = [
                'titulo' => 'Inventario de Herramientas'
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function maquinaria(){
            $data = [
                'titulo' => 'Inventario de Maquinarias'
            ];
            $this->view("inventarios/insumos", $data);
        }
        public function informatico(){
            $data = [
                'titulo' => 'Inventario de Equipamiento Informatico'
            ];
            $this->view("inventarios/insumos", $data);
        }
    }