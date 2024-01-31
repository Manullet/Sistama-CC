<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();
// Habilita la visualización de errores de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_gestion_estiercol_mms = $_POST["id_gestion_estiercol_mms"];
    $id_sector = $_POST["id_sector"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $gestion_estiercol = $_POST["gestion_estiercol"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL UpdateGestionMMS(
        '$id_gestion_estiercol_mms',
        '$id_sector',
        '$id_categoria_especie',
        '$id_especie',
        '$gestion_estiercol',
        '$sigla',
        '$descripcion',
        '$actualizado_por',
        '$estado'
    )";

    // Mensajes de depuración
    echo "SQL: " . $sql . "<br>";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true&message=El registro se actualizó correctamente");
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al actualizar el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
