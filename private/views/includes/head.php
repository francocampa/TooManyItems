<!DOCTYPE html>
<html lang="en">
<?php
if (!isLoggedIn() && $data['titulo'] != "login") { //comprueba si estamos logeados o si nos estamos intentnado logear, nos reenvia al login si no hay una cuenta iniciada
    header('location: ' . URLROOT . '/Login');
} else if ($data['titulo'] != "login") {  //si estamos en un login no hay que comprobar permisos, comprueba si el usuario tiene permiso para entrar a la p[agina
    $pase = false;    // Este ser[a el encargado de definir si se tienen los permisos necesarios para acceder, con solo coincidir en uno de los permisos se tiene acceso
    if (isset($data['permisos']['admin']) && $_SESSION['permisos']['admin']) {
        $pase = true;
    }
    if (isset($data['permisos']['coord']) && $_SESSION['permisos']['coord']) {
        $pase = true;
    }
    if (isset($data['permisos']['panio']) && $_SESSION['permisos']['panio']) {
        $pase = true;
    }
    if (isset($data['permisos']['docente']) && $_SESSION['permisos']['docente']) {
        $pase = true;
    }
    if (!$pase) {
        header('location: ' . URLROOT . '/ErrorController/permisos');
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    if (isset($css['estructura'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/estructura.css\">";
    }
    if (isset($css['login'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/login.css\">";
    }
    if (isset($css['tablas'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/tablas.css\">";
    }
    if (isset($css['form'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/form.css\">";
    }
    if (isset($css['filtros'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/filtros.css\">";
    }
    if (isset($css['estadisticas'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/estadisticas.css\">";
    }
    if (isset($css['insumo'])) {
        echo "<link rel=\"stylesheet\" href=\"" . URLROOT . "/public/css/insumoSideBar.css\">";
    }
    // if($css['']){
    // }
    ?>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Exo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title><?php echo SITENAME; ?></title>
</head>

<body>
    <script src="<?php echo URLROOT ?>/public/js/jquery-3.6.0.min.js"></script>