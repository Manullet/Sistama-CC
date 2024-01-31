<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';
session_start();

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $descripcion = $_POST["descripcion"];
    $creado_por = $_SESSION["usuario"] ['usuario'];
    $fecha_entrevista = $_POST["fecha_entrevista"];
    $nombre_encuentador = $_POST["nombre_encuentador"];
    $firma_productor = $_POST["firma_productor"];
    $nombre_encuestador = $_POST["nombre_encuestador"];
    $firma_encuestador = $_POST["firma_encuestador"];
    $nombre_supervisor = $_POST["nombre_supervisor"];
    $firma_supervisor = $_POST["firma_supervisor"];
    $estado = $_POST["estado"];
  /*  $Fecha_Creacion = $_POST["Fecha_Creacion"];
    $Fecha_Actualizacion = $_POST["Fecha_Actualizacion"]; */

    // Llama al procedimiento almacenado
    $sql = "CALL InsertFicha('$descripcion', '$creado_por', '$fecha_entrevista' ,'$nombre_encuentador', '$firma_productor', '$nombre_encuestador', '$firma_encuestador', '$nombre_supervisor', '$firma_supervisor', '$estado' )";



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