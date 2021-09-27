<?php
    class Popup{
        public function __construct(){
            
        }
        public function marca(){
            require_once APPROOT. '/Models/Marca.php';
            $marcaModel = new Marca();
            $marca=[
                'nombre' => $_POST['nombre']
            ];
            $marcaModel->insertMarca($marca, 'IN');
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function proveedor(){
            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $proveedor = [
                'nombre' => $_POST['nombre'],
                'telefono' => $_POST['telefono']
            ];
            $proveedorModel->insertProveedor($proveedor, 'IN');
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function ubicacion(){
            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $ubicacion = [
                'nombre' => $_POST['nombre'],
                'tipo' => $_POST['tipo']
            ];
            $ubicacionModel->insertUbicacion($ubicacion, 'IN');
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarInsumo($codInsumo, $codSector){
            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel= new Insumo();
            $insumoModel->deleteInsumo($codInsumo,$codSector);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarInstancia($codInstancia){
            require_once APPROOT . '/Models/Instancia.php';
            $instanciaModel= new Instancia();
            $instanciaModel->deleteInstancia($codInstancia);
            header('location:' . URLROOT . $_POST['origen']);
        }
        public function eliminarCompra($codCompra, $codInsumo, $codSector){
            require_once APPROOT . '/Models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciaModel->deleteCompra($codCompra, $codInsumo, $codSector);
            header('location:' . URLROOT . $_POST['origen']);
        }
    }