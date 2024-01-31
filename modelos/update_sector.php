<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_sector = $_POST["id_sector"]; 
    $sector = $_POST["sector"];
    $descripcion = $_POST["descripcion"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateSector('$id_sector','$sector', '$descripcion','$actualizado_por','$estado')";

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
