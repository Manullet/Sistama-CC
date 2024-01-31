<?php
include '../php/conexion_be.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $categoria_urea = $_POST["categoria_urea"];
    $id_sector = $_POST["id_sector"];
    $descripcion = $_POST["descripcion"];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertarSub_urea('$categoria_urea', $id_sector, '$descripcion', '$creado_por', '$estado')";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error ID Ya Existente</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Error al insertar el registro</div>';
        }
    }

    mysqli_close($conexion);
}
?>
