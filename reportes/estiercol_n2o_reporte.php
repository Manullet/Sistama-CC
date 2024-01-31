<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = $conexion->query("SELECT
tbl_estiercol_n2o.id_estiercol,
tbl_fichas.id_ficha,
tbl_categorias_fichas.categoria_ficha,
tbl_estiercol_n2o.nivel_medicion,
tbl_sector.sector,
tbl_estiercol_n2o.anio,
tbl_estiercol_n2o.numero_ficha,
tbl_categorias_especies.categoria_especie,
tbl_especie.especie,
tbl_estiercol_n2o.categoria_medicion,
tbl_criterio_medicion.criterio_medicion,
tbl_estiercol_n2o.cantidad_especie,
tbl_estiercol_n2o.sigla,
tbl_estiercol_n2o.creado_por,
tbl_estiercol_n2o.fecha_creacion,
tbl_estiercol_n2o.actualizado_por,
tbl_estiercol_n2o.fecha_actualizacion,
tbl_estiercol_n2o.estado, 
tbl_estiercol_n2o.tasa_excrecion, 
tbl_estiercol_n2o.masa_animal,
tbl_estiercol_n2o.promedio_anual_excrecion,
tbl_estiercol_n2o.fraccion_excrecion,
tbl_estiercol_n2o.n_total_excretado,
tbl_estiercol_n2o.factor_emisiones_directas,
tbl_estiercol_n2o.emision_directas,
tbl_gestion_mms_estiercol.gestion_estiercol

FROM tbl_estiercol_n2o 
INNER JOIN tbl_fichas ON tbl_estiercol_n2o.id_ficha = tbl_fichas.id_ficha 
INNER JOIN tbl_categorias_fichas ON tbl_estiercol_n2o.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_estiercol_n2o.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_especies ON tbl_estiercol_n2o.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
INNER JOIN tbl_especie ON tbl_estiercol_n2o.id_especie = tbl_especie.id_especie
INNER JOIN tbl_criterio_medicion ON tbl_estiercol_n2o.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
INNER JOIN tbl_gestion_mms_estiercol ON tbl_estiercol_n2o.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms"); 

$docu = "estiercol_n2o.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=11>Reporte de Estiercol N2O  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=11>Agricultura</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=11>Gestión del estiércol - Ganado</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=11>3A2</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=11>N2O de gestión del estiércol - Tier 1</th>';
echo  '</tr>';
echo '<tr>';
echo '<th>Año</th>
    <th>Sistema de gestión del estiércol (MMS)</th>
    <th>Especie / Categoría de Ganado</th>
    <th>Cantidad de Cabezas de la Especie / Categoría de Ganado</th>
    <th>Tasa de Excreción de N por Defecto</th>
    <th>Masa Animal Típica para la Categoría de Ganado T</th>
    <th>Promedio Anual de Excreción de N por Cabeza de la Especie/Categoría</th>
    <th>Fracción de la Excreción Total Anual de Nitrógeno de cada Especie/Categoría de Ganado T que se gestiona en el Sistema de Gestión del Estiércol S</th>
    <th>N Total Excretado por MMS</th>
    <th>Factor de Emisión para Emisiones Directas de N2O del Sistema de Gestión del Estiércol S</th>
    <th>Emisiones Directas de N2O del Sistema de Gestión del Estiércol S</th>
    </tr>';

$totalNTotalF = 0;
$totalEmisionH = 0;

$registros = [];
while ($row = mysqli_fetch_array($sql)){
    $registros[$row['anio']][] = $row;
}

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td><strong>' . $anio . '</strong></td>';
    
    $totalNTotalFAnio = 0;
    $totalEmisionHAnio = 0;

    foreach ($datosAnio as $row) {
        echo '<td>' . $row['gestion_estiercol'] . '</td>';
        echo '<td>' . $row['categoria_especie'] . '</td>';
        echo '<td>' . $row['cantidad_especie'] . '</td>';
        echo '<td>' . $row['tasa_excrecion'] . '</td>';
        echo '<td>' . $row['masa_animal'] . '</td>';
        echo '<td>' . $row['promedio_anual_excrecion'] . '</td>';
        echo '<td>' . $row['fraccion_excrecion'] . '</td>';
        echo '<td>' . $row['n_total_excretado'] . '</td>';
        echo '<td>' . $row['factor_emisiones_directas'] . '</td>';
        echo '<td>' . $row['emision_directas'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalNTotalFAnio += $row['n_total_excretado'];
        $totalEmisionHAnio += $row['emision_directas'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="7">Totales</td>';
    echo '<td>' . $totalNTotalFAnio . '</td>';
    echo '<td colspan="3">' . $totalEmisionHAnio . '</td>';
    echo '</tr>';

    // Sumar los valores para los totales generales
    $totalNTotalF += $totalNTotalFAnio;
    $totalEmisionH += $totalEmisionHAnio;
}

// Fila de totales generales al final
echo '<tr>';
echo '<td colspan="7">Totales Generales</td>';
echo '<td>' . $totalNTotalF . '</td>';
echo '<td colspan="3">' . $totalEmisionH . '</td>';
echo '</tr>';

echo '</table>';
?>
