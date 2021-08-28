<?php
    class Paniol extends Controller{
        public function __construct(){
            $permisos=[
                'admin' => true,
                'panio'=>true
            ];
            $data=[
                'titulo' => 'Pañol',
                'permisos' => $permisos
            ];
            $this->view('usuarios/paniolero/paniol',$data);
        }
    }