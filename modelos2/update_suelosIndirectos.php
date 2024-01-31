<?php
include '../php/conexion_be.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_suelos_indirectos = $_POST["id_suelos_indirectos"];
    $nombre_suelo = $_POST["nombre_suelo"];
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateSuelosIndirectos('$id_suelos_indirectos', '$nombre_suelo', '$descripcion', '$actualizado_por', CURRENT_TIMESTAMP, '$estado')";

    if (mysqli_query($conexion, $sql)) {
        ob_end_flush();
        echo "success";
    } else {
        ob_end_clean();
        echo "Error al actualizar el Registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
