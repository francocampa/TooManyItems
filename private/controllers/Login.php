<?php
    class Login extends Controller {
        public function __construct(){
            require_once '../private/models/Cuenta.php';
            $data = [
                'error' => ""
            ];
            $this->view("login", $data);
        }
        public function submit(){
            if(isset($_POST['submit'])){
                $ci = (int)$_POST['ci'];
                $pass = $_POST['pass'];
                $db= db::conectar();
                $callString= "CALL loginProvisorio(".$ci.", \"".$pass."\", @validacion)";
                $consulta=$db->query($callString);
                $consulta = $db->query("SELECT @validacion");
                $respuesta=$consulta->fetch_array()["@validacion"];
                if($respuesta){
                    $usuario= new Cuenta($ci,$pass);
                    logIn($usuario);
                }else{
                    $data=[
                        'error' => "Cuenta no encontrada"
                    ];
                    $this->view("login", $data);
                }
                //$db->query("SELECT @validacion");

            }
        }
    }