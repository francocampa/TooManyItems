<form action="">
    <div class="insumoSidebar">
        <div class="superior">
            <a href="<?php echo URLROOT . "/Inventario/" . $data['origen'] ?>">
                <img src="<?php echo URLROOT ?>/public/img/iconos/volver.svg" alt="" class="btnVolver">
            </a>
            <div class="imagen"></div>
        </div>
        <div>
            <h3>Información general</h3>
            <div class="containerInputs">
                <div class="input">
                    <h4>Nombre</h4>
                    <input type="text" name="nombre" id="nombre">
                </div>
                <div class="input">
                    <h4>Stock</h4>
                    <input type="text" name="stockMinimo" id="stockMinimo">
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
                    <select name="marca" id="marca">
                        <option value="-1">Sin marca</option>
                        <?php
                            foreach ($data['marcas'] as $marca) {
                                echo '<option value="' . $marca['nombre'] . '">' . $marca['nombre'] . '</option>';
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

            </div>
        </div>
    </div>
</form>