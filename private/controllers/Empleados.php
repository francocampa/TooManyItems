<?php
class Empleados extends Controller
{
    public function __construct()
    {
        $permisos = [
            'admin' => true
        ];
        $data = [
            'titulo' => 'Empleados',
            'permisos' => $permisos
        ];
        $this->view('usuarios/administrador/empleados', $data);
    }
}
