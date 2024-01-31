<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_ficha = $_POST["id_ficha"]; 
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $nombre_encuentador = $_POST["nombre_encuentador"];
    $estado = $_POST["estado"];
    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateFicha('$id_ficha','$descripcion', '$actualizado_por','$nombre_encuentador','$estado')";

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
