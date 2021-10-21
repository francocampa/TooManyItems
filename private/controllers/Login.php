<?php
    class Login extends Controller {
        public function __construct(){
            //$rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' =>'login',
                'error' => ""//,
                //'rutaAnterior', $rutaAnterior
            ];
            require_once '../private/models/Cuenta.php';
            if (isset($_POST['submit'])) {
                // session_destroy();
                $ci = (int)$_POST['ci'];
                $pass = $_POST['pass'];
                $usuarioModel = new Usuario();
                $tokenLogin= $usuarioModel->login($ci, $pass);
                if ( $tokenLogin != 'false') {
                    $usuario=$usuarioModel->getCuentaPorCi($ci);
                    $usuario['token']=$tokenLogin;
                    //var_dump($usuario);
                    logIn($usuario);
                }else{
                    $data = [
                        'titulo' => 'login',
                        'error' => "Cuenta no encontrada"
                    ];
                }
            }  
            $this->view("forms/login", $data);
            var_dump($_SESSION); 
        }
    }   //TODO: tengo que mover las cosas de base de datos al model de cuenta