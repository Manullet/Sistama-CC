<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT
    tbl_suelosdirectos_medicion.anio,
    SUM(tbl_suelosdirectos_medicion.emisiones_directas_aportes) as totalEmisionesAportes
FROM
    tbl_suelosdirectos_medicion
GROUP BY
    tbl_suelosdirectos_medicion.anio
ORDER BY
    tbl_suelosdirectos_medicion.anio");

$docu = "Resumen_SuelosDirectos_Año.xls";
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
echo '<tr>';
echo '<th>Año</th>';
echo '<th>Total Emisiones Directas Aportes (Gg)</th>';
echo '<th>Variación</th>';
echo '</tr>';

$totalEmisionesAportesAnterior = null;

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $row['anio'] . '</td>';
    echo '<td>' . $row['totalEmisionesAportes'] . '</td>';

    // Calcular la variación
    if ($totalEmisionesAportesAnterior !== null) {
        $variacion = ($row['totalEmisionesAportes'] / $totalEmisionesAportesAnterior - 1) * 100;
        echo '<td>' . number_format($variacion, 1) . '%</td>';
    } else {
        echo '<td></td>';
    }

    echo '</tr>';

    $totalEmisionesAportesAnterior = $row['totalEmisionesAportes'];
}

echo '</table>';
?>

