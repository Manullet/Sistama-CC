<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT
    tbl_fermentacion_estiercol.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha,
    SUM(tbl_fermentacion_estiercol.total_fermentacion) as total_fermentacion,
    SUM(tbl_fermentacion_estiercol.total_estiercol) as total_estiercol
FROM
    tbl_fermentacion_estiercol
    INNER JOIN tbl_sector ON tbl_fermentacion_estiercol.id_sector = tbl_sector.id_sector
    INNER JOIN tbl_categorias_fichas ON tbl_fermentacion_estiercol.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
GROUP BY
    tbl_fermentacion_estiercol.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha
ORDER BY
    tbl_fermentacion_estiercol.anio");

$docu = "Tendencia_Fermentacion_Estiercol.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

echo '<table border=1>';
echo '<tr>';
echo '<th colspan=6>Reporte de tabla </th>'; // Ajusta el colspan a 6 para incluir la nueva columna
echo '</tr>';
echo '<tr>
        <th>Año</th>
        <th>Sector</th>
        <th>Categoría Ficha</th>
        <th>Emisión de CH4 (Gg)</th>
        <th>Emisión de CO2 (Gg)</th>
        <th>Variación</th>
      </tr>';
$variacionAnterior = null;

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $row['anio'] . '</td>';
    echo '<td>' . $row['sector'] . '</td>';
    echo '<td>' . $row['categoria_ficha'] . '</td>';
    echo '<td>' . $row['total_fermentacion'] . '</td>';
    echo '<td>' . $row['total_estiercol'] . '</td>';

    // Calcular la variación
    if ($variacionAnterior !== null) {
        $variacion = ($row['total_fermentacion'] / $variacionAnterior - 1) * 100;
        echo '<td>' . number_format($variacion, 1) . '%</td>';
    } else {
        echo '<td></td>';
    }

    echo '</tr>';
    $variacionAnterior = $row['total_fermentacion'];
}
echo '</table>';
?>

