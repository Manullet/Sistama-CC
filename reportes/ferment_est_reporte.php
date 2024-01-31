<?php
include '../php/conexion_be.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT tbl_fermentacion_estiercol.id_fermentacion, tbl_fichas.descripcion, tbl_categorias_fichas.categoria_ficha, tbl_fermentacion_estiercol.nivel_medicion, tbl_sector.sector, tbl_fermentacion_estiercol.anio, tbl_fermentacion_estiercol.numero_ficha, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_fermentacion_estiercol.categoria_medicion, tbl_criterio_medicion.criterio_medicion, tbl_fermentacion_estiercol.cantidad_especie, tbl_fermentacion_estiercol.descripcion, tbl_fermentacion_estiercol.sigla, tbl_fermentacion_estiercol.creado_por, tbl_fermentacion_estiercol.fecha_creacion, tbl_fermentacion_estiercol.actualizado_por, tbl_fermentacion_estiercol.fecha_actualizacion, tbl_fermentacion_estiercol.estado, tbl_fermentacion_estiercol.total_fermentacion, tbl_fermentacion_estiercol.total_estiercol, tbl_fermentacion_estiercol.factor_fermentacion, tbl_fermentacion_estiercol.factor_estiercol
FROM tbl_fermentacion_estiercol INNER JOIN tbl_sector ON tbl_fermentacion_estiercol.id_sector = tbl_sector.id_sector INNER JOIN tbl_categorias_especies ON tbl_fermentacion_estiercol.id_categoria_especie = tbl_categorias_especies.id_categoria_especie  INNER JOIN tbl_especie ON tbl_fermentacion_estiercol.id_especie = tbl_especie.id_especie  INNER JOIN tbl_criterio_medicion ON tbl_fermentacion_estiercol.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion  INNER JOIN tbl_fichas ON tbl_fermentacion_estiercol.id_ficha = tbl_fichas.id_ficha  INNER JOIN tbl_categorias_fichas ON tbl_fermentacion_estiercol.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha");

$docu = "fermentacion_estiercol.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

// Obtén todos los registros
$registros = [];
while ($row = mysqli_fetch_array($query)) {
    $registros[$row['anio']][] = $row;
}

echo '<table border=1>';
echo '<tr>';
echo '<th colspan=4>Reporte de Tabla Fermentacion Estiercol  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Categoria Fermentacion Enterica y Gestion del Estiercol Ganado  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Codigo Categoria 3A1 y 3A2 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Hoja CH4 de Fermentacion Enterica y Gestion del Estiercol Tier 1 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Referencia Capitulo 10 del Volumen de las Directrices del IPCC de 2006 </th>';
echo  '</tr>';

echo
    '<tr>
        <th>Especie / Categoria de Ganado</th>
        <th>Cantidad de Cabezas de la Especie / Categoria de Ganado</th>
        <th>Factor de Emision ( kg. de CH4 / Cabeza)</th>
        <th>Emision CH4 Fermentacion</th>
        <th>Factor de Emision ( kg. de CH4 / Cabeza)</th>
        <th>Emision CH4 Estiercol</th></tr>';

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="6"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalFermentacion = 0;
    $totalEstiercol = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['categoria_especie'] . '</td>';
        echo '<td>' . $row['cantidad_especie'] . '</td>';
        echo '<td>' . $row['factor_fermentacion'] . '</td>';
        echo '<td>' . $row['total_fermentacion'] . '</td>';
        echo '<td>' . $row['factor_estiercol'] . '</td>';
        echo '<td>' . $row['total_estiercol'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalFermentacion += $row['total_fermentacion'];
        $totalEstiercol += $row['total_estiercol'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="3">Totales</td>';
    echo '<td>' . $totalFermentacion . '</td>';
    echo '<td colspan="2">' . $totalEstiercol . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
