<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT
    tbl_encalado_medicion_n.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha,
    SUM(tbl_encalado_medicion_n.emision_co_pc) as emision_co_pc
FROM
    tbl_encalado_medicion_n
    INNER JOIN tbl_fichas ON tbl_encalado_medicion_n.id_ficha = tbl_fichas.id_ficha
    INNER JOIN tbl_categorias_fichas ON tbl_encalado_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
    INNER JOIN tbl_sector ON tbl_encalado_medicion_n.id_sector = tbl_sector.id_sector
GROUP BY
    tbl_encalado_medicion_n.anio,
    tbl_sector.sector,
    tbl_categorias_fichas.categoria_ficha
ORDER BY
    tbl_encalado_medicion_n.anio");

$docu = "Tendencia_Encalado_Resumen.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM

echo '<table border=1>';
echo '<tr>';
echo '<th colspan=5>Reporte de tabla </th>';
echo '</tr>';
echo '<tr>
        <th>Sector</th>
        <th>Categoria Ficha</th>
        <th>Anio</th>
        <th>Emisiones CO2 (Gg)</th>
        <th>Variacion</th>
      </tr>';

$variacionAnterior = null;

while ($row = mysqli_fetch_array($query)) {
    echo '<tr>';
    echo '<td>' . $row['sector'] . '</td>';
    echo '<td>' . $row['categoria_ficha'] . '</td>';
    echo '<td>' . $row['anio'] . '</td>';
    echo '<td>' . $row['emision_co_pc'] . '</td>';
    echo '<td>'; // Columna de Variación

    // Calcular variación solo si no es el primer año
    if ($variacionAnterior !== null) {
        $variacion = ($row['emision_co_pc'] / $variacionAnterior - 1) * 100;
        echo $variacion . '%';
    } else {
        echo 'N/A';
    }

    echo '</td>';
    echo '</tr>';

    // Almacenar emisiones CO2 por año en la variable de variación anterior
    $variacionAnterior = $row['emision_co_pc'];
}

echo '</table>';
?>
