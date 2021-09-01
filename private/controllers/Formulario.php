<?php
    class Formulario extends Controller{
        public function insumo($origen){
            require_once APPROOT.'/Models/Marca.php';
            $marcaModel= new Marca();
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $marcas= $marcaModel->getMarcasPorSector('IN');
            $data = [
                'titulo' => 'Agregar un nuevo insumo',
                'permisos' => $permisos,
                'marcas' => $marcas
            ];

            if (isset($_POST['submit'])) {
                require_once APPROOT.'/Models/Insumo.php';
                $insumoModel=new Insumo();
                $codMarca=-1;
                for ($i=0; $i < count($marcas); $i++) { 
                    if($_POST['marca'] == $marcas[$i]['nombre']){
                        $codMarca= $marcas[$i]['codMarca'];
                    }
                }

                $caracteristicas=[];    //Aqu[i se extraer[an las caracter[isticas t[ecnicas del POST a una matriz
                $i=0;
                $nombreCaracteristicaT= 'caracteristicaNombre'.$i;
                $valorCaracteristicaT='caracteristicaValor'.$i;
                while (isset($_POST[$nombreCaracteristicaT]) || $i==10) {
                    if($_POST[$nombreCaracteristicaT] != ''){
                        $caracteristicaT = [
                            'nombre' => $_POST[$nombreCaracteristicaT],
                            'valor' => $_POST[$valorCaracteristicaT]
                        ];
                        array_push($caracteristicas, $caracteristicaT);
                    }
                    $i++;
                    $nombreCaracteristicaT = 'caracteristicaNombre' . $i;
                    $valorCaracteristicaT = 'caracteristicaValor' . $i;
                }

                $insumo=[
                    'codSector' => 'IN',
                    'categoria' => $_POST['categoria'],
                    'nombre' => $_POST['nombre'],
                    'tipo' => $_POST['tipo'],
                    'codMarca' => $codMarca,
                    'modelo' => $_POST['modelo'],
                    'stockMinimo' =>$_POST['stockMinimo'],
                    'caraceristicasT' => $caracteristicas,
                ];
                $insumoModel->insertInsumo($insumo);
                //header('location:' . URLROOT . '/Inventario/'.$origen);
            }

            $this->view("forms/insumo", $data);
        }
        public function compra(){
            require_once APPROOT . '/Models/Instancia/Proveedor.php';
            $proveedorModel=new Proveedor();
            $proveedores=$proveedorModel->getProveedoresPorSector('IN');

            require_once APPROOT . '/Models/Instancia/Ubicacion.php';
            $ubicacionModel=new Ubicacion();
            $ubicaciones= $ubicacionModel->getUbicacionesPorSector('IN');
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $data = [
                'titulo' => 'Agregar una nueva compra',
                'permisos' => $permisos,
                'proveedores' => $proveedores,
                'ubicaciones' => $ubicaciones
            ];
            $this->view("forms/instancia", $data);
            
        }
    }