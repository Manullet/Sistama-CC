<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT
    tbl_cultivos_medicion.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha,
    SUM(tbl_cultivos_medicion.emision_ch) as total_emision_ch,
    SUM(tbl_cultivos_medicion.emision_n2o) as total_emision_n2o,
    SUM(tbl_cultivos_medicion.emision_co) as total_emision_co,
    MAX(tbl_cultivos_medicion.variacion) as max_variacion
FROM
    tbl_cultivos_medicion
    INNER JOIN tbl_fichas ON tbl_cultivos_medicion.id_ficha = tbl_fichas.id_ficha
    INNER JOIN tbl_categorias_fichas ON tbl_cultivos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
    INNER JOIN tbl_sector ON tbl_cultivos_medicion.id_sector = tbl_sector.id_sector
GROUP BY
    tbl_cultivos_medicion.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha
ORDER BY
    tbl_cultivos_medicion.anio");

$docu = "Tendencia_Residuos_Resumen.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

echo '<table border=1>';
echo '<tr>';
echo '<th colspan=7>Reporte de tabla </th>'; // Ajusta el colspan a 7 para incluir la nueva columna
echo '</tr>';
echo '<tr>
        <th>Año</th>
        <th>Sector</th>
        <th>Categoría Ficha</th>
        <th>Emisión de CH4 (Tonelada)</th>
        <th>Emisión de N2O (Tonelada)</th>
        <th>Emisión de CO2 equivalente (Gg)</th>
        <th>Variación</th>
      </tr>';

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $row['anio'] . '</td>';
    echo '<td>' . $row['sector'] . '</td>';
    echo '<td>' . $row['categoria_ficha'] . '</td>';
    echo '<td>' . $row['total_emision_ch'] . '</td>';
    echo '<td>' . $row['total_emision_n2o'] . '</td>';
    echo '<td>' . $row['total_emision_co'] . '</td>';
    echo '<td>' . ($row['max_variacion'] === null ? '' : $row['max_variacion']) . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
