<?php
    class Paniol extends Controller{
        public function __construct()
        {
            
        }
        public function paniol(){
            require_once APPROOT . '/Models/Insumo.php';
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
            require_once APPROOT . '/Models/Instancia.php';
            $instanciaModel = new Instancia();
            for ($i=0; $i < count($insumos); $i++) {
                if(sizeof($insumos[$i])!=0){
                    $insumos[$i]['instancias'] = $instanciaModel->getInstanciasPorInsumo($insumos[$i]['codInsumo'], $insumos[$i]['codSector']);
                }
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
                'insumos' => $insumos
            ];
            $this->view('usuarios/paniolero/paniol',$data);
        }
    }