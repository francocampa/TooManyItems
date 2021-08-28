<?php
class Clases extends Controller
{
    public function __construct()
    {
        $permisos = [
            'admin' => true,
            'docente' => true
        ];
        $data = [
            'titulo' => 'Clases',
            'permisos' => $permisos
        ];
        $this->view('usuarios/docente/clases', $data);
    }
}
