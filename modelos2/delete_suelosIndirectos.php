<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene el valor del formulario
    $id_suelos_indirectos = $_POST["id_suelos_indirectos"];

    // Llama al procedimiento almacenado
    $sql = "CALL EliminarSuelosIndirectos('$id_suelos_indirectos')";

    // Mensajes de depuración
    echo "SQL: " . $sql . "<br>";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true&message=El registro se eliminó correctamente");
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>