<?php
    class Usuario{
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
        public function logOut(){
            $db = db::conectar();
            $callString = 'CALL logout(' . $_SESSION['cuenta']['ci'] . ', "' . $_SESSION['cuenta']['token'] . '")';
            echo $callString."<br>";
            var_dump($db);
            $consulta = $db->query($callString);
        }
        public function validarToken(){
            $db=db::conectar();
            $callString= 'CALL decriptar('.$_SESSION['cuenta']['ci'].', "'. $_SESSION['cuenta']['token'].'", @output)';
            $consulta=$db->query($callString);
            //var_dump($db);
            $consulta=$db->query('SELECT @output');
            $resultado=$consulta->fetch_assoc();
            return $resultado;
        }
        public function getCuentaPorCi($ci){
            $db= db::conectar();
            //Recibo la info general
            $callString= "SELECT ciEmpleado,nombre,apellido,telefono,email,contrasenia,ciAdministrador,ciCoordinador,ciPaniolero,ciDocente FROM empleados WHERE ciEmpleado=".$ci;
            $consulta= $db->query($callString);
            $resultado= $consulta->fetch_assoc();

            //Recibo todos los sectores a los que tiene acceso la cuenta
            $callString='SELECT codSector FROM sectorDeEmpleado WHERE ciEmpleado='.$ci;
            $consulta= $db->query($callString);
            $sectores=[];
            while ($filas=$consulta->fetch_assoc()) {
                $sectores[]=$filas;
            }

            //Compruebo los permisos de la cuenta
            $permisosAdmin=$resultado['ciAdministrador'] != null ? true : false; 
            $permisosCoord=$resultado['ciCoordinador'] != null ? true : false;
            $permisosPanio= $resultado['ciPaniolero'] != null ? true : false;
            $permisosDocente=$resultado['ciDocente'] != null ? true : false;
            
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
        public function getEmpleadosPorSector($codSector){
            $db = db::conectar();
            //Recibo la info general
            $callString = 'SELECT eps.*,ciAdministrador,ciCoordinador,ciPaniolero,ciDocente FROM empleadosPorSector eps JOIN empleados e ON e.ciEmpleado=eps.ciEmpleado WHERE eps.codSector="' . $codSector. '"';
            $consulta = $db->query($callString);
            $empleados = [];
            while ($filas = $consulta->fetch_assoc()) {
                $empleados[] = $filas;
            }
            for ($i=0; $i < count($empleados); $i++) {
                $callString = 'SELECT * FROM auditorias WHERE ciEmpleado=' . $empleados[$i]['ciEmpleado'] . ' AND tipo != "l" AND tipo != "o" ORDER BY cod DESC';
                $consulta = $db->query($callString);
                $acciones = [];
                while ($filas = $consulta->fetch_assoc()) {
                    $acciones[] = $filas;
                }
                $empleados[$i]['acciones']=$acciones;
            }
            return $empleados;
        }
        public function getEmpleados(){
            $db = db::conectar();
            //Recibo la info general
            $callString = 'SELECT * FROM empleados e';
            $consulta = $db->query($callString);
            $empleados = [];
            while ($filas = $consulta->fetch_assoc()) {
                $empleados[] = $filas;
            }
            for ($i = 0; $i < count($empleados); $i++) {
                $callString = 'SELECT * FROM auditorias WHERE ciEmpleado=' . $empleados[$i]['ciEmpleado'] . ' AND tipo != "l" AND tipo != "o" ORDER BY cod DESC';
                $consulta = $db->query($callString);
                $acciones = [];
                while ($filas = $consulta->fetch_assoc()) {
                    $acciones[] = $filas;
                }
                $empleados[$i]['acciones'] = $acciones;

                $empleados[$i]['sectores']=[];
                $callString= 'SELECT codSector FROM sectorDeEmpleado WHERE ciEmpleado='. $empleados[$i]['ciEmpleado'];
                $consulta = $db->query($callString);
                // var_dump($empleados);
                while ($filas = $consulta->fetch_assoc()) {
                    array_push($empleados[$i]['sectores'], $filas['codSector']);
                }
            }
            return $empleados;
        }
        public function updateCuenta($cuenta){
            $db=db::conectar();
            $callString= 'CALL updateEmpleado(' . $_SESSION['cuenta']['ci'] . ', "' . $_SESSION['cuenta']['token'] . '", "'.$cuenta['nombre']. '","' . $cuenta['apellido'] . '",' . $cuenta['telefono'] . ',"' . $cuenta['email'] . '")';
            $consulta=$db->query($callString);
        }
        public function cambiarContrasenia($contrasenia){
            $db = db::conectar();
            $callString = 'CALL updateContrasenia(' . $_SESSION['cuenta']['ci'] . ', "' . $contrasenia . '")';
            $consulta = $db->query($callString);
        }
        public function getAuditorias(){
            $db = db::conectar();
            $callString = 'SELECT ciEmpleado, tabla, fecha, tipo FROM auditorias WHERE ciEmpleado=' . $_SESSION['cuenta']['ci'] . ' AND tipo NOT LIKE "l" AND tipo NOT LIKE "o" ORDER BY cod DESC LIMIT 15';
            $consulta = $db->query($callString);
            $auditorias=[];
            while ($filas = $consulta->fetch_assoc()) {
                $auditorias [] = $filas;
            }
            return $auditorias;
        }
    }