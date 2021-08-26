<?php
echo APPROOT;
require_once APPROOT . '\views\includes/head.php';
?>

<ul>
    <li>
        <!-- <?php echo URLROOT; ?>/Cuenta/login -->
        <a href="<?php echo URLROOT; ?>/Login">Login</a>
    </li>
    <li>
        <a href="<?php echo URLROOT; ?>/Inventario/materiales">Inventario</a>
    </li>
</ul>

<?php
require_once APPROOT . '\views\includes/footer.php';
?>