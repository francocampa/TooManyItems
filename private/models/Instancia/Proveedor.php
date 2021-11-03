<?php
    class Proveedor{
        public function __construct(){
            
        }
        public function insertProveedor($proveedor, $codSector){
            $db = db::conectar();
            $callString = 'CALL insertProveedor(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '","' . $proveedor['nombre'] . '",'.$proveedor['telefono'].',"' . $codSector . '")';
            $consulta = $db->query($callString);
        }
        public function deleteProveedor($codProveedor)
        {
            $db = db::conectar();
            $callString = 'CALL deleteProveedor(' . $_SESSION['cuenta']['ci'] . ',"' . $_SESSION['cuenta']['token'] . '",' . $codProveedor . ')';
            $consulta = $db->query($callString);
        }
        public function getProveedoresPorSector($codSector){
            $proveedores = [];
            $db = db::conectar();
            $callString = 'SELECT codProveedor, nombre, telefono FROM proveedoresPorSector WHERE codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $proveedores[] = $filas;
            }
            return $proveedores;
        }
        public function countProveedoresPorSector($codSector)
        {
            $proveedores = [];
            $db = db::conectar();
            $callString = 'SELECT count(codProveedor) FROM proveedoresPorSector WHERE codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            $proveedores=$consulta->fetch_assoc()['count(codProveedor)'];
            return $proveedores;
        }
        public function countFallasPorProveedor($codProveedor){
            $db = db::conectar();
            $callString = 'SELECT count(codProveedor) FROM fallasPorProveedor WHERE codProveedor=' . $codProveedor . '';
            $consulta = $db->query($callString);
            $proveedores = $consulta->fetch_assoc()['count(codProveedor)'];
            return $proveedores;
        }
    }