<?php
include '../php/conexion_be.php';

// Obtener los valores de los campos (ajusta según cómo obtienes los datos)
$sector = $_POST['sector_edit'];
$categoria_ficha = $_POST['categoria_ficha_edit'];
$codigo_categoria = $_POST['codigo_categoria_edit'];
$hojas = $_POST['hojas_edit'];
$referencias = $_POST['referencias_edit'];
$anio = $_POST['anio_edit'];  // Corregido el nombre del campo
$cantidad_anual_n = $_POST['cantidad_anual_n_edit'];
$fraccion_n = $_POST['fraccion_n_edit'];
$cantidad_animal = $_POST['cantidad_animal_edit'];
$cantidad_orina = $_POST['cantidad_orina_edit'];
$fraccion_materiales = $_POST['fraccion_materiales_edit'];
$factor_emision = $_POST['factor_emision_edit'];
$cantidad_residuos = $_POST['cantidad_residuos_edit'];
$cantidad_mineralizado = $_POST['cantidad_mineralizado_edit'];
$fraccion_mineralizado = $_POST['fraccion_mineralizado_edit'];
$fraccion_lixiviacion = $_POST['fraccion_lixiviacion_edit'];


// Preparar la consulta SQL para llamar al procedimiento almacenado
$sql = "CALL Insert_suelos_indirectos_reporte(
    '$sector',
    '$categoria_ficha',
    '$codigo_categoria',
    '$hojas',
    '$anio',
    '$referencias',
    '$cantidad_anual_n',
    '$fraccion_n',
    '$cantidad_animal',
    '$cantidad_orina',
    '$fraccion_materiales',
    '$factor_emision',
    '$cantidad_residuos',
    '$cantidad_mineralizado',
    '$fraccion_mineralizado',
    '$fraccion_lixiviacion'
)";

$resultado = mysqli_query($conexion, $sql);

if ($resultado) {
    header("Location: ../bienvenida.php?success=true");
} else {
    echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>