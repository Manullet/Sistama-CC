<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';

// Habilita la visualización de errores de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_sistema = $_POST["id_sistema"];
    $sistema = $_POST["sistema"];
    $formula = $_POST["formula"];
    $sigla = $_POST["sigla"];
    $definicion = $_POST["definicion"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertarSistemaMMS(
        '$id_sistema',
        '$sistema',
        '$formula',
        '$sigla',
        '$definicion'
    )";

    // Mensajes de depuración
    echo "SQL: " . $sql . "<br>";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true&message=El registro se agregó correctamente");
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al agregar el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
