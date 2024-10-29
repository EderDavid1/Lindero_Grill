<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usua_id_sidc"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/mainHead.php"); ?>


    <title>MPCH::Pasarela Pagos</title>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

      <?php require_once("../html/mainProfile.php"); ?>
      <?php require_once("../html/menu.php"); ?>

      <div class="content-wrapper">
        <section class="content-header">
          <div class="container-fluid">
            <div class="mb-2">
              <div class="col-sm-6">
                <h1>Precios y requisitos-Certificados ITSE</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <style>
          .col-md-4 {
            display: flex;
            align-items: flex-end;
          }
        </style>
        <style>
          /* Estilo para los íconos en lugar de los puntos */
          .custom-list {
            list-style-type: none;
            /* Elimina los puntos */
            padding-left: 0;
            /* Elimina el espacio adicional en la izquierda */
          }

          .custom-list li {
            position: relative;
            /* Necesario para posicionar el ícono */
            padding-left: 1em;
            /* Espacio para el ícono */
            margin-bottom: 0.5em;
            /* Espacio entre los elementos */
          }

          .custom-list li::before {
            content: '';
            /* Ícono o símbolo que reemplaza el punto */
            position: absolute;
            left: 0;
            /* Posiciona el ícono a la izquierda del texto */
            top: 0;
            /* Alinea el ícono verticalmente */
            font-size: 1.2em;
            /* Tamaño del ícono */
          }
        </style>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">

              <!-- ITSE Riesgo Medio -->
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-info">
                    <h3 class="card-title">
                      <i class="fas fa-shield-alt"></i> ITSE Riesgo Medio
                    </h3>
                  </div>
                  <div class="card-body">
                    <h5><strong>Pago Derecho de Trámite: S/. 211.70</strong></h5>
                    <ul class="custom-list">
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium1">
                          <label for="checkboxMedium1"></label>
                        </div>Solicitud ITSE Anexo 1
                      </li>
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium2">
                          <label for="checkboxMedium2"></label>
                        </div>Reporte de Nivel de Riesgo (Anexo 2 y 3)
                      </li>
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium3">
                          <label for="checkboxMedium3"></label>
                        </div>Declaración Jurada de Condiciones de Seguridad (Anexo 4)
                      </li>
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium4">
                          <label for="checkboxMedium4"></label>
                        </div>Certificado vigente de medición y resistencia del sistema de puesta a tierra
                      </li>
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium5">
                          <label for="checkboxMedium5"></label>
                        </div>Plan de Seguridad con planos de evacuación y señalización
                      </li>
                      <li>
                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="checkboxMedium6">
                          <label for="checkboxMedium6"></label>
                        </div>Memoria o protocolos de operatividad de equipos de seguridad
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer text-center">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#generateOrderModal"
                      style="width: 100%;">
                      <i class="fas fa-money-bill-wave"></i> Generar Orden de Giro
                    </button>
                  </div>
                </div>
              </div>

              <!-- ITSE Riesgo Alto -->
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-warning">
                    <h3 class="card-title">
                      <i class="fas fa-exclamation-triangle"></i> ITSE Riesgo Alto
                    </h3>
                  </div>
                  <div class="card-body">
                    <h5><strong>Pago Derecho de Trámite: S/. 557.50</strong></h5>
                    <ul class="custom-list">
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh1">
                          <label for="checkboxHigh1"></label>
                        </div>Solicitud ITSE Anexo 1
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh2">
                          <label for="checkboxHigh2"></label>
                        </div>Croquis de Ubicación
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh3">
                          <label for="checkboxHigh3"></label>
                        </div>Plano de arquitectura de la distribución existente y cálculo de aforo
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh4">
                          <label for="checkboxHigh4"></label>
                        </div>Plano de tableros eléctricos, diagramas unifilares y cuadro de carga
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh5">
                          <label for="checkboxHigh5"></label>
                        </div>Certificado vigente de medición y resistencia del sistema de puesta a tierra
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh6">
                          <label for="checkboxHigh6"></label>
                        </div>Plan de Seguridad con planos de evacuación y señalización
                      </li>
                      <li>
                        <div class="icheck-warning d-inline">
                          <input type="checkbox" id="checkboxHigh7">
                          <label for="checkboxHigh7"></label>
                        </div>Memoria o protocolos de operatividad de equipos de seguridad
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer text-center">
                    <button class="btn btn-warning" style="width: 100%;">
                      <i class="fas fa-money-bill-wave"></i> Generar Orden de Giro
                    </button>
                  </div>
                </div>
              </div>

              <!-- ITSE Riesgo Muy Alto -->
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header bg-danger">
                    <h3 class="card-title">
                      <i class="fas fa-fire-extinguisher"></i> ITSE Riesgo Muy Alto
                    </h3>
                  </div>
                  <div class="card-body">
                    <h5><strong>Pago Derecho de Trámite: S/. 1106.00</strong></h5>
                    <ul class="custom-list">
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh1">
                          <label for="checkboxVeryHigh1"></label>
                        </div>Solicitud ITSE Anexo 1
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh2">
                          <label for="checkboxVeryHigh2"></label>
                        </div>Reporte de Nivel de Riesgo (Anexo 2 y 3)
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh3">
                          <label for="checkboxVeryHigh3"></label>
                        </div>Croquis de Ubicación
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh4">
                          <label for="checkboxVeryHigh4"></label>
                        </div>Plano de arquitectura de la distribución existente y cálculo de aforo
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh5">
                          <label for="checkboxVeryHigh5"></label>
                        </div>Plano de tableros eléctricos, diagramas unifilares y cuadro de carga
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh6">
                          <label for="checkboxVeryHigh6"></label>
                        </div>Certificado vigente de medición y resistencia del sistema de puesta a tierra
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh7">
                          <label for="checkboxVeryHigh7"></label>
                        </div>Plan de Seguridad con planos de evacuación y señalización
                      </li>
                      <li>
                        <div class="icheck-danger d-inline">
                          <input type="checkbox" id="checkboxVeryHigh8">
                          <label for="checkboxVeryHigh8"></label>
                        </div>Memoria o protocolos de operatividad de equipos de seguridad
                      </li>
                    </ul>
                  </div>
                  <div class="card-footer text-center">
                    <button class="btn btn-danger" style="width: 100%;">
                      <i class="fas fa-dollar-sign"></i> Generar Orden de Giro
                    </button>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>
        <!-- /.content -->
      </div>

      <?php require_once("../html/footer.php"); ?>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
    </div>

    <?php require_once("../html/mainjs.php"); ?>
    <script type="text/javascript" src="pasarela_controller.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const colMd4Containers = document.querySelectorAll('.col-md-4');

        colMd4Containers.forEach(colMd4 => {
          const checkboxes = colMd4.querySelectorAll('input[type="checkbox"]');

          checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
              if (this.checked) {
                highlightCard(colMd4);
                disableOtherCheckboxes(colMd4);
              } else if (!isAnyChecked(colMd4)) {
                resetCardStyle(colMd4);
                enableAllCheckboxes();
              }
            });
          });
        });

        function highlightCard(activeCol) {
          colMd4Containers.forEach(colMd4 => {
            const card = colMd4.querySelector('.card');
            const cardBody = colMd4.querySelector('.card-body');
            const cardFooter = colMd4.querySelector('.card-footer');

            if (colMd4 === activeCol) {
              
              card.style.transform = 'scale(1.02)';
              card.style.transition = 'transform 0.3s ease';
            } else {
              cardBody.style.backgroundColor = '#ececec';
              cardFooter.style.backgroundColor = '#ececec';

             
              card.style.transform = 'scale(1)';
            }
          });
        }

        function resetCardStyle(colMd4) {
          const card = colMd4.querySelector('.card');
          const cardBody = colMd4.querySelector('.card-body');
          const cardFooter = colMd4.querySelector('.card-footer');
          cardBody.style.backgroundColor = '';
          cardFooter.style.backgroundColor = '';
          card.style.transform = 'scale(1)';
        }

        function disableOtherCheckboxes(activeCol) {
          colMd4Containers.forEach(colMd4 => {
            if (colMd4 !== activeCol) {
              const checkboxes = colMd4.querySelectorAll('input[type="checkbox"]');
              checkboxes.forEach(checkbox => {
                checkbox.disabled = true;
              });
            }
          });
        }

        function enableAllCheckboxes() {
          colMd4Containers.forEach(colMd4 => {
            const checkboxes = colMd4.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
              checkbox.disabled = false;
            });
            resetCardStyle(colMd4);
          });
        }

        function isAnyChecked(colMd4) {
          const checkboxes = colMd4.querySelectorAll('input[type="checkbox"]');
          return Array.from(checkboxes).some(checkbox => checkbox.checked);
        }
      });

    </script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".col-md-4");

        // Convertir NodeList a un array para poder ordenarlo
        const cardsArray = Array.from(cards);

        // Encontrar la tarjeta más alta
        let tallestCard = cardsArray[0];
        let tallestHeight = tallestCard.querySelector(".card-body").offsetHeight;

        cardsArray.forEach(card => {
          const cardHeight = card.querySelector(".card-body").offsetHeight;
          if (cardHeight > tallestHeight) {
            tallestCard = card;
            tallestHeight = cardHeight;
          }
        });

        // Ordenar las tarjetas: poner la más alta en el medio
        const parent = document.querySelector(".row");
        parent.innerHTML = ""; // Limpiar el contenedor

        const middleIndex = Math.floor(cardsArray.length / 2);
        cardsArray.splice(cardsArray.indexOf(tallestCard), 1); // Eliminar la tarjeta más alta del array

        const leftSide = cardsArray.slice(0, middleIndex);
        const rightSide = cardsArray.slice(middleIndex);

        // Reinsertar las tarjetas en el orden deseado
        leftSide.forEach(card => parent.appendChild(card));
        parent.appendChild(tallestCard);
        rightSide.forEach(card => parent.appendChild(card));
      });


    </script>
  </body>

  </html>
  <?php
} else {
  /* Si no ha iniciado sesión se redirecciona a la ventana principal */
  header("Location:" . Conectar::ruta() . "view/404/");
}
?>