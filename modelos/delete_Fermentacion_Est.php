<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_fermentacion"])) {
    $id_fermentacion = $_POST["id_fermentacion"];

    $delete_query = "DELETE FROM tbl_fermentacion_estiercol WHERE id_fermentacion = '$id_fermentacion'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El registro se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar el registro");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("El registro está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas/Mantenimiento_permisos.php");
    exit();
}
?>
?>