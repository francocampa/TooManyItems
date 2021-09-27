<?php
    class Estadisticas extends Controller {
        public function __construct()
        {
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Estadísticas',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("usuarios/coordinador/estadisticas", $data);
           
        }
    }