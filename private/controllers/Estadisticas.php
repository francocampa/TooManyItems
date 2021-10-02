<?php
    class Estadisticas extends Controller {
        public function __construct()
        {
            require_once APPROOT . '/Models/Marca.php';
            $marcaModel = new Marca();
            $cantidadMarcas = $marcaModel->countMarcasPorSector('IN');  

            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $cantidadProveedores = $proveedorModel->countProveedoresPorSector('IN');

            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $cantidadUbicaciones = $ubicacionModel->countUbicacionesPorSector('IN');

            $cantidadGrupos=0;
            $infoSector=[
                'marcas' => $cantidadMarcas,
                'proveedores' => $cantidadProveedores,
                'ubicaciones' => $cantidadUbicaciones,
                'grupos' => $cantidadGrupos,
            ];

            require_once APPROOT . '/Models/Insumo.php';
            $insumoModel = new Insumo();
            $cantidadHerramientas = $insumoModel->countInsumoPorCategoria('IN','herramienta');
            $cantidadMaquinarias = $insumoModel->countInsumoPorCategoria('IN', 'maquinaria');
            $cantidadInformaticos = $insumoModel->countInsumoPorCategoria('IN', 'informatico');
            $cantidadMateriales = $insumoModel->countInsumoPorCategoria('IN', 'material');
            $insumosStockBajo = $insumoModel->countInsumosStockBajoPorSector('IN');

            require_once APPROOT . '/Models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciasFalladas = $instanciaModel->countInstanciasConFallasPorSector('IN'); 

            $infoInventarios=[
                'herramientas' => $cantidadHerramientas,
                'maquinarias' => $cantidadMaquinarias,
                'informaticos' => $cantidadInformaticos,
                'materiales' => $cantidadMateriales,
                'instanciasFalladas' => $instanciasFalladas,
                'insumosBajoStock'=> $insumosStockBajo
            ];
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Estadísticas',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior,
                'infoSector' => $infoSector,
                'infoInventarios' => $infoInventarios
            ];
            $this->view("usuarios/coordinador/estadisticas", $data);
           
        }
    }