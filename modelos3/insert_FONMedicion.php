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
    $id_gestion_estiercol_mms = $_POST["id_gestion_estiercol_mms"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $numero_ficha = $_POST["numero_ficha"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $cantidad_especie = $_POST["cantidad_especie"];
    $promedio_b = $_POST["promedio_b"];
    $fraccion_c = $_POST["fraccion_c"];
    $cantidad_nitrogeno_d = $_POST["cantidad_nitrogeno_d"];
    $cantidad_nitrogeno_e = $_POST["cantidad_nitrogeno_e"];
    $cantidad_nitrogeno_f = $_POST["cantidad_nitrogeno_f"];
    $creado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Llama al procedimiento almacenado
    $sql = "CALL Insert_FONMedicion( '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_sector', '$anio',
        '$id_gestion_estiercol_mms', '$id_categoria_especie', '$id_especie', '$id_criterios_medicion',
        '$numero_ficha', '$categoria_medicion', '$cantidad_especie', '$promedio_b', '$fraccion_c', 
        '$cantidad_nitrogeno_d', '$cantidad_nitrogeno_e', '$cantidad_nitrogeno_f' , '$creado_por', '$estado' )";

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
