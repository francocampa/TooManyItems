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
            $data = [
                'titulo' => 'Mi cuenta',
                'permisos' => $permisos
            ];
            $this->view("usuarios/cuenta", $data);
        }
        public function logOut(){
            logOut();
        }
    }