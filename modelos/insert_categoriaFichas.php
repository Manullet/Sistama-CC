<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id_sector = $_POST["id_sector"];
    $id_ficha = $_POST["id_ficha"];
    $categoria_ficha = $_POST["categoria_ficha"];
    $codigo_categoriaficha = $_POST["codigo_categoriaficha"];
    $descripcion = $_POST["descripcion"];
    $hoja = $_POST["hoja"];
    $referencia = $_POST["referencia"];
    $formula = $_POST["formula"];
    $creado_por = $_SESSION["usuario"] ['usuario'];
    $estado = $_POST["estado"];
  /*  $Fecha_Creacion = $_POST["Fecha_Creacion"];
    $Fecha_Actualizacion = $_POST["Fecha_Actualizacion"]; */

    // Llama al procedimiento almacenado
    $sql = "CALL InsertCategoria_Ficha('$id_sector', '$id_ficha', '$categoria_ficha' ,'$codigo_categoriaficha', '$descripcion', '$hoja', '$referencia', '$formula', '$creado_por', '$estado' )";

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