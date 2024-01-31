<?php
include '../php/conexion_be.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT tbl_suelosdirectos_medicion.id_suelosDirectos_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_tipos_suelos_directos.nombre_suelo, tbl_suelosdirectos_medicion.anio, tbl_suelosdirectos_medicion.numero_ficha, tbl_categorias_fichas.categoria_ficha, tbl_suelosdirectos_medicion.sigla, tbl_suelosdirectos_medicion.descripcion_medicion, tbl_suelosdirectos_medicion.cantidad_anual_n_formula, tbl_suelosdirectos_medicion.cantidad_anual_n_dato, tbl_suelosdirectos_medicion.factor_emision_formula, tbl_suelosdirectos_medicion.factor_emision_dato, tbl_suelosdirectos_medicion.emisiones_directas_aportes, tbl_suelosdirectos_medicion.subtotal, tbl_suelosdirectos_medicion.total, tbl_suelosdirectos_medicion.creado_por, tbl_suelosdirectos_medicion.fecha_creacion, tbl_suelosdirectos_medicion.actualizado_por, tbl_suelosdirectos_medicion.fecha_actualizacion, tbl_suelosdirectos_medicion.estado, tbl_suelosdirectos_medicion.codigo_categoria, tbl_suelosdirectos_medicion.descripcion_suelo, tbl_criterio_medicion.criterio_medicion
FROM tbl_suelosdirectos_medicion 
INNER JOIN tbl_fichas ON tbl_suelosdirectos_medicion.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_suelosdirectos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_suelosdirectos_medicion.id_sector = tbl_sector.id_sector
INNER JOIN tbl_tipos_suelos_directos ON tbl_suelosdirectos_medicion.id_suelo_directo = tbl_tipos_suelos_directos.id_suelo_directo
INNER JOIN tbl_criterio_medicion ON tbl_suelosdirectos_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");
$docu = "SuelosDirectos_medicion.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' . $docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=7>Reporte de Tabla Suelos Directos Medicion  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Categoria Emisiones de N2O de los Suelos Gestionados  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Codigo Categoria 3C4 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>N2O Directas por la aplicacion de Fertilizantes, estiercol y Residuos </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Capitulo 11 del volumen 4 de las directrices del IPCC de 2006 </th>';
echo  '</tr>';

echo '<tr>
        <th>Año</th>
        <th>Tipo de N Aplicado</th>
        <th>Tipo de N Aplicado Descripcion</th>
        <th>Cantidad Anual de N Aplicado</th>
        <th>Cantidad Anual de N Aplicado Dato</th>
        <th>Factor de Emision de N2O de Aportes</th>
        <th>Factor de Emision de N2O de Aportes Dato</th>
        <th>Emisiones Directas de N2O-N Aportes de N</th>
    </tr>';

$registros = [];
while ($row = mysqli_fetch_array($query)) {
    $registros[$row['anio']][] = $row;
}

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="7"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalEmisionesAportes = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['nombre_suelo'] . '</td>';
        echo '<td>' . $row['descripcion_suelo'] . '</td>';
        echo '<td>' . $row['cantidad_anual_n_formula'] . '</td>';
        echo '<td>' . $row['cantidad_anual_n_dato'] . '</td>';
        echo '<td>' . $row['factor_emision_formula'] . '</td>';
        echo '<td>' . $row['factor_emision_dato'] . '</td>';
        echo '<td>' . $row['emisiones_directas_aportes'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalEmisionesAportes += $row['emisiones_directas_aportes'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="6">Totales</td>';
    echo '<td>' . $totalEmisionesAportes . '</td>';
    echo '</tr>';
}

echo '</table>';
?>