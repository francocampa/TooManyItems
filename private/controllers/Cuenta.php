<?php
    class Cuenta extends Controller{
        public function __construct()
        {
            $data = [
                'titulo' => 'Mi cuenta'
            ];
            $this->view("usuarios/cuenta", $data);
        }
    }