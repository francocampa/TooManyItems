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
                $usuario = new Cuenta($ci, $pass);
                
                if ($usuario->login()) {
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