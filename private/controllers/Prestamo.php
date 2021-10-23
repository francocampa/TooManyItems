<?php
    class Prestamo extends Controller{
        public function __construct()
        {
            
        }
        public function paniol(){
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            $insumos=$insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'material');
            $herramientas= $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'herramienta');
            foreach ($herramientas as $herramienta) {
                array_push($insumos, $herramienta);
            }
            $maquinarias = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'maquinaria');
            foreach ($maquinarias as $maquinaria) {
                array_push($insumos, $maquinaria);
            }
            $informaticos = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'informatico');
            foreach ($informaticos as $informatico) {
                array_push($insumos, $informatico);
            }

            //var_dump($insumos);
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            for ($i=0; $i < count($insumos); $i++) {
                if(sizeof($insumos[$i])!=0){
                    $insumos[$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$i]['codInsumo'], $insumos[$i]['codSector']);
                }
            }

            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamos=$prestamoModel->getPrestamosPaniol('p');

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
            $insumos = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'material');
            $herramientas = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'herramienta');
            foreach ($herramientas as $herramienta) {
                array_push($insumos, $herramienta);
            }
            $maquinarias = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'maquinaria');
            foreach ($maquinarias as $maquinaria) {
                array_push($insumos, $maquinaria);
            }
            $informaticos = $insumoModel->getInsumoPorCategoria($_SESSION['sectores'][0], 'informatico');
            foreach ($informaticos as $informatico) {
                array_push($insumos, $informatico);
            }

            //var_dump($insumos);
            require_once APPROOT . '/models/Instancia.php';
            $instanciaModel = new Instancia();
            for ($i = 0; $i < count($insumos); $i++) {
                if (sizeof($insumos[$i]) != 0) {
                    $insumos[$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$i]['codInsumo'], $insumos[$i]['codSector']);
                }
            }

            require_once APPROOT . '/models/Prestamo.php';
            $prestamoModel = new PrestamoModel();
            $prestamos=$prestamoModel->getPrestamosPaniol('c');

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