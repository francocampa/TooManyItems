<?php
class Empleados extends Controller
{
    public function em()
    {
        require_once APPROOT . '/models/Cuenta.php';
        $cuentaModel = new Usuario();
        $empleados = $cuentaModel->getEmpleadosPorSector('IN');  

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
