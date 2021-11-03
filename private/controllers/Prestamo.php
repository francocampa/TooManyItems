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
            //var_dump($insumos);
            
            //  ANTES AGARRABA LAS INSTANCIAS AS[I, PERO CAMBI[E PARA QUE SE AGARREN MIENTRAS SE CARGAN LOS INSUMOS AS[I ES M[AS R[APIDO
            // for ($i=0; $i < count($_SESSION['sectores']); $i++) {
            //     for ($j=0; $j < ; $j++) { 

            //     }
            //     if(sizeof($insumos[$i])!=0){
            //         $insumos[$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$i]['codInsumo'], $insumos[$i]['codSector']);
            //     }
            // }

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