<?php
include '../php/conexion_be.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

   $query = mysqli_query($conexion, "SELECT
    tbl_categorias_fichas.categoria_ficha,
    tbl_sector.sector,
    tbl_fprp_medicion_resumen.anio,
    tbl_estiercol_fprp_medicion.emisiones_directas_FPRP,
    tbl_fprp_medicion_resumen.variacion
    FROM tbl_fprp_medicion_resumen  
    INNER JOIN tbl_sector ON tbl_fprp_medicion_resumen.id_sector = tbl_sector.id_sector 
    INNER JOIN tbl_categorias_fichas ON tbl_fprp_medicion_resumen.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha
    INNER JOIN tbl_estiercol_fprp_medicion ON tbl_fprp_medicion_resumen.id_fprp_estiercol_medicion = tbl_estiercol_fprp_medicion.id_fprp_estiercol_medicion
");

    $docu = "Tendencia_FPRP_Resumen.xls";
    header('content-type: application/vnd.ms-excel');
    header('content-Disposition: attachment; filename= ' .$docu);
    header('Pragma: no-cache');
    header('Expires: 0');
    header('Content-Type: text/html; charset=utf-8');
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    echo '<table border=1>';
    echo '<tr>';
    echo '<th colspan=5>Reporte de tabla </th>'; // Ajusta el colspan a 7 para incluir la nueva columna
    echo  '</tr>';
    echo '<tr>
            <th>Sector</th>
            <th>Categoria Ficha</th>
            <th>Anio</th>
            <th>Emisiones N2O (Gg)</th>
            <th>Variacion</th>
          </tr>';

    // Muestra los datos de la tabla tbl_fermentacion_estiercol
    while ($row = mysqli_fetch_array($query)) {
        echo '<tr>';
        echo '<td>' . $row['sector'] . '</td>';
        echo '<td>' . $row['categoria_ficha'] . '</td>';
        echo '<td>' . $row['anio'] . '</td>';
        echo '<td>' . $row['emisiones_directas_FPRP'] . '</td>';
        echo '<td>' . $row['variacion'] . '</td>';
        echo '</tr>';
    }

    
?>