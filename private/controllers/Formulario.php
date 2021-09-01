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
                $insumoModel=new Insumo();                  //requiero y creo el modelo de insumo
                
                //Encuentro qu[e marca fue seleccionada, le asigno el valor -1 ya que este es el default si no se selecciona una
                $codMarca = -1;
                for ($i=0; $i < count($marcas); $i++) { 
                    if($_POST['marca'] == $marcas[$i]['nombre']){
                        $codMarca= $marcas[$i]['codMarca'];         
                    }
                }

                $caracteristicas=[];    //Aqu[i se extraer[an las caracter[isticas t[ecnicas del POST a una matriz
                $i=0;
                //Utilizo estas variables para poder obtener las caracter[isticas t[ecnicas guardadas en el m[etodo post
                $nombreCaracteristicaT= 'caracteristicaNombre'.$i;
                $valorCaracteristicaT='caracteristicaValor'.$i;
                while (isset($_POST[$nombreCaracteristicaT])) { //Sigue agregando las caracter[isticas hasta que no se haya creado un input para otra caracter[istica
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
        public function compra($codInsumo){
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
            if(isset($_POST['submit'])){
                require_once APPROOT . '/Models/Instancia.php';
                $instanciaModel=new Instancia();
                if(isset($_POST['cboxInfoCompra'])){
                    $infoCompra = [
                        'costo' => $_POST['costo'],
                        'tipo' => $_POST['tipo'],
                        'codProveedor' => $_POST['proveedor'],
                        'cantidad' => $_POST['cantidad'],
                        'fechaCompra' => $_POST['fechaCompra']
                    ];
                }else{
                    $infoCompra=-1;
                }
                if(isset($_POST['cboxGarantia'])){
                    $garantia = [
                        'tipo' => $_POST['tipoGarantia'],
                        'fechaInicio' => $_POST['fechaInicioGarantia'],
                        'fechaLimite' => $_POST['fechaLimiteGarantia']
                    ];
                }else{
                    $garantia=-1;
                }
                if(isset($_POST['cboxInstancias'])){
                    $instancias = [];
                    $i = 0;
                    while (isset($_POST['identificador' . $i])) { //recorre las instancias ingresadas
                        $instancia = [    //crea la instancia
                            'identificador' => $_POST['identificador' . $i],
                            'estado' => $_POST['estado' . $i],
                            'ubicacion' => $_POST['ubicacion' . $i]
                        ];
                        array_push($instancias, $instancia);
                        $i++;
                    }
                }else{
                    $instancias=-1;
                }
                $instanciaModel->insertInstancias($codInsumo, 'IN',$instancias, $infoCompra, $garantia);
            }
            $this->view("forms/instancia", $data);
            
        }
    }