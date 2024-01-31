<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_fprp_estiercol_medicion = $_POST["id_fprp_estiercol_medicion"]; 
    $id_ficha = $_POST["id_ficha"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_gestion_estiercol_FPRP = $_POST["id_gestion_estiercol_FPRP"];
    $id_sector = $_POST["id_sector"];
    $anio = $_POST["anio"];
    $numero_ficha = $_POST["numero_ficha"];
    $id_categoria_especie = $_POST["id_categoria_especie"];
    $id_especie = $_POST["id_especie"];
    $categoria_medicion = $_POST["categoria_medicion"];
    $id_criterios_medicion = $_POST["id_criterios_medicion"];
    $cantidad_especie = $_POST["cantidad_especie"];
    $promedio_anual_excrecion = $_POST["promedio_anual_excrecion"];
    $fraccion_excrecion_anual = $_POST["fraccion_excrecion_anual"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $descripcion = $_POST["descripcion"];
    $sigla = $_POST["sigla"];
    $actualizado_por = $_SESSION["usuario"]['usuario'];
    $estado = $_POST["estado"];

    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateFPRP_Medicion('$id_fprp_estiercol_medicion', '$id_ficha', '$id_categoria_ficha', '$nivel_medicion', '$id_gestion_estiercol_FPRP', '$id_sector',
    '$anio', '$numero_ficha', '$id_categoria_especie', '$id_especie',
    '$categoria_medicion', '$id_criterios_medicion', '$cantidad_especie', '$promedio_anual_excrecion', '$fraccion_excrecion_anual', '$hoja', '$referencia', 
    '$descripcion', '$sigla', '$actualizado_por', '$estado' )";

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
