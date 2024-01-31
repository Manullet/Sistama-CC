<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT
    tbl_urea_medicion.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha,
    SUM(tbl_urea_medicion.emisiones_urea) as total_emisiones_urea
FROM
    tbl_urea_medicion
    INNER JOIN tbl_sector ON tbl_urea_medicion.id_sector = tbl_sector.id_sector
    INNER JOIN tbl_categorias_fichas ON tbl_urea_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
GROUP BY
    tbl_urea_medicion.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha
ORDER BY
    tbl_urea_medicion.anio");

$docu = "Tendencia_Urea_Resumen.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

echo '<table border=1>';
echo '<tr>';
echo '<th colspan=5>Reporte de tabla </th>'; // Ajusta el colspan a 5 para incluir la nueva columna
echo '</tr>';
echo '<tr>
        <th>Año</th>
        <th>Sector</th>
        <th>Categoria Ficha</th>
        <th>Emisiones de CO2 (Gg)</th>
        <th>Variacion</th>
      </tr>';

$variacionAnterior = null;
$totalEmisionesUrea = 0;

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $row['anio'] . '</td>';
    echo '<td>' . $row['sector'] . '</td>';
    echo '<td>' . $row['categoria_ficha'] . '</td>';
    echo '<td>' . $row['total_emisiones_urea'] . '</td>';

    // Calcular la variación
    if ($variacionAnterior !== null) {
        $variacion = ($row['total_emisiones_urea'] / $variacionAnterior - 1) * 100;
        echo '<td>' . number_format($variacion, 1) . '%</td>';
    } else {
        echo '<td></td>';
    }

    echo '</tr>';
    $variacionAnterior = $row['total_emisiones_urea'];
    $totalEmisionesUrea += $row['total_emisiones_urea'];
}

// Agregar fila de totales
echo '<tr>';
echo '<td colspan="3">Totales</td>';
echo '<td>' . $totalEmisionesUrea . '</td>';
echo '</tr>';

echo '</table>';
?>