<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_suelosDirectos_medicion"])) {
    $id_suelosDirectos_medicion = $_POST["id_suelosDirectos_medicion"];

    $delete_query = "DELETE FROM tbl_suelosdirectos_medicion WHERE id_suelosDirectos_medicion = '$id_suelosDirectos_medicion'";
    
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