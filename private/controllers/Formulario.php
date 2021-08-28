<?php
    class Formulario extends Controller{
        public function insumo(){
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $data = [
                'titulo' => 'Agregar un nuevo insumo',
                'permisos' => $permisos
            ];
            $this->view("forms/insumo", $data);
        }
        public function compra(){
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $data = [
                'titulo' => 'Agregar una nueva compra',
                'permisos' => $permisos
            ];
            $this->view("forms/instancia", $data);
            
        }
    }