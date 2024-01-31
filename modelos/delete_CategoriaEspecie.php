<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_categoria_especie"])) {
    $id_categoria_especie = $_POST["id_categoria_especie"];

    $delete_query = "DELETE FROM tbl_categorias_especies WHERE id_categoria_especie = '$id_categoria_especie'";
    
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
