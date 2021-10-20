<?php
    class Estadisticas extends Controller {
        public function es($sector)
        {
            require_once APPROOT . '/models/Marca.php';
            $marcaModel = new Marca();
            $cantidadMarcas = $marcaModel->countMarcasPorSector($sector);  
            $marcas= $marcaModel->getMarcasPorSector($sector);
            for ($i=0; $i < count($marcas); $i++) {
                $marcas[$i]['fallas'] = $marcaModel->countFallasPorMarca($marcas[$i]['codMarca']);
            }

            require_once APPROOT . '/models/Instancia/Proveedor.php';
            $proveedorModel = new Proveedor();
            $cantidadProveedores = $proveedorModel->countProveedoresPorSector($sector);

            require_once APPROOT . '/models/Instancia/Ubicacion.php';
            $ubicacionModel = new Ubicacion();
            $cantidadUbicaciones = $ubicacionModel->countUbicacionesPorSector($sector);

            $cantidadGrupos=0;
            $infoSector=[
                'marcas' => $cantidadMarcas,
                'proveedores' => $cantidadProveedores,
                'ubicaciones' => $cantidadUbicaciones,
                'grupos' => $cantidadGrupos,
            ];

            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            $cantidadHerramientas = $insumoModel->countInsumoPorCategoria($sector,'herramienta');
            $cantidadMaquinarias = $insumoModel->countInsumoPorCategoria($sector, 'maquinaria');
            $cantidadInformaticos = $insumoModel->countInsumoPorCategoria($sector, 'informatico');
            $cantidadMateriales = $insumoModel->countInsumoPorCategoria($sector, 'material');
            $insumosStockBajo = $insumoModel->countInsumosStockBajoPorSector($sector);

            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            $instanciasFalladas = $instanciaModel->countInstanciasConFallasPorSector($sector); 

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
                'infoInventarios' => $infoInventarios,
                'sector' => $sector,
                'marcas' => $marcas
            ];
            $this->view("usuarios/coordinador/estadisticas", $data);
           
        }
    }