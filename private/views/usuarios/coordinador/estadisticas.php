<?php
$css = [
    'estructura' => true,
    'estadisticas' => true,
    'popup' => true,
    'form' => true
];
require_once APPROOT . '/views/includes/head.php';
?>
<div class="estructura">
    <?php require_once APPROOT . '/views/includes/navbar.php'; ?>
    <h1 class="titulo"><?php echo $data['titulo']; ?></h1>
    <div class="selectSector">
        <h2>Sector</h2>
        <select name="sector" id="selectorSectores">
            <!-- <option value="todos">Todos</option> -->
            <?php
            foreach ($_SESSION['sectores'] as $sector) {
                echo '<option value="' . URLROOT . '/estadisticas/es/' . $sector . '">' . $sector . '</option>';
            }
            ?>
            <script>
                $('#selectorSectores').val('<?= URLROOT ?>/estadisticas/es/<?= $data['sector'] ?>');
                $('#selectorSectores').on('change', function(e) {
                    window.location.href = $(this).val()
                })
            </script>
        </select>
    </div>


    <div class="contenido">
        <div class="seccion tarjetas">
            <div>
                <h2>Informacion del sector</h2>
                <div class="containerTarjetas">
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/marcas/<?= $data['sector'] ?>">
                        <p>Marcas</p>
                        <p class="numero"><?= $data['infoSector']['marcas'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/proveedores/<?= $data['sector'] ?>">
                        <p>Proveedores</p>
                        <p class="numero"><?= $data['infoSector']['proveedores'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/ubicaciones/<?= $data['sector'] ?>">
                        <p>Ubicaciones</p>
                        <p class="numero"><?= $data['infoSector']['ubicaciones'] ?></p>
                    </a>
                    <!-- <a class="tarjeta clara" href="">
                        <p>Grupos</p>
                        <p class="numero"></p>
                    </a> -->
                </div>
            </div>
            <div>
                <h2>Inventarios de insumos</h2>
                <div class="containerTarjetas">
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/materiales">
                        <p>Materiales</p>
                        <p class="numero"><?= $data['infoInventarios']['materiales'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/herramientas">
                        <p>Herramientas</p>
                        <p class="numero"><?= $data['infoInventarios']['herramientas'] ?></p>
                    </a>

                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/maquinaria">
                        <p>Maquinarias</p>
                        <p class="numero"><?= $data['infoInventarios']['maquinarias'] ?></p>
                    </a>
                    <a class="tarjeta clara" href="<?php echo URLROOT; ?>/Inventario/informatico">
                        <p>Equipamiento Informatico</p>
                        <p class="numero"><?= $data['infoInventarios']['informaticos'] ?></p>
                    </a>
                </div>
            </div>
            <div>
                <h2>Alertas</h2>
                <div class="containerTarjetas alertas">
                    <a class="tarjeta roja" href="<?php echo URLROOT; ?>/Inventario/stockBajo/<?= $data['sector'] ?>">
                        <p>Insumos con stock insuficiente</p>
                        <p class="numero"><?= $data['infoInventarios']['insumosBajoStock'] ?></p>
                    </a>
                    <a class="tarjeta roja" href="<?php echo URLROOT; ?>/Inventario/instanciasFalladas/<?= $data['sector'] ?>">
                        <p>Insumos con fallas</p>
                        <p class="numero"><?= $data['infoInventarios']['instanciasFalladas'] ?></p>
                    </a>
                    <a class="tarjeta roja" href="">
                        <p>Insumos no devueltos</p>
                        <p class="numero">TODO</p>
                    </a>
                </div>
            </div>
        </div>
        <h2 style="margin-left: 2rem;">Gráficas</h2>
        <div class="seccion graficas">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
            <div class="fallasPorMarcaGraph">
                <h2>Fallas por Marca</h2>
                <canvas id="fallasPorMarcaGraph" width="300px" height="300px"></canvas>
                <script>
                    {
                        let marcas = <?= json_encode($data['marcas']) ?>;
                        let nombresMarcas = [];
                        let fallasMarcas = [];
                        let colores = [];
                        let colorBase = 'rgba(255,134,';
                        let bActual = 55;
                        let bordes = [];
                        marcas.forEach(marca => {
                            nombresMarcas.push(marca.nombre);
                            fallasMarcas.push(marca.fallas);
                            colores.push(colorBase + bActual + ', 1)');
                            bActual += 20;
                            bordes.push("#545454");
                        });

                        console.log(nombresMarcas)
                        console.log(fallasMarcas)
                        let fallasPorMarca = document.getElementById('fallasPorMarcaGraph').getContext('2d');
                        let fallasPorMarcaChart = new Chart(fallasPorMarca, {
                            type: 'doughnut',
                            data: {
                                labels: nombresMarcas,
                                datasets: [{
                                    data: fallasMarcas,
                                    backgroundColor: colores,
                                    borderColor: bordes
                                }]
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'left'
                                    }
                                }
                            }
                        })
                    }
                </script>
            </div>
            <div class="fallasPorMarcaGraph">
                <h2>Fallas por Proveedor</h2>
                <canvas id="fallasPorMarcaGraph2" width="300px" height="300px"></canvas>
                <script>
                    {
                        let marcas = <?= json_encode($data['marcas']) ?>;
                        let nombresMarcas = [];
                        let fallasMarcas = [];
                        let colores = [];
                        let colorBase = 'rgba(255,134,';
                        let bActual = 55;
                        let bordes = [];
                        marcas.forEach(marca => {
                            nombresMarcas.push(marca.nombre);
                            fallasMarcas.push(marca.fallas);
                            colores.push(colorBase + bActual + ', 1)');
                            bActual += 20;
                            bordes.push("#545454");
                        });

                        console.log(nombresMarcas)
                        console.log(fallasMarcas)
                        let fallasPorMarca = document.getElementById('fallasPorMarcaGraph2').getContext('2d');
                        let fallasPorMarcaChart = new Chart(fallasPorMarca, {
                            type: 'bar',
                            data: {
                                labels: nombresMarcas,
                                datasets: [{
                                    data: fallasMarcas,
                                    backgroundColor: colores,
                                    borderColor: bordes
                                }]
                            },
                        })
                    }
                </script>
            </div>
            <div class="fallasPorMarcaGraph">
                <h2>Compras Mensuales</h2>
                <canvas id="fallasPorMarcaGraph3" width="300px" height="300px"></canvas>
                <script>
                    let marcas = <?= json_encode($data['marcas']) ?>;
                    let nombresMarcas = [];
                    let fallasMarcas = [];
                    let colores = [];
                    let colorBase = 'rgba(255,134,';
                    let bActual = 55;
                    let bordes = [];
                    marcas.forEach(marca => {
                        nombresMarcas.push(marca.nombre);
                        fallasMarcas.push(marca.fallas);
                        colores.push(colorBase + bActual + ', 1)');
                        bActual += 20;
                        bordes.push("#545454");
                    });

                    console.log(nombresMarcas)
                    console.log(fallasMarcas)
                    let fallasPorMarca = document.getElementById('fallasPorMarcaGraph3').getContext('2d');
                    let fallasPorMarcaChart = new Chart(fallasPorMarca, {
                        type: 'line',
                        data: {
                            labels: nombresMarcas,
                            datasets: [{
                                data: fallasMarcas,
                                backgroundColor: colores,
                                borderColor: bordes
                            }]
                        },
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?php
require_once APPROOT . '/views/includes/footer.php';
?>