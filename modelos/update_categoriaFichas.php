<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_categoria_ficha = $_POST["id_categoria_ficha"]; 
    $id_sector = $_POST["id_sector"]; 
    $categoria_ficha = $_POST["categoria_ficha"];
    $codigo_categoriaficha = $_POST["codigo_categoriaficha"];
    $descripcion = $_POST["descripcion"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $formula = $_POST["formula"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateCategoria_Ficha('$id_categoria_ficha','$id_sector','$categoria_ficha', '$codigo_categoriaficha','$descripcion','$hoja', '$referencia', '$formula', '$actualizado_por', '$estado' )";

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
