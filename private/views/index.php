<?php
echo APPROOT;
require_once APPROOT . '\views\includes/head.php';
?>

<ul>
    <li>
        <!-- <?php echo URLROOT; ?>/Cuenta/login -->
        <a href="<?php echo URLROOT; ?>/Login/login">Login</a>
    </li>
    <li>
        <a href="inventario.php">Inventario</a>
    </li>
</ul>

<?php
require_once APPROOT . '\views\includes/footer.php';
?>