<?php
include '../php/conexion_be.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$sql = $conexion->query("SELECT 
    tbl_suelos_indirectos_b.anio,
    tbl_sector.sector, 
    tbl_categorias_fichas.categoria_ficha, 
    SUM(tbl_suelos_indirectos_b.total) as total_anio
FROM tbl_suelos_indirectos_b 
INNER JOIN tbl_sector ON tbl_suelos_indirectos_b.id_sector = tbl_sector.id_sector 
INNER JOIN tbl_categorias_fichas ON tbl_categorias_fichas.id_categoria_ficha = tbl_suelos_indirectos_b.categoria_ficha
GROUP BY tbl_suelos_indirectos_b.anio, tbl_sector.sector, tbl_categorias_fichas.categoria_ficha");

$docu = "Suelos_indirectos_reporte.xlsx";

// Agregar encabezados
$sheet->setCellValue('A1', 'Año');
$sheet->setCellValue('B1', 'Sector');
$sheet->setCellValue('C1', 'Categoria Ficha');
$sheet->setCellValue('D1', 'Emision de N2O (Gg)');
$sheet->setCellValue('E1', 'Variacion');

$totalAnterior = null;

$rowNumber = 2;

while ($row = mysqli_fetch_assoc($sql)) {
    $sheet->setCellValue('A' . $rowNumber, $row['anio']);
    $sheet->setCellValue('B' . $rowNumber, $row['sector']);
    $sheet->setCellValue('C' . $rowNumber, $row['categoria_ficha']);
    $sheet->setCellValue('D' . $rowNumber, $row['total_anio']);

    // Calcular la variación
    if ($totalAnterior !== null) {
        $variacion = ($row['total_anio'] / $totalAnterior - 1) * 100;
        $sheet->setCellValue('E' . $rowNumber, $variacion);
    } else {
        $sheet->setCellValue('E' . $rowNumber, null);
    }

    $totalAnterior = $row['total_anio'];
    $rowNumber++;
}

// Crear el escritor para Excel y enviar la salida al navegador
$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $docu . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
?>