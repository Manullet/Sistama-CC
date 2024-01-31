<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_estiercol = $_POST["id_estiercol"];
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $cantidad_especie = $_POST["cantidad_especie"];
    $sigla = $_POST["sigla"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    $tasa_excrecion = $_POST["tasa_excrecion"];
    $masa_animal = $_POST["masa_animal"];
    $fraccion_excrecion = $_POST["fraccion_excrecion"];
    $factor_emisiones_directas = $_POST["factor_emisiones_directas"];
    $id_gestion_estiercol_mms = $_POST["id_gestion_estiercol_mms"];

    // Llama al procedimiento almacenado con los nuevos valores
    $sql = "CALL Update_Estiercoln2o('$id_estiercol', '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', 
    '$id_sector', '$anio', '$numero_ficha', '$id_categoria_especie', '$id_especie', '$categoria_medicion', '$id_criterios_medicion',  '$cantidad_especie',
    '$sigla', '$actualizado_por', '$estado', '$tasa_excrecion', '$masa_animal', 
    '$fraccion_excrecion', '$factor_emisiones_directas' ,'$id_gestion_estiercol_mms')";

    if (mysqli_query($conexion, $sql)) {
        echo "success";
    } else {
        echo "Error al actualizar el Registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>

