<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_ficha"])) {
    $id_ficha = $_POST["id_ficha"];

    $delete_query = "DELETE FROM tbl_fichas WHERE id_ficha = '$id_ficha'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El Registro se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al registro el sector");
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
