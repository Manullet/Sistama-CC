<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $cultivo = $_POST["cultivo"];
    $descripcion = $_POST["descripcion"];
    $creado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    $id_ficha = $_POST["id_ficha"];
    $id_sector = $_POST["id_sector"];
  

    // Llama al procedimiento almacenado
    $sql = "CALL InsertarCategoriaCultivo('$cultivo', '$descripcion', '$creado_por', '$estado', '$id_ficha', '$id_sector')";
    if (mysqli_query($conexion,$sql)) {
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

