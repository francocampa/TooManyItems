<?php
    class Proveedor extends Controller {
        public function __construct(){
            
        }
        public function getProveedoresPorSector($codSector){
            $proveedores = [];
            $db = db::conectar();
            $callString = 'SELECT p.codProveedor, nombre, telefono FROM proveedorSector ps RIGHT JOIN proveedor p on ps.codProveedor=p.codProveedor WHERE ps.codSector="' . $codSector . '"';
            $consulta = $db->query($callString);
            while ($filas = $consulta->fetch_assoc()) {
                $proveedores[] = $filas;
            }
            return $proveedores;
        }
    }