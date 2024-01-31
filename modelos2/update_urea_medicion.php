<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_urea_medicion = $_POST["id_urea_medicion"]; 
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $id_sector = $_POST["id_sector"];
    $codigo_categoria = $_POST["codigo_categoria"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $id_subcategoria_urea = $_POST["id_subcategoria_urea"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $fertilizacion_urea = $_POST["fertilizacion_urea"];
    $factor_urea = $_POST["factor_urea"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateUrea_Medicion('$id_urea_medicion', '$id_ficha', '$id_categoria_ficha','$id_sector','$codigo_categoria', '$hoja', '$referencia', '$id_subcategoria_urea', '$anio', '$numero_ficha', '$id_criterios_medicion', '$sigla', '$descripcion', '$fertilizacion_urea', '$factor_urea', '$actualizado_por', '$estado' )";

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
