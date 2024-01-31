<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_tipo_cal"])) {
    $id_tipo_cal = $_POST["id_tipo_cal"];

    $delete_query = "DELETE FROM tbl_tipos_cal WHERE id_tipo_cal = '$id_tipo_cal'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El tipo de cal se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar el Tipo de Cal");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("El Tipo de Cal está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas2/tbl_tipos_cal.php");
    exit();
}
?>
?>
