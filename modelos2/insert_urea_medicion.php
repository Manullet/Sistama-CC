<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $id_sector = $_POST["id_sector"];
    $codigo_categoria = $_POST["codigo_categoria"];
    $referencia = $_POST["referencia"];
    $id_subcategoria_urea = $_POST["id_subcategoria_urea"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $fertilizacion_urea = $_POST["fertilizacion_urea"];
    $factor_urea = $_POST["factor_urea"];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertUrea_Medicion(
        '$id_ficha', '$id_categoria_ficha', '$id_sector', '$codigo_categoria', '$referencia',
        '$id_subcategoria_urea', '$anio', '$numero_ficha', '$id_criterios_medicion',
        '$sigla', '$descripcion', '$fertilizacion_urea', '$factor_urea', '$creado_por', '$estado')";

    if (mysqli_query($conexion, $sql)) {
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
