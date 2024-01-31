<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_encalado_medicion = $_POST["id_encalado_medicion"]; 
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
    $actualizado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateEncalado_Medicion('$id_encalado_medicion', '$id_ficha', '$id_categoria_ficha','$nivel_medicion', '$id_tipo_cal', '$id_sector',
    '$anio', '$numero_ficha', '$id_criterios_medicion', '$sigla',
    '$descripcion', '$codigo_categoria', '$hoja', '$referencia', '$cantidad_anual_pc', '$factor_pc', '$cantidad_anual_dolomita', 
    '$factor_dolomita','$actualizado_por', '$estado' )";

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
