<?php
    class Cuenta{
        public function __construct(){
        }
        public function login($ci, $contrasenia){
            $db = db::conectar();
            $callString = "CALL login(" . $ci . ", \"" . $contrasenia . "\", @validacion)";
            $consulta = $db->query($callString);
            //var_dump($db);
            $consulta = $db->query("SELECT @validacion");
            $respuesta = $consulta->fetch_array()["@validacion"];
            return $respuesta;
        }

        public function getCuentaPorCi($ci){
            $db= db::conectar();
            $callString= "SELECT ci,nombre,apellido,telefono,email,contrasenia FROM empleado WHERE empleado.ci=".$ci;
            //echo $callString;
            $consulta= $db->query($callString);
            $resultado= $consulta->fetch_assoc();
            $usuario=[
                'ci'=>$ci,
                'nombre'=>$resultado['nombre'],
                'apellido' => $resultado['apellido'],
                'telefono' => $resultado['telefono'],
                'email' => $resultado['email'],
                'contrasenia' => $resultado['contrasenia']
            ];
            return $usuario;
        }
    }