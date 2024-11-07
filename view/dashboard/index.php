<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_pdvlg"])) {
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php require_once("../html/mainHead.php"); ?>
        <link rel="stylesheet" href="../../public/plugins/jquery-ui/jquery-ui.min.css">
        <title>Dashboard de Pedidos y Cobros</title>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <?php require_once("../html/menu.php"); ?>
            <?php require_once("../html/mainProfile.php"); ?>

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        <h3>Dashboard de Pedidos y Cobros</h3>

                        <!-- Tarjetas de resumen -->
                        <div class="row">
                            <!-- Cantidad de Pedidos -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id="cantidad_pedidos">cargando...</h3>
                                        <p>Pedidos Realizados</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Ingresos Totales -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3 id="ingresos_totales">cargando...</h3>
                                        <p>Ingresos Totales</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Plato Más Vendido -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 id="plato_mas_vendido">-</h3>
                                        <p>Plato Más Vendido</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-hamburger"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Ganancias Mensuales -->
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 id="ganancia_mensual">0</h3>
                                        <p>Ganancia Mensual</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gráficos -->
                        <div class="row">
                            <div class="col-lg-12 draggable">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Filtros de Tiempo</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Selector principal de filtros -->
                                            <div class="col-md-4">
                                                <label for="filtroTiempo">Tipo de Filtro</label>
                                                <select id="filtroTiempo" class="form-control">
                                                    <option value="mensual">Mensual</option>
                                                    <option value="anual">Anual</option>
                                                    <option value="personalizado">Personalizado</option>
                                                </select>
                                            </div>

                                            <!-- Selector de filtros dinámicos -->
                                            <div id="filtroDinamico" class="col-md-8 mt-3 mt-md-0"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer" style="text-align: end;">
                                        <button id="btnFiltrar" class="btn btn-primary">
                                            <i class="fas fa-search"></i> Filtrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Gráfico Ganancia por Plato -->
                            <div class="col-lg-6 draggable">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Ganancia por Plato</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="gananciaPorPlatoChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <!-- Gráfico de Ganancias Mensuales -->
                            <div class="col-lg-6 draggable">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Pedidos por Mes</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="pedidos_mesnuales"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Gráfico de Plato Más Vendido -->
                            <div class="col-lg-6 draggable">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Plato Más Vendido</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="maximize">
                                                <i class="fas fa-expand"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="platoMasVendidoChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <?php require_once("../html/footer.php"); ?>
        </div>

        <?php require_once("../html/mainjs.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="../../public/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="dashboard.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location: " . Conectar::ruta() . "index.php");
}
?>