<?php
include '../php/conexion_be.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT tbl_urea_medicion.id_urea_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_urea_medicion.codigo_categoria, tbl_urea_medicion.hoja, tbl_urea_medicion.referencia, tbl_sub_categorias_urea.categoria_urea, tbl_urea_medicion.anio, tbl_urea_medicion.numero_ficha, tbl_criterio_medicion.criterio_medicion, tbl_urea_medicion.sigla, tbl_urea_medicion.descripcion, tbl_urea_medicion.fertilizacion_urea, tbl_urea_medicion.factor_urea, tbl_urea_medicion.emisiones_urea, tbl_urea_medicion.total, tbl_urea_medicion.creado_por, tbl_urea_medicion.fecha_creacion, tbl_urea_medicion.actualizado_por, tbl_urea_medicion.fecha_actualizacion, tbl_urea_medicion.estado 
FROM tbl_urea_medicion INNER JOIN tbl_fichas ON tbl_urea_medicion.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_urea_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_sector ON tbl_urea_medicion.id_sector = tbl_sector.id_sector INNER JOIN tbl_sub_categorias_urea ON tbl_urea_medicion.id_subcategoria_urea = tbl_sub_categorias_urea.id_subcategoria_urea INNER JOIN tbl_criterio_medicion ON tbl_urea_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");

$docu = "urea_medicion.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' . $docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=5>Reporte de Tabla Urea Medicion  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=5>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=5>Categoria Aplicacion de Urea  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=5>Codigo Categoria 3C3 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=5>CO2 del uso de urea en suelos agricolas </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=5>Capitulo 11 del volumen 4 de las directrices del IPCC de 2006 </th>';
echo  '</tr>';

echo '<tr>
        <th>Año</th>
        <th>Sub-Categorias por año de reporte</th>
        <th>Cantidad Anual de Fertilizacion con urea</th>
        <th>Factor de Emision</th>
        <th>Emisiones de CO2 por Aplicacion de Urea</th>
    </tr>';

$registros = [];
while ($row = mysqli_fetch_array($query)) {
    $registros[$row['anio']][] = $row;
}

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="4"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalEmisionesUrea = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['categoria_urea'] . '</td>';
        echo '<td>' . $row['fertilizacion_urea'] . '</td>';
        echo '<td>' . $row['factor_urea'] . '</td>';
        echo '<td>' . $row['emisiones_urea'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalEmisionesUrea += $row['emisiones_urea'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="3">Totales</td>';
    echo '<td colspan="2">' . $totalEmisionesUrea . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
