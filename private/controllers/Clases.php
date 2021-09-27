<?php
class Clases extends Controller
{
    public function __construct()
    {
        $permisos = [
            'admin' => true,
            'docente' => true
        ];
        $rutaAnterior = '/' . rtrim($_GET['url'], '/');
        $data = [
            'titulo' => 'Clases',
            'permisos' => $permisos,
            'rutaAnterior' => $rutaAnterior
        ];
        $this->view('usuarios/docente/clases', $data);
    }
}
