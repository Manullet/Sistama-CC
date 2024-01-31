<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $criterio_medicion = $_POST["criterio_medicion"];
    $unidad_medicion = $_POST["unidad_medicion"];
    $encabezado_segun_categoria = $_POST["encabezado_segun_categoria"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $modificado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    
    // Llama al procedimiento almacenado con los nuevos valores
    $sql = "CALL ActualizarCriterioMedicion('$id_criterios_medicion', '$nivel_medicion', '$id_categoria_ficha', '$criterio_medicion', '$unidad_medicion', '$encabezado_segun_categoria', '$sigla', '$descripcion', '$modificado_por', '$estado')";
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
