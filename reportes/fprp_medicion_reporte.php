<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$query=mysqli_query($conexion, "SELECT tbl_estiercol_fprp_medicion_n.id_fprp_estiercol_medicion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_estiercol_fprp_medicion_n.nivel_medicion, tbl_estiercol_fprp_n.gestion_estiercol_FPRP, tbl_sector.sector, tbl_estiercol_fprp_medicion_n.anio, tbl_estiercol_fprp_medicion_n.numero_ficha, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_estiercol_fprp_medicion_n.categoria_medicion, tbl_criterio_medicion.criterio_medicion, tbl_estiercol_fprp_medicion_n.cantidad_especie, tbl_estiercol_fprp_medicion_n.promedio_anual_excrecion, tbl_estiercol_fprp_medicion_n.fraccion_excrecion_anual, tbl_estiercol_fprp_medicion_n.emisiones_directas_FPRP, tbl_estiercol_fprp_medicion_n.descripcion, tbl_estiercol_fprp_medicion_n.sigla, tbl_estiercol_fprp_medicion_n.estado, tbl_estiercol_fprp_medicion_n.hoja, tbl_estiercol_fprp_medicion_n.referencia
FROM tbl_estiercol_fprp_medicion_n INNER JOIN tbl_fichas ON tbl_estiercol_fprp_medicion_n.id_ficha = tbl_fichas.id_ficha INNER JOIN tbl_categorias_fichas ON tbl_estiercol_fprp_medicion_n.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha INNER JOIN tbl_estiercol_fprp_n ON tbl_estiercol_fprp_medicion_n.id_gestion_estiercol_FPRP = tbl_estiercol_fprp_n.id_gestion_estiercol_FPRP INNER JOIN tbl_sector ON tbl_estiercol_fprp_medicion_n.id_sector = tbl_sector.id_sector INNER JOIN tbl_categorias_especies ON tbl_estiercol_fprp_medicion_n.id_categoria_especie = tbl_categorias_especies.id_categoria_especie INNER JOIN tbl_especie ON tbl_estiercol_fprp_medicion_n.id_especie = tbl_especie.id_especie INNER JOIN tbl_criterio_medicion ON tbl_estiercol_fprp_medicion_n.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");
$docu="3C4FPRP_medicion.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' .$docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=7>Reporte de Tabla 3C4 FPRP  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Sector Agricultura  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Categoria Emisiones N2O de los Suelos Gestionados  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Codigo Categoria 3C4 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>N2O Directas por la aplicacion de fertilizantes, estiercol y residuos Tier 1 </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=7>Capitulo 11 del volumen 4 de las directrices del IPCC de 2006 </th>';
echo  '</tr>';
echo '<tr>
        <th>Año</th>
        <th>Sistema de Gestion del Estiercol MMS</th>
        <th>Especie / Categoria de Ganado</th>
        <th>Cantidad de Cabezas de la Especie</th>
        <th>Promedio Anual de Excrecion de N por cabeza de la especie</th>
        <th>Fraccion de la Excrecion total Anual de nitrogeno de cada especie</th>
        <th>Emisiones Directas de N2O de la gestion de Estiercol</th>
    </tr>';

$registros = [];
while ($row=mysqli_fetch_array($query)){
    $registros[$row['anio']][] = $row;
}

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="6"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalEmisionesFPRP = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['gestion_estiercol_FPRP'] . '</td>';
        echo '<td>' . $row['especie'] . '</td>';
        echo '<td>' . $row['cantidad_especie'] . '</td>';
        echo '<td>' . $row['promedio_anual_excrecion'] . '</td>';
        echo '<td>' . $row['fraccion_excrecion_anual'] . '</td>';
        echo '<td>' . $row['emisiones_directas_FPRP'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalEmisionesFPRP += $row['emisiones_directas_FPRP'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="6">Totales</td>';
    echo '<td>' . $totalEmisionesFPRP . '</td>';
    echo '</tr>';
}

echo '</table>';
?>
