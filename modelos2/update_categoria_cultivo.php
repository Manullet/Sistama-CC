<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_cultivo = $_POST["id_cultivo"];
    $cultivo = $_POST["cultivo"];
    $descripcion = $_POST["descripcion"];
    $modificado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    $id_ficha = $_POST["id_ficha"];
    $id_sector = $_POST["id_sector"];
    
    // Llama al procedimiento almacenado con los nuevos valores
    $sql = "CALL ActualizarCategoriaCultivo('$id_cultivo', '$cultivo', '$descripcion', '$modificado_por', '$estado', '$id_ficha', '$id_sector')";
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