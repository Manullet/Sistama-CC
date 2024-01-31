<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cultivo"])) {
    $id_cultivo = $_POST["id_cultivo"];

    $delete_query = "DELETE FROM tbl_categorias_cultivo WHERE id_cultivo = '$id_cultivo'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=El cultivo se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar el cultivo");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("El cultivo está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas2/tbl_categoria_cultivo.php");
    exit();
}
?>