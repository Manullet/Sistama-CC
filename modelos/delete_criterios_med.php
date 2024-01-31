<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_criterios_medicion"])) {
    $id_criterios_medicion = $_POST["id_criterios_medicion"];

    $delete_query = "DELETE FROM tbl_criterio_medicion WHERE id_criterios_medicion = '$id_criterios_medicion'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El criterio de medición se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar el criterio de medición");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("El criterio de medición está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas/tbl_criterio_medicion.php");
    exit();
}
?>
?>
