<?php
    class Prestamo extends Controller{
        public function __construct()
        {
            
        }
        public function paniol(){
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            foreach ($_SESSION['sectores'] as $sector) {
                $i=0;
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'material');
                foreach ($insumos[$sector] as $material) {
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $herramientas = $insumoModel->getInsumoPorCategoria($sector, 'herramienta');
                foreach ($herramientas as $herramienta) {
                    array_push($insumos[$sector], $herramienta);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $maquinarias = $insumoModel->getInsumoPorCategoria($sector, 'maquinaria');
                foreach ($maquinarias as $maquinaria) {
                    array_push($insumos[$sector], $maquinaria);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $informaticos = $insumoModel->getInsumoPorCategoria($sector, 'informatico');
                foreach ($informaticos as $informatico) {
                    array_push($insumos[$sector], $informatico);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
            }

            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamos=[];
            foreach ($_SESSION['sectores'] as $sector) {
                $prestamos[$sector]=$prestamoModel->getPrestamosPorSector('p', $sector);
            }

            $permisos=[
                'admin' => true,
                'panio'=>true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data=[
                'titulo' => 'Pañol',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior,
                'insumos' => $insumos,
                'prestamos' => $prestamos
            ];
            $this->view('usuarios/paniolero/prestamo',$data);
        }
        public function clases()
        {
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            foreach ($_SESSION['sectores'] as $sector) {
                $i = 0;
                $insumos[$sector] = $insumoModel->getInsumoPorCategoria($sector, 'material');
                foreach ($insumos[$sector] as $material) {
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $herramientas = $insumoModel->getInsumoPorCategoria($sector, 'herramienta');
                foreach ($herramientas as $herramienta) {
                    array_push($insumos[$sector], $herramienta);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $maquinarias = $insumoModel->getInsumoPorCategoria($sector, 'maquinaria');
                foreach ($maquinarias as $maquinaria) {
                    array_push($insumos[$sector], $maquinaria);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
                $informaticos = $insumoModel->getInsumoPorCategoria($sector, 'informatico');
                foreach ($informaticos as $informatico) {
                    array_push($insumos[$sector], $informatico);
                    $insumos[$sector][$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$sector][$i]['codInsumo'], $insumos[$sector][$i]['codSector']);
                    $i++;
                }
            }

            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamos = [];
            foreach ($_SESSION['sectores'] as $sector) {
                $prestamos[$sector] = $prestamoModel->getPrestamosPorSector('c', $sector);
            }

            $permisos = [
                'admin' => true,
                'docente' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Clases',
                'permisos' => $permisos,
                'rutaAnterior' => $rutaAnterior,
                'insumos' => $insumos,
                'prestamos' => $prestamos
            ];
            $this->view('usuarios/paniolero/prestamo',$data);
        }
    }