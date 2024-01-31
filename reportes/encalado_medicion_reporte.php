<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query = mysqli_query($conexion, "SELECT tbl_encalado_medicion_n.id_encalado_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_encalado_medicion_n.nivel_medicion, tbl_tipos_cal_n.tipo_cal, tbl_sector.sector, tbl_encalado_medicion_n.anio, tbl_encalado_medicion_n.numero_ficha, tbl_criterio_medicion.criterio_medicion, tbl_encalado_medicion_n.sigla, tbl_encalado_medicion_n.descripcion, tbl_encalado_medicion_n.cantidad_anual_pc, tbl_encalado_medicion_n.factor_pc, tbl_encalado_medicion_n.cantidad_anual_dolomita, tbl_encalado_medicion_n.factor_dolomita, tbl_encalado_medicion_n.emision_co_pc, tbl_encalado_medicion_n.creado_por, tbl_encalado_medicion_n.fecha_creacion, tbl_encalado_medicion_n.actualizado_por, tbl_encalado_medicion_n.fecha_actualizacion, tbl_encalado_medicion_n.estado, tbl_encalado_medicion_n.codigo_categoria, tbl_encalado_medicion_n.hoja, tbl_encalado_medicion_n.referencia, tbl_encalado_medicion_n.emision_co_dolomita
FROM tbl_encalado_medicion_n INNER JOIN tbl_fichas ON tbl_encalado_medicion_n.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_encalado_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_sector ON tbl_encalado_medicion_n.id_sector = tbl_sector.id_sector INNER JOIN tbl_tipos_cal_n ON tbl_encalado_medicion_n.id_tipo_cal = tbl_tipos_cal_n.id_tipo_cal INNER JOIN tbl_criterio_medicion ON tbl_encalado_medicion_n.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");

$docu = "encalado_medicion.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' . $docu);
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
echo '<th colspan=8>Reporte de Tabla Encalado Medicion  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Categoria Encalado  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Codigo Categoria 3C2 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>CO2 del uso de cal en suelos agricolas </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Capitulo 11 del volumen 4 de las directrices del IPCC de 2006 </th>';
echo  '</tr>';

echo
    '<tr>
    <th>Año</th>
    <th>Tipo de Cal</th>
    <th>Cantidad Anual de Piedra Caliza Cálcica</th>
    <th>Factor de Emision / tons de C / ton de Piedra Caliza</th>
    <th>Cantidad Anual de Dolomita</th>
    <th>Factor de Emision / tons de C / ton de Dolomita</th>
    <th>Emision de CO2 Piedra Caliza</th>
    <th>Emision de CO2 Dolomita</th>
    </tr>';

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="7"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalEmisionCO = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['tipo_cal'] . '</td>';
        echo '<td>' . $row['cantidad_anual_pc'] . '</td>';
        echo '<td>' . $row['factor_pc'] . '</td>';
        echo '<td>' . $row['cantidad_anual_dolomita'] . '</td>';
        echo '<td>' . $row['factor_dolomita'] . '</td>';
        echo '<td>' . $row['emision_co_pc'] . '</td>';
        echo '<td>' . $row['emision_co_dolomita'] . '</td>';
        echo '</tr>';

        $totalEmisionCO += ($row['emision_co_pc'] + $row['emision_co_dolomita']);
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="6" style="text-align: right;"><strong>Total Emisiones :</strong></td>';
    echo '<td colspan="2"><strong>' . $totalEmisionCO . '</strong></td>';
    echo '</tr>';
}

echo '</table>';
?>