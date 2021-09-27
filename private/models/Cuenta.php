<?php
    class Cuenta{
        public function __construct(){
        }
        public function login($ci, $contrasenia){
            $db = db::conectar();
            $callString = "CALL login(" . $ci . ", \"" . $contrasenia . "\", @validacion)";
            $consulta = $db->query($callString);
            $consulta = $db->query("SELECT @validacion");
            $respuesta = $consulta->fetch_array()["@validacion"];
            return $respuesta;
        }

        public function getCuentaPorCi($ci){
            $db= db::conectar();
            //Recibo la info general
            $callString= "SELECT ciEmpleado,nombre,apellido,telefono,email,contrasenia FROM empleados WHERE ciEmpleado=".$ci;
            $consulta= $db->query($callString);
            $resultado= $consulta->fetch_assoc();

            //Recibo todos los sectores a los que tiene acceso la cuenta
            $callString='SELECT codSector FROM sectorDeEmpleado WHERE ciEmpleado='.$ci;
            $consulta= $db->query($callString);
            $sectores=[];
            while ($filas=$consulta->fetch_assoc()) {
                $sectores[]=$filas;
            }

            //Recibo los permisos de la cuenta
            $callString='SELECT ciAdministrador FROM administradores WHERE ciAdministrador='.$ci;
            $consulta = $db->query($callString);
            $permisosAdmin=  $db->affected_rows>=1 ? true : false;

            $callString = 'SELECT ciCoordinador FROM coordinadores WHERE ciCoordinador=' . $ci;
            $consulta = $db->query($callString);
            $permisosCoord =  $db->affected_rows >= 1 ? true : false;

            $callString = 'SELECT ciPaniolero FROM panioleros WHERE ciPaniolero=' . $ci;
            $consulta = $db->query($callString);
            $permisosPanio =  $db->affected_rows >= 1 ? true : false;

            $callString = 'SELECT ciDocente FROM docentes WHERE ciDocente=' . $ci;
            $consulta = $db->query($callString);
            $permisosDocente =  $db->affected_rows >= 1 ? true : false;

            //Creo el array de permisos y el usuario que voy a retornar 
            $permisos = [
                'admin' => $permisosAdmin,
                'coord' => $permisosCoord,
                'panio' => $permisosPanio,
                'docente' => $permisosDocente
            ];
            $usuario=[
                'ci'=>$ci,
                'nombre'=>$resultado['nombre'],
                'apellido' => $resultado['apellido'],
                'telefono' => $resultado['telefono'],
                'email' => $resultado['email'],
                'contrasenia' => $resultado['contrasenia'],
                'sectores' => $sectores,
                'permisos' => $permisos
            ];
            return $usuario;
        }
    }