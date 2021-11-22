<?php
    class Formulario extends Controller{
        public function insumo($origen){
            if ($origen != 'herramientas' && $origen != 'materiales' && $origen != 'maquinaria' && $origen != 'informatico') {
                header('location:' . URLROOT . '/error/');
            }
            require_once APPROOT.'/models/Marca.php';
            $marcaModel= new Marca();
            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $marcas=[];
            foreach ($_SESSION['sectores'] as $sector) {
                $marcas[$sector] = $marcaModel->getMarcasPorSector($sector);
            }
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Agregar un nuevo insumo',
                'permisos' => $permisos,
                'marcas' => $marcas,
                'categoria' => $origen,
                'rutaAnterior' => $rutaAnterior
            ];

            if (isset($_POST['submit'])) {
                require_once APPROOT.'/models/Insumo.php';
                $insumoModel=new Insumo();                  //requiero y creo el modelo de insumo

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
                // var_dump($_POST);
                $imagen = $_FILES['imagenInsumo'];
                if($imagen['name'] == ''){
                    $rutaImagenDB=-1;
                }else{
                    $extension = explode('.', $imagen['name'])[1];
                    $nombreArchivo = uniqid('', true);
                    $rutaImagen = PUBLICROOT . '/public/img/insumosUploads/' . $nombreArchivo . '.' . $extension;
                    move_uploaded_file($imagen['tmp_name'], $rutaImagen);
                    $rutaImagenDB = $nombreArchivo . '.' . $extension;
                }
                $insumo=[
                    'codSector' => $_POST['sector'],
                    'categoria' => $_POST['categoria'],
                    'nombre' => $_POST['nombre'],
                    'tipo' => $_POST['tipo'],
                    'codMarca' => $_POST['marca'],
                    'modelo' => $_POST['modelo'],
                    'stockMinimo' =>$_POST['stockMinimo'],
                    'caraceristicasT' => $caracteristicas,
                    'rutaImagen' => $rutaImagenDB
                ];
                $insumoModel->insertInsumo($insumo);
                header('location:' . URLROOT . '/Inventario/'.$origen);
            }

            $this->view("forms/insumo", $data);
        }
        public function compra($codInsumo,$codSector){
            if (!in_array($codSector, $_SESSION['sectores'])) {
                header('location:' . URLROOT . '/error/');
            }
            require_once APPROOT . '/models/Insumo.php';
            $insumoModel = new Insumo();
            $insumo = $insumoModel->getInsumo($codInsumo, $codSector);
            $insumo_json = json_encode($insumo);
            if ($insumo_json == '{"foto":null,"marca":null,"caracteristicasT":[]}') {
                header('location:' . URLROOT . '/error/');
            }
            require_once APPROOT . '/models/Instancia/Proveedor.php';
            $proveedorModel=new Proveedor();
            $proveedores=$proveedorModel->getProveedoresPorSector($codSector);

            require_once APPROOT . '/models/Instancia/Ubicacion.php';
            $ubicacionModel=new Ubicacion();
            $ubicaciones= $ubicacionModel->getUbicacionesPorSector($codSector);

            $permisos = [
                'admin' => true,
                'coord' => true
            ];
            $rutaAnterior = '/' . rtrim($_GET['url'], '/');
            $data = [
                'titulo' => 'Agregar una nueva compra',
                'permisos' => $permisos,
                'proveedores' => $proveedores,
                'ubicaciones' => $ubicaciones,
                'rutaAnterior' => $rutaAnterior
            ];
            if(isset($_POST['submit'])){
                require_once APPROOT . '/models/Instancia.php';
                $instanciaModel=new Instancia();
                if(isset($_POST['cboxInfoCompra'])){
                    $infoCompra = [
                        'costo' => $_POST['costo'],
                        'tipo' => $_POST['tipo'],
                        'codProveedor' => $_POST['proveedor'],
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
                $instanciaModel->insertInstancias($codInsumo, $codSector,$instancias, $infoCompra, $garantia, $_POST['cantidad']);
                header('location:' . URLROOT . '/Inventario/instancias/' . $codInsumo . '/' . $codSector);
            }
            $this->view("forms/instancia", $data);
        }
    }