<?php
    class Estadisticas extends Controller {
        public function __construct()
        {
            $data = [
                'titulo' => 'Estadísticas'
            ];
            $this->view("usuarios/coordinador/estadisticas", $data);
        }
    }