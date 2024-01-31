<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = $conexion->query("SELECT tbl_fon.id_fon, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_fon.nivel_medicion, tbl_sector.sector, tbl_fon.anio, tbl_gestion_mms_estiercol.gestion_estiercol, tbl_categorias_especies.categoria_especie, tbl_especie.especie, tbl_criterio_medicion.criterio_medicion, tbl_fon.numero_ficha, tbl_fon.categoria_medicion, tbl_fon.cantidad_especie, tbl_fon.promedio_b, tbl_fon.fraccion_c, tbl_fon.cantidad_nitrogeno_d, tbl_fon.cantidad_nitrogeno_e, tbl_fon.cantidad_nitrogeno_f, tbl_fon.cantidad_g, tbl_fon.estado
FROM tbl_fon
INNER JOIN tbl_fichas ON tbl_fon.id_ficha = tbl_fichas.id_ficha
INNER JOIN tbl_categorias_fichas ON tbl_fon.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
INNER JOIN tbl_sector ON tbl_fon.id_sector = tbl_sector.id_sector
INNER JOIN tbl_categorias_especies ON tbl_fon.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
INNER JOIN tbl_especie ON tbl_fon.id_especie = tbl_especie.id_especie
INNER JOIN tbl_gestion_mms_estiercol ON tbl_fon.id_gestion_estiercol_mms = tbl_gestion_mms_estiercol.id_gestion_estiercol_mms
INNER JOIN tbl_criterio_medicion ON tbl_fon.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion");  

$docu = "FON.xls";
header('content-type: application/vnd.ms-excel');
header('content-Disposition: attachment; filename= ' . $docu);
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Type: text/html; charset=utf-8');
echo "\xEF\xBB\xBF"; // UTF-8 BOM
echo '<table border=1>';
echo '<tr>';
echo '<th colspan=8>Reporte FON  </th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Agricultura</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>Emisiones directas de N2O de los suelos gestionados</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>3A2</th>';
echo  '</tr>';
echo '<tr>';
echo '<th colspan=8>N2O directas por la aplicación de fertilizantes, estiércol y residuos - Tier 1</th>';
echo  '</tr>';

echo '<tr>
        <th>Año</th>
        <th>Sistema de gestión del estiércol (MMS)</th>
        <th>Especie / Categoría de Ganado</th>
        <th>Cantidad de cabezas de la especie/categoría de ganado</th>
        <th>Promedio anual de excreción de N por cabeza de la especie/categoría</th>
        <th>Fracción de la excreción total anual de nitrógeno de cada especie/categoría de ganado T que se gestiona en el sistema de gestión del estiércol S</th>
        <th>Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
        <th>Cantidad de nitrógeno del estiércol gestionado para la categoría de ganado T que se pierde en el sistema de gestión del estiércol S,</th>
        <th>Cantidad de nitrógeno de las camas (a aplicar para almacenamiento de sólidos y MMS de cama profunda si se utiliza una cama orgánica conocida)</th>
        <th>Cantidad anual de de estiércol animal, compost, lodos cloacales y otros aportes de N aplicada a los suelos</th>
    </tr>';

$registros = [];
while ($row = mysqli_fetch_array($sql)) {
    $registros[$row['anio']][] = $row;
}

foreach ($registros as $anio => $datosAnio) {
    echo '<tr>';
    echo '<td colspan="9"><strong>Año ' . $anio . '</strong></td>';
    echo '</tr>';

    $totalCantidadG = 0;

    foreach ($datosAnio as $row) {
        echo '<tr>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['gestion_estiercol'] . '</td>';
        echo '<td>' . $row['categoria_especie'] . '</td>';
        echo '<td>' . $row['cantidad_especie'] . '</td>';
        echo '<td>' . $row['promedio_b'] . '</td>';
        echo '<td>' . $row['fraccion_c'] . '</td>';
        echo '<td>' . $row['cantidad_nitrogeno_d'] . '</td>';
        echo '<td>' . $row['cantidad_nitrogeno_e'] . '</td>';
        echo '<td>' . $row['cantidad_nitrogeno_f'] . '</td>';
        echo '<td>' . $row['cantidad_g'] . '</td>';
        echo '</tr>';

        // Sumar los valores para los totales del año actual
        $totalCantidadG += $row['cantidad_g'];
    }

    // Fila de totales por año
    echo '<tr>';
    echo '<td colspan="8">Totales</td>';
    echo '<td>' . $totalCantidadG . '</td>';
    echo '</tr>';
}

echo '</table>';
?>