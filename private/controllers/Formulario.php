<?php
    class Formulario extends Controller{
        public function insumo(){
            $data = [
                'titulo' => 'Agregar un nuevo insumo'
            ];
            $this->view("forms/insumo", $data);
        }
        public function compra(){
            $data = [
                'titulo' => 'Agregar una nueva compra'
            ];
            $this->view("forms/instancia", $data);
        }
    }