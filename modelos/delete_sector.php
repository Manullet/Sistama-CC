<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_sector"])) {
    $id_sector = $_POST["id_sector"];

    $delete_query = "DELETE FROM tbl_sector WHERE id_sector = '$id_sector'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El Sector se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar el sector");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("El sector está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas/Mantenimiento_permisos.php");
    exit();
}
?>
?>
