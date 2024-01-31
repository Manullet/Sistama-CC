<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_suelosDirectos_medicion = $_POST["id_suelosDirectos_medicion"]; 
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $id_sector = $_POST["id_sector"];
    $id_suelo_directo = $_POST["id_suelo_directo"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $codigo_categoria = $_POST["codigo_categoria"];
    $descripcion_suelo = $_POST["descripcion_suelo"];
    $sigla = $_POST["sigla"];
    $descripcion_medicion = $_POST["descripcion_medicion"];
    $cantidad_anual_n_formula = $_POST["cantidad_anual_n_formula"];
    $cantidad_anual_n_dato = $_POST["cantidad_anual_n_dato"];
    $factor_emision_formula = $_POST["factor_emision_formula"];
    $factor_emision_dato = $_POST["factor_emision_dato"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateSuelosDirectos_Medicion('$id_suelosDirectos_medicion', '$id_ficha', '$id_categoria_ficha','$id_sector','$id_suelo_directo', 
    '$anio', '$numero_ficha', '$id_criterios_medicion', '$codigo_categoria', '$descripcion_suelo', '$sigla', '$descripcion_medicion', 
    '$cantidad_anual_n_formula', '$cantidad_anual_n_dato', '$factor_emision_formula', '$factor_emision_dato' ,'$actualizado_por', '$estado' )";

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
