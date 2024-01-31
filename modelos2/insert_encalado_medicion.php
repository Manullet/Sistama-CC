<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_tipo_cal = $_POST["id_tipo_cal"];
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $codigo_categoria = $_POST["codigo_categoria"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $cantidad_anual_pc = $_POST["cantidad_anual_pc"];
    $factor_pc = $_POST["factor_pc"];
    $cantidad_anual_dolomita = $_POST["cantidad_anual_dolomita"];
    $factor_dolomita = $_POST["factor_dolomita"];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertEncalado_Medicion(
        '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_tipo_cal', '$id_sector',
        '$anio', '$numero_ficha', '$id_criterios_medicion', '$sigla',
        '$descripcion', '$codigo_categoria', '$hoja', '$referencia', '$cantidad_anual_pc', '$factor_pc', '$cantidad_anual_dolomita', 
        '$factor_dolomita','$creado_por', '$estado')";

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
