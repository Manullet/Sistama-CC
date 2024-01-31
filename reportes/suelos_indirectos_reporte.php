<?php
    include '../php/conexion_be.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include "../php/conexion_be.php";
    $sql = $conexion->query("SELECT 
    tbl_suelos_indirectos_b.id_suelos_indirectos_b,
    tbl_fichas.id_ficha,
    tbl_suelos_indirectos.nombre_suelo,
    tbl_categorias_fichas.categoria_ficha, 
    tbl_sector.sector, 
    tbl_criterio_medicion.criterio_medicion, 
    tbl_suelos_indirectos_b.codigo_categoria,
    tbl_suelos_indirectos_b.anio,
    tbl_suelos_indirectos_b.categoria_medicion,
    tbl_suelos_indirectos_b.cantidad_anual_n,
    tbl_suelos_indirectos_b.fraccion_n,
    tbl_suelos_indirectos_b.cantidad_animal,
    tbl_suelos_indirectos_b.cantidad_orina,
    tbl_suelos_indirectos_b.fraccion_materiales,
    tbl_suelos_indirectos_b.factor_emision,
    tbl_suelos_indirectos_b.cantidad_deposicion,
    tbl_suelos_indirectos_b.n2o_volatilizacion,
    tbl_suelos_indirectos_b.cantidad_residuos,
    tbl_suelos_indirectos_b.cantidad_mineralizado,
    tbl_suelos_indirectos_b.fraccion_mineralizado,
    tbl_suelos_indirectos_b.cantidad_lixiviacion,
    tbl_suelos_indirectos_b.fraccion_lixiviacion,
    tbl_suelos_indirectos_b.n2o_lixxiviacion,
    tbl_suelos_indirectos_b.total,
    tbl_suelos_indirectos_b.hoja, 
    tbl_suelos_indirectos_b.referencia,
    tbl_suelos_indirectos_b.creado_por,
    tbl_suelos_indirectos_b.fecha_creacion,
    tbl_suelos_indirectos_b.actualizado_por,
    tbl_suelos_indirectos_b.fecha_actualizacion,
    tbl_suelos_indirectos_b.estado
FROM tbl_suelos_indirectos_b 
INNER JOIN tbl_fichas ON tbl_suelos_indirectos_b.id_ficha = tbl_fichas.id_ficha 
INNER JOIN tbl_categorias_fichas ON tbl_suelos_indirectos_b.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha 
INNER JOIN tbl_sector ON tbl_suelos_indirectos_b.id_sector = tbl_sector.id_sector 
INNER JOIN tbl_criterio_medicion ON tbl_suelos_indirectos_b.id_criterios_medicion = tbl_criterio_medicion.id_criterios_medicion
INNER JOIN tbl_suelos_indirectos ON tbl_suelos_indirectos_b.id_suelos_indirectos = tbl_suelos_indirectos.id_suelos_indirectos");


    $docu = "Suelos indirectos.xls";
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename=' . $docu);
    header('Pragma: no-cache');
    header('Expires: 0');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    echo '<table border="1">';
    echo '<tr>';
    echo '<th colspan="16">Reporte Suelos Indirectos</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<th colspan="16">Agricultura</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<th colspan="16">Emisiones indirectas de N2O de los suelos gestionados</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<th colspan="16">3C5</th>';
    echo '</tr>';
    echo '<tr>';
    echo '<th colspan="16">N2O indirectas por volatilización de nitrógeno (como NH3 y NOx) y lixiviación y el agotamiento de nitrógeno - Tier 1</th>';
    echo '</tr>';

    echo '<tr>';
    echo '<th>Año</th>';
    echo '<th>Cantidad Anual N</th>';
    echo '<th>Fraccion N</th>';
    echo '<th>Cantidad Animal</th>';
    echo '<th>Cantidad Orina</th>';
    echo '<th>Fraccion Materiales</th>';
    echo '<th>Factor Emisión</th>';
    echo '<th>Cantidad Deposición</th>';
    echo '<th>N2O Volatilización</th>';
    echo '<th>Cantidad Residuos</th>';
    echo '<th>Cantidad Mineralizado</th>';
    echo '<th>Fraccion Mineralizado</th>';
    echo '<th>Fraccion Lixiviacion</th>';
    echo '<th>Cantidad Lixiviacion</th>';
    echo '<th>N2O Lixxiviacion</th>';
    echo '<th>Total</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($sql)) {
        echo '<tr>';
       
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['cantidad_anual_n'] . '</td>';
        echo '<td>' . $row['fraccion_n'] . '</td>';
        echo '<td>' . $row['cantidad_animal'] . '</td>';
        echo '<td>' . $row['cantidad_orina'] . '</td>';
        echo '<td>' . $row['fraccion_materiales'] . '</td>';
        echo '<td>' . $row['factor_emision'] . '</td>';
        echo '<td>' . $row['cantidad_deposicion'] . '</td>';
        echo '<td>' . $row['n2o_volatilizacion'] . '</td>';
        echo '<td>' . $row['cantidad_residuos'] . '</td>';
        echo '<td>' . $row['cantidad_mineralizado'] . '</td>';
        echo '<td>' . $row['fraccion_mineralizado'] . '</td>';
        echo '<td>' . $row['fraccion_lixiviacion'] . '</td>';
        echo '<td>' . $row['cantidad_lixiviacion'] . '</td>';
        echo '<td>' . $row['n2o_lixxiviacion'] . '</td>';
        echo '<td>' . $row['total'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
?>