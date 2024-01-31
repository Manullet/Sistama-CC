<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_fermentacion = $_POST["id_fermentacion"]; 
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $cantidad_especie = $_POST["cantidad_especie"];
    $descripcion = $_POST["descripcion"];
    $sigla = $_POST["sigla"];
    $actualizado_por = $_SESSION["usuario"] ['usuario'];
    $factor_fermentacion = $_POST["factor_fermentacion"];
    $factor_estiercol = $_POST["factor_estiercol"];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateFermentacion_Estiercol('$id_fermentacion','$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_sector', '$anio' ,'$id_categoria_especie', '$id_especie', '$categoria_medicion', '$id_criterios_medicion', '$cantidad_especie', '$descripcion', '$sigla', '$actualizado_por', '$factor_fermentacion', '$factor_estiercol','$estado'  )";

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
