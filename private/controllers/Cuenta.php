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
            $currentPass=0;
            if (isset($_POST['currentPass'])) {
                $currentPass=$cuentaModel->validarPass($_POST['currentPass']);
                unset($_POST['currentPass']);       //Pa que no quede en el post la contra bien
            }

            $data = [
                'titulo' => 'Mi cuenta',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior,
                'auditorias' => $auditorias,
                'currentPass' => $currentPass
            ];
            $this->view("usuarios/cuenta", $data);
        }
        public function logOut(){
            logOut();
        }
    }