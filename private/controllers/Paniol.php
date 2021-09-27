<?php
    class Paniol extends Controller{
        public function __construct(){
            $permisos=[
                'admin' => true,
                'panio'=>true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data=[
                'titulo' => 'Pañol',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view('usuarios/paniolero/paniol',$data);
        }
    }