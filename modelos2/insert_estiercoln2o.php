<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_ficha = $_POST['id_ficha'];
    $id_categoria_ficha = $_POST['id_categoria_ficha'];
    $nivel_medicion = $_POST['nivel_medicion'];
    $id_sector = $_POST['id_sector'];
    $anio = $_POST['anio'];
    $numero_ficha = $_POST['numero_ficha'];
    $id_categoria_especie = $_POST['id_categoria_especie'];
    $id_especie = $_POST['id_especie'];
    $categoria_medicion = $_POST['categoria_medicion'];
    $id_criterios_medicion = $_POST['id_criterios_medicion'];
    $cantidad_especie = $_POST['cantidad_especie'];
    $sigla = $_POST['sigla'];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST['estado'];
    $tasa_excrecion = $_POST['tasa_excrecion'];
    $masa_animal = $_POST['masa_animal'];
    $fraccion_excrecion = $_POST['fraccion_excrecion'];
    $factor_emisiones_directas = $_POST['factor_emisiones_directas'];
    $id_gestion_estiercol_mms = $_POST['id_gestion_estiercol_mms'];

 // Preparar la consulta SQL
$sql = "CALL Insert_Estiercoln2o(
    '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_sector', '$anio',
    '$numero_ficha', '$id_categoria_especie', '$id_especie', '$categoria_medicion',
    '$id_criterios_medicion', '$cantidad_especie', '$sigla', '$creado_por', '$estado', '$tasa_excrecion', '$masa_animal', 
    '$fraccion_excrecion','$factor_emisiones_directas', '$id_gestion_estiercol_mms')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error ID Ya Existente</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Algunos Campos Estan Vacios</div>';
        }
    }

    mysqli_close($conexion);
}
?>
