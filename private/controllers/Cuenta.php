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
            require_once APPROOT . '/models/Cuenta.php';
            $cuentaModel = new Usuario();
            $auditorias = $cuentaModel->getAuditorias();
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Mi cuenta',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior,
                'auditorias' => $auditorias
            ];
            $this->view("usuarios/cuenta", $data);
        }
        public function logOut(){
            logOut();
        }
    }