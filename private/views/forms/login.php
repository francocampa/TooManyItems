<?php
$css=[
    'login' => true
];
require_once APPROOT . '\views\includes/head.php';
?>
<div class="seccionFormLogin">
    <h1 class="bienvenido">Bienvenido</h1>
    <form action=" <?php echo URLROOT; ?>/Login" method="post">
        <input type="text" class="input" name="ci" placeholder="Cédula">
        <input type="password" class="input" name="pass" placeholder="Contraseña">
        <input type="submit" value="Ingresar" class="btnIngresar" name="submit">
    </form>
    <p class="error"> <?php echo $data['error']; ?> </p>
</div>
<div class="logoLogin">
    <img src="<?php echo URLROOT; ?>/public/img/logos/Logotipo.svg" class="logoLogin">
</div>
<?php
//require_once APPROOT . '\views\includes/footer.php';
?>