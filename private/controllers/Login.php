<?php
    class Login extends Controller {
        public function __construct(){
            $data = [
                'titulo' =>'login',
                'error' => ""
            ];
            require_once '../private/models/Cuenta.php';
            if (isset($_POST['submit'])) {
                $ci = (int)$_POST['ci'];
                $pass = $_POST['pass'];
                $usuarioModel = new Cuenta();
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
        }
    }   //TODO: tengo que mover las cosas de base de datos al model de cuenta