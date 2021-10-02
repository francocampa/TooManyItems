<?php
    class Cuenta extends Controller{
        public function ver()
        {
            $permisos = [
                'admin' => true,
                'coord' => true,
                'panio' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Mi cuenta',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior
            ];
            $this->view("usuarios/cuenta", $data);
        }
        public function logOut(){
            logOut();
        }
    }