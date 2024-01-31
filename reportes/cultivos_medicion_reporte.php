<?php
include '../php/conexion_be.php';

$query = $conexion->query("SELECT tbl_cultivos_medicion.id_cultivos_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_sector.sector, tbl_categorias_cultivo.cultivo, tbl_criterio_medicion.criterio_medicion, tbl_cultivos_medicion.nivel_medicion, tbl_cultivos_medicion.anio, tbl_cultivos_medicion.numero_ficha, tbl_cultivos_medicion.total, tbl_cultivos_medicion.sigla, tbl_cultivos_medicion.descripcion, tbl_cultivos_medicion.actualizado_por, tbl_cultivos_medicion.tipo_superficie, tbl_cultivos_medicion.masa_combustible, tbl_cultivos_medicion.factor_emision_ch, tbl_cultivos_medicion.factor_emision_co, tbl_cultivos_medicion.factor_emision_n2o, tbl_cultivos_medicion.factor_emision_nox, tbl_cultivos_medicion.emision_ch, tbl_cultivos_medicion.emision_co, tbl_cultivos_medicion.emision_n2o, tbl_cultivos_medicion.emision_nox , tbl_cultivos_medicion.factor_combustion ,tbl_cultivos_medicion.estado
FROM tbl_cultivos_medicion
INNER JOIN tbl_fichas ON tbl_cultivos_medicion.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_cultivos_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_cultivos_medicion.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_cultivo ON tbl_cultivos_medicion.id_cultivo = tbl_categorias_cultivo.id_cultivo
INNER JOIN tbl_criterio_medicion ON tbl_cultivos_medicion.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");

$docu = "cultivos_medicion.xls";
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
echo '<th colspan=4>Reporte de Tabla Residuos Medicion  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Quemado de Biomasa en Tierras de Cultivo  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Codigo Categoria 3C1b </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Hoja GEI de la quema de residuos Agricolas </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=4>Capitulo 2 del volumen 4 de las directrices del IPCC de 2006 </th>';
echo  '</tr>';

echo  
    '<tr>
    <th>Cultivo</th>
    <th>Superficie Quemada</th>
    <th>Masa de Combustible disponible para la combustión</th>
    <th>Factor de Combustión</th>
    <th>Factor de Emisión CH4</th>
    <th>Factor de Emisión CO</th>
    <th>Factor de Emisión N2O</th>
    <th>Factor de Emisión NOx</th>
    <th>Emisión CH4</th>
    <th>Emisión CO</th>
    <th>Emisión N2O</th>
    <th>Emisión NOx</th>
    </tr>';

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="12"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalEmisionCH = 0;
    $totalEmisionCO = 0;
    $totalEmisionN2O = 0;
    $totalEmisionNOx = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['cultivo']. '</td>';
        echo '<td>' . $row['tipo_superficie']. '</td>';
        echo '<td>' . $row['masa_combustible']. '</td>';
        echo '<td>' . $row['factor_combustion']. '</td>';
        echo '<td>' . $row['factor_emision_ch']. '</td>';
        echo '<td>' . $row['factor_emision_co']. '</td>';
        echo '<td>' . $row['factor_emision_n2o']. '</td>';
        echo '<td>' . $row['factor_emision_nox']. '</td>';
        echo '<td>' . $row['emision_ch']. '</td>';
        echo '<td>' . $row['emision_co']. '</td>';
        echo '<td>' . $row['emision_n2o']. '</td>';
        echo '<td>' . $row['emision_nox']. '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalEmisionCH += $row['emision_ch'];
        $totalEmisionCO += $row['emision_co'];
        $totalEmisionN2O += $row['emision_n2o'];
        $totalEmisionNOx += $row['emision_nox'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="8">Totales</td>';
    echo '<td>' . $totalEmisionCH . '</td>';
    echo '<td>' . $totalEmisionCO . '</td>';
    echo '<td>' . $totalEmisionN2O . '</td>';
    echo '<td>' . $totalEmisionNOx . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
