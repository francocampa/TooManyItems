<?php
    class Estadisticas extends Controller {
        public function __construct()
        {
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $data = [
                'titulo' => 'Estadísticas',
                'permisos' => $permisos
            ];
            $this->view("usuarios/coordinador/estadisticas", $data);
           
        }
    }