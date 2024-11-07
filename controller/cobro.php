<?php
require_once("../config/conexion.php");
require_once("../models/Cobro.php");
require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$cobro = new Cobro();

switch ($_GET["op"]) {
    case "listar_cobros":
        $fechaInicio = $_POST["fechaInicio"] ?? null;
        $fechaFin = $_POST["fechaFin"] ?? null;
        $mesa = $_POST["mesa"] ?? null;
        $tipo_comprobante = $_POST["tipoComprobante"] ?? null;
        $data = $cobro->listar_cobros($fechaInicio, $fechaFin, $mesa, $tipo_comprobante);
        echo json_encode($data);
        break;

    case "resumen_dia":
        $data = $cobro->resumen_cobros_dia();
        echo json_encode($data);
        break;
    case "generar_comprobante":
        if (isset($_GET['cobro_id'])) {
            $cobro_id = (int)$_GET['cobro_id']; // Asegúrate de que sea un entero
            // Obtener los datos del cobro
            $detalleCobro = $cobro->obtener_detalle_cobro($cobro_id);


            // Determinar si es boleta o factura
            $tipoComprobante = $detalleCobro['tipo_comprobante']; // 1 para Boleta, 2 para Factura
            $esBoleta = $tipoComprobante == 1;
            $prefijoComprobante = $esBoleta ? 'B' : 'F';

            // Leer el contenido del archivo HTML
            $html = file_get_contents('comprobante.html');

            // Reemplazos dinámicos según el tipo de comprobante
            $html = str_replace('{{tipo_comprobante}}', $esBoleta ? 'BOLETA' : 'FACTURA', $html);
            $html = str_replace('{{tipo_comprobante_prefijo}}', $prefijoComprobante, $html);
            $html = str_replace('{{cobro_id}}', str_pad($detalleCobro['cob_id'], 6, '0', STR_PAD_LEFT), $html);
            $html = str_replace('{{fecha}}', date('d/m/Y', strtotime($detalleCobro['fechacrea'])), $html);

            // Cambiar textos de acuerdo al tipo de comprobante
            $html = str_replace('{{dni_ruc_label}}', $esBoleta ? 'DNI' : 'RUC', $html);
            $html = str_replace('{{nombre_razon_label}}', $esBoleta ? 'Nombre' : 'Razón Social', $html);

            // Datos del cliente
            $html = str_replace('{{dni_ruc}}', $esBoleta ? $detalleCobro['cob_dni'] : $detalleCobro['cob_ruc'], $html);
            $html = str_replace('{{razon_social}}', $esBoleta ? $detalleCobro['cob_nombre'] : $detalleCobro['cob_razon_social'], $html);

            // Procesar los productos desde el JSON de cob_conceptos
            $productos = json_decode($detalleCobro['cob_conceptos'], true);
            $detalleProductosHTML = '';

            // Generar HTML de los productos
            foreach ($productos as $producto) {
                $detalleProductosHTML .= "<tr>";
                $detalleProductosHTML .= "<td style='text-align:left;'>{$producto['nombre']}</td>";
                $detalleProductosHTML .= "<td>S/ {$producto['precio_unitario']}</td>";
                $detalleProductosHTML .= "<td>{$producto['cantidad']}</td>";
                $detalleProductosHTML .= "<td>S/ {$producto['total']}</td>";
                $detalleProductosHTML .= "</tr>";
            }

            // Reemplazar el marcador {{detalles}} con las filas generadas de los productos
            $html = str_replace('{{detalles}}', $detalleProductosHTML, $html);

            // Otros reemplazos si son necesarios, como el total
            $html = str_replace('{{total}}', number_format($detalleCobro['cob_total'], 2), $html);
            
            $igv = number_format($detalleCobro['cob_total'], 2) * 0.18;
            $sub_total = number_format($detalleCobro['cob_total'], 2) - $igv;

            $html = str_replace('{{igv}}', number_format($igv, 2), $html);
            
            $html = str_replace('{{sub_total}}', number_format( $sub_total, 2), $html);
            
            // Configurar Dompdf
            $options = new Options();
            $options->set('defaultFont', 'Courier');
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);

            // Crear instancia de Dompdf
            $dompdf = new Dompdf($options);

            // Configurar márgenes
            $dompdf->setOptions(new Options([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'Courier',
                'margin_top' => 0,
                'margin_right' => 0,
                'margin_bottom' => 0,
                'margin_left' => 0
            ]));

            // Cargar contenido HTML
            $dompdf->loadHtml($html);

            // Configurar el tamaño y la orientación de la página
            $dompdf->setPaper([0, 0, 93, 465]);

            // Renderizar el PDF
            $dompdf->render();

            // Enviar el PDF al navegador
            $dompdf->stream("comprobante_cobro_{$detalleCobro['cob_id']}.pdf", array("Attachment" => false));
        }
        break;
        case "generar_comprobante_pedido":
            if (isset($_GET['pedido_id'])) {
                $pedido_id = (int)$_GET['pedido_id']; // Asegúrate de que sea un entero
                // Obtener los datos del cobro
                $detalleCobro = $cobro->obtener_detalle_cobro_pedido($pedido_id);
    
    
                // Determinar si es boleta o factura
                $tipoComprobante = $detalleCobro['tipo_comprobante']; // 1 para Boleta, 2 para Factura
                $esBoleta = $tipoComprobante == 1;
                $prefijoComprobante = $esBoleta ? 'B' : 'F';
    
                // Leer el contenido del archivo HTML
                $html = file_get_contents('comprobante.html');
    
                // Reemplazos dinámicos según el tipo de comprobante
                $html = str_replace('{{tipo_comprobante}}', $esBoleta ? 'BOLETA' : 'FACTURA', $html);
                $html = str_replace('{{tipo_comprobante_prefijo}}', $prefijoComprobante, $html);
                $html = str_replace('{{cobro_id}}', str_pad($detalleCobro['cob_id'], 6, '0', STR_PAD_LEFT), $html);
                $html = str_replace('{{fecha}}', date('d/m/Y', strtotime($detalleCobro['fechacrea'])), $html);
    
                // Cambiar textos de acuerdo al tipo de comprobante
                $html = str_replace('{{dni_ruc_label}}', $esBoleta ? 'DNI' : 'RUC', $html);
                $html = str_replace('{{nombre_razon_label}}', $esBoleta ? 'Nombre' : 'Razón Social', $html);
    
                // Datos del cliente
                $html = str_replace('{{dni_ruc}}', $esBoleta ? $detalleCobro['cob_dni'] : $detalleCobro['cob_ruc'], $html);
                $html = str_replace('{{razon_social}}', $esBoleta ? $detalleCobro['cob_nombre'] : $detalleCobro['cob_razon_social'], $html);
    
                // Procesar los productos desde el JSON de cob_conceptos
                $productos = json_decode($detalleCobro['cob_conceptos'], true);
                $detalleProductosHTML = '';
    
                // Generar HTML de los productos
                foreach ($productos as $producto) {
                    $detalleProductosHTML .= "<tr>";
                    $detalleProductosHTML .= "<td style='text-align:left;'>{$producto['nombre']}</td>";
                    $detalleProductosHTML .= "<td>S/ {$producto['precio_unitario']}</td>";
                    $detalleProductosHTML .= "<td>{$producto['cantidad']}</td>";
                    $detalleProductosHTML .= "<td>S/ {$producto['total']}</td>";
                    $detalleProductosHTML .= "</tr>";
                }
    
                // Reemplazar el marcador {{detalles}} con las filas generadas de los productos
                $html = str_replace('{{detalles}}', $detalleProductosHTML, $html);
    
                // Otros reemplazos si son necesarios, como el total
                $html = str_replace('{{total}}', number_format($detalleCobro['cob_total'], 2), $html);
                
                $igv = number_format($detalleCobro['cob_total'], 2) * 0.18;
                $sub_total = number_format($detalleCobro['cob_total'], 2) - $igv;
    
                $html = str_replace('{{igv}}', number_format($igv, 2), $html);
                
                $html = str_replace('{{sub_total}}', number_format( $sub_total, 2), $html);
                
                // Configurar Dompdf
                $options = new Options();
                $options->set('defaultFont', 'Courier');
                $options->set('isHtml5ParserEnabled', true);
                $options->set('isRemoteEnabled', true);
    
                // Crear instancia de Dompdf
                $dompdf = new Dompdf($options);
    
                // Configurar márgenes
                $dompdf->setOptions(new Options([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'defaultFont' => 'Courier',
                    'margin_top' => 0,
                    'margin_right' => 0,
                    'margin_bottom' => 0,
                    'margin_left' => 0
                ]));
    
                // Cargar contenido HTML
                $dompdf->loadHtml($html);
    
                // Configurar el tamaño y la orientación de la página
                $dompdf->setPaper([0, 0, 93, 465]);
    
                // Renderizar el PDF
                $dompdf->render();
    
                // Enviar el PDF al navegador
                $dompdf->stream("comprobante_cobro_{$detalleCobro['cob_id']}.pdf", array("Attachment" => false));
            }
            break;



    case "listar_mesas":
        $data = $cobro->listar_mesas();
        echo json_encode($data);
        break;
}
