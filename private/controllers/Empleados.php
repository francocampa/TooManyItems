<?php
class Empleados extends Controller
{
    public function em()
    {
        require_once APPROOT . '/models/Cuenta.php';
        $cuentaModel = new Usuario();
        $empleados= $cuentaModel->getEmpleados();
        for ($i=0; $i < count($empleados); $i++) { 
            $sectoresCompartidos=array_intersect($empleados[$i]['sectores'],$_SESSION['sectores']);
            if($sectoresCompartidos == []){
                array_splice($empleados, $i, $i);
                $i--;
            }
        }
        
        // foreach ($_SESSION['sectores'] as $sector) {
        //     $empleados[$sector]= $cuentaModel->getEmpleadosPorSector('IN');  
        // }

        $permisos = [
            'admin' => true
        ];
        $rutaAnterior = '/' . rtrim($_GET['url'], '/');
        $data = [
            'titulo' => 'Empleados',
            'permisos' => $permisos,
            'rutaAnterior' => $rutaAnterior,
            'empleados' => $empleados
        ];
        $this->view('usuarios/administrador/empleados', $data);
    }
}
