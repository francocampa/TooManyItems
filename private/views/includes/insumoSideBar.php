<div class="containerNavbar">
    <form action="<?= URLROOT ?>/Modificacion/insumo/ <?= json_decode($data['insumo'])->codInsumo ?>" method="POST">
        <div class="insumoSidebar">
            <div class="superior">
                <a href="<?php echo URLROOT . "/Inventario/" . $data['origen'] ?>">
                    <img src="<?php echo URLROOT ?>/public/img/iconos/volver.svg" alt="" class="btnVolver">
                </a>
                <img class="imagen" src="<?php 
                    if(is_null(json_decode($data['insumo'])->foto)){
                        echo "";
                    }else{
                        echo URLROOT.'/public/img/insumosUploads/'.json_decode($data['insumo'])->foto->ruta;
                    }
                    
                    ?>">
            </div>
            <div>
                <h3>Información general</h3>
                <div class="containerInputs">
                    <div class="input">
                        <h4>Nombre</h4>
                        <input type="text" name="nombre" id="nombre">
                    </div>
                    <?php
                    $sumaInstancias = 0;
                    $compras = json_decode($data['compras_json']);
                    foreach ($compras as $compra) {
                        $sumaInstancias += count($compra->instancias);
                    }
                    ?>
                    <div class="input stockMinActual">
                        <h4>Stock</h4>
                        <input type="number" name="stockActual" id="stockActual" min=<?= $sumaInstancias ?>>
                        <input type="number" name="stockMinimo" id="stockMinimo" min="0">
                    </div>
                    <div class="input">
                        <h4>Categoría</h4>
                        <select name="categoria" id="categoria">
                            <option value="material">Material</option>
                            <option value="herramienta">Herramienta</option>
                            <option value="maquinaria">Maquinaria</option>
                            <option value="informatico">Informatico</option>
                        </select>
                    </div>
                    <div class="input">
                        <h4>Tipo</h4>
                        <select name="tipo" id="tipo"></select>
                    </div>
                    <div class="input">
                        <h4>Marca</h4>
                        <select name="marca" id="marcaCB">
                            <option value="-1">Sin marca</option>
                            <?php
                            foreach ($data['marcas'] as $marca) {
                                echo '<option value="' . $marca['codMarca'] . '">' . $marca['nombre'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input">
                        <h4>Modelo</h4>
                        <input type="text" name="modelo" id="modelo">
                    </div>

                </div>
            </div>
            <div>
                <h3>Características técnicas</h3>
                <div class="containerInputs cTecnicas">
                    <div class="input base">
                        <h4>Nombre</h4>
                        <input type="text">
                    </div>
                    <input type="text" style='display:none;' name="nCaracteristicasTecnicas" value="<?= count(json_decode($data['insumo'])->caracteristicasT) ?>">
                </div>
            </div>
            <button class="btnModificar">Modificar</button>

        </div>
    </form>
    <script src="<?php echo URLROOT ?> /public/js/navbar.js"></script>
</div>