<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';

// Habilita la visualización de errores de PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $cantidad_especie = $_POST["cantidad_especie"];
    $sigla = $_POST["sigla"];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertarEstiercolN2O(
        '$id_ficha',
        '$id_categoria_ficha',
        '$nivel_medicion',
        '$id_sector',
        '$anio',
        '$numero_ficha',
        '$id_categoria_especie',
        '$id_especie',
        '$categoria_medicion',
        '$id_criterios_medicion',
        '$cantidad_especie',
        '$sigla',
        '$estado'
    )";

    // Mensajes de depuración
    echo "SQL: " . $sql . "<br>";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true&message=El Permiso se agregó correctamente");
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al agregar el registro: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
