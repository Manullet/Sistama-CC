<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_suelos_indirectos_b = $_POST["id_suelos_indirectos_b"]; 
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $id_sector = $_POST["id_sector"];
    $id_suelos_indirectos = $_POST["id_suelos_indirectos"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $descripcion = $_POST["descripcion"];
    $codigo_categoria = $_POST["codigo_categoria"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $anio = $_POST["anio"];
    $cantidad_anual_n = $_POST["cantidad_anual_n"];
    $fraccion_n = $_POST["fraccion_n"];
    $factor_emision = $_POST["factor_emision"];
    $cantidad_animal = $_POST["cantidad_animal"];
    $cantidad_orina = $_POST["cantidad_orina"];
    $fraccion_materiales = $_POST["fraccion_materiales"];
    $cantidad_residuos = $_POST["cantidad_residuos"];
    $cantidad_mineralizado = $_POST["cantidad_mineralizado"];
    $fraccion_mineralizado = $_POST["fraccion_mineralizado"];
    $fraccion_lixiviacion = $_POST["fraccion_lixiviacion"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL update_suelos_indirectos_reporte('$id_suelos_indirectos_b', '$id_ficha', '$id_categoria_ficha', '$id_sector','$id_suelos_indirectos', 
    '$id_criterios_medicion', '$descripcion', '$codigo_categoria', '$categoria_medicion' ,'$hoja', '$referencia', '$anio', '$cantidad_anual_n', 
    '$fraccion_n', '$factor_emision', '$cantidad_animal', '$cantidad_orina', '$fraccion_materiales', '$cantidad_residuos', '$cantidad_mineralizado', '$fraccion_mineralizado', '$fraccion_lixiviacion' ,'$actualizado_por', '$estado' )";

    if (mysqli_query($conexion, $sql)) {
        ob_end_flush(); 
        echo "success"; 
    } else {
        ob_end_clean(); 
        echo "Error al actualizar el Registro: " . mysqli_error($conexion);
    }




    mysqli_close($conexion);
}
?>
