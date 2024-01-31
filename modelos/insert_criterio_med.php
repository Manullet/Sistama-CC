<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $nivel_medicion = $_POST["nivel_medicion"];
    $id_categoria_ficha = $_POST["id_categoria_ficha"];
    $criterio_medicion = $_POST["criterio_medicion"];
    $unidad_medicion = $_POST["unidad_medicion"];
    $encabezado_segun_categoria = $_POST["encabezado_segun_categoria"];
    $sigla = $_POST["sigla"];
    $descripcion = $_POST["descripcion"];
    $creado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
  

    // Llama al procedimiento almacenado
    $sql = "CALL InsertCriterioMedicion('$nivel_medicion', '$id_categoria_ficha', '$criterio_medicion', '$unidad_medicion', '$encabezado_segun_categoria', '$sigla', '$descripcion', '$creado_por', '$estado')";
    if (mysqli_query($conexion,$sql)) {
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
