<?php
include '../php/conexion_be.php';

// Verifica si se ha enviado un formulario y si se proporcionó un ID de objeto válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_suelo_directo"])) {
    // Obtiene el ID de tipo suelo desde el formulario
    $id_suelo_directo = $_POST["id_suelo_directo"];

    // Crea una consulta SQL para eliminar el tipo suelo con el ID proporcionado
    $sql = "DELETE FROM tbl_tipos_suelos_directos WHERE id_suelo_directo = '$id_suelo_directo'";
    
    if (mysqli_query($conexion, $sql)) {
        // Éxito en la eliminación
        header("Location: ../bienvenida.php?success=true&message=Tipo suelo se eliminó correctamente");
        exit();
    } else {
        // Error en la eliminación
        header("Location: ../bienvenida.php?success=false&message=Hubo un error al eliminar Tipo suelo");
        exit();
    }
} else {
    // Si no se proporcionó un ID de objeto válido o no se envió un formulario, redirige a la página pregunta.php
    header("Location: ../bienvenida.php");
    exit();
}
?>