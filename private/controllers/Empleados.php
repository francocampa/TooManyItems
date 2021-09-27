<?php
class Empleados extends Controller
{
    public function __construct()
    {
        $permisos = [
            'admin' => true
        ];
        $rutaAnterior = '/' . rtrim($_GET['url'], '/');
        $data = [
            'titulo' => 'Empleados',
            'permisos' => $permisos,
            'rutaAnterior' => $rutaAnterior
        ];
        $this->view('usuarios/administrador/empleados', $data);
    }
}
