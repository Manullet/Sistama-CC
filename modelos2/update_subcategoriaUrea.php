<?php
include '../php/conexion_be.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_subcategoria_urea = $_POST["id_subcategoria_urea"];
    $categoria_urea = $_POST["categoria_urea"];
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL UpdateSub_urea('$id_subcategoria_urea', '$categoria_urea', '$descripcion', '$actualizado_por', '$estado')";

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
