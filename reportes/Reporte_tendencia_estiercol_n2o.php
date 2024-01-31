<?php
    include '../php/conexion_be.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

   $query = mysqli_query($conexion, "SELECT 
   tbl_sistema_mms.sistema, 
   tbl_especie.especie, 
   tbl_estiercol_n2o.cantidad_a, 
   tbl_estiercol_n2o.tasa_b, 
   tbl_estiercol_n2o.masa_c,
   tbl_estiercol_n2o.promedio_d,
   tbl_estiercol_n2o.fraccion_e,
   tbl_estiercol_n2o.n_total_f,
   tbl_estiercol_n2o.factor_g,
   tbl_estiercol_n2o.emision_h
FROM tbl_estiercol_n2o 
INNER JOIN tbl_sistema_mms ON tbl_estiercol_n2o.id_sistema = tbl_sistema_mms.id_sistema 
INNER JOIN tbl_especie ON tbl_estiercol_n2o.id_especie = tbl_especie.id_especie
");

    $docu = "Tendencia_N2oestiercol_Resumen.xls";
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
            <th>Emision de N2O (Gg)</th>
            <th>Variacion</th>
          </tr>';









          
          ?>