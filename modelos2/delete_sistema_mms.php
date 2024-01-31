<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene el valor del formulario
    $id_sistema = $_POST["id_sistema"];

    // Llama al procedimiento almacenado
    $sql = "CALL EliminarSistemaMMS('$id_sistema')";

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