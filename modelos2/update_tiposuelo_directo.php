<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();
// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_suelo_directo = $_POST["id_suelo_directo"];
    $nombre_suelo = $_POST["nombre_suelo"];
    $id_sector = $_POST["id_sector"];
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
   
   

    // Llama al procedimiento almacenado con 7 argumentos
    $sql = "CALL UpdateTipoSuelo('$id_suelo_directo','$nombre_suelo','$id_sector', '$descripcion', '$actualizado_por',  '$estado')";


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