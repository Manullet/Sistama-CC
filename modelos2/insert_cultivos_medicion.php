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
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_cultivo = $_POST["id_cultivo"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $total = $_POST["total"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $tipo_superficie = $_POST["tipo_superficie"];
    $masa_combustible = $_POST["masa_combustible"];
    $factor_combustion = $_POST["factor_combustion"];
    $factor_emision_ch = $_POST["factor_emision_ch"];
    $factor_emision_co = $_POST["factor_emision_co"];
    $factor_emision_n2o = $_POST["factor_emision_n2o"];
    $factor_emision_nox = $_POST["factor_emision_nox"];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertCultivoMedicion(
        '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_sector', '$anio',
        '$numero_ficha', '$id_cultivo', '$id_criterios_medicion', '$total', '$sigla',
        '$descripcion', '$tipo_superficie', '$masa_combustible', '$factor_combustion', '$factor_emision_ch',
        '$factor_emision_co', '$factor_emision_n2o', '$factor_emision_nox' ,'$creado_por', '$estado'
    )";

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error ID Ya Existente</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Algunos Campos Están Vacíos o Contienen Datos Incorrectos</div>';
        }
    }

    mysqli_close($conexion);
}
?>
