<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();
// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $tipo_cal = $_POST["tipo_cal"];
    $id_sector = $_POST["id_sector"];
    $descripcion = $_POST["descripcion"];
    $creado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
  

    // Llama al procedimiento almacenado
    $sql = "CALL InsertarTipoCal('$tipo_cal', '$id_sector', '$descripcion', '$creado_por', '$estado')";

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
