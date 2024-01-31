<?php
include '../php/conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id_cultivos_medicion"])) {
    $id_cultivos_medicion = $_POST["id_cultivos_medicion"];

    $delete_query = "DELETE FROM tbl_cultivos_medicion WHERE id_cultivos_medicion = '$id_cultivos_medicion'";
    
    try {
        if (mysqli_query($conexion, $delete_query)) {
            header("Location: ../bienvenida.php?success=true&message=La Med. Cultivo se eliminó correctamente");
            exit();
        } else {
            throw new Exception("Hubo un error al eliminar la Med. Cultivo");
        }
    } catch (Exception $e) {
        echo '<script type="text/javascript">alert("La Med. Cultivo está siendo utilizado en otras partes del sistema"); </script>';
    }
} else {
    header("Location: ../vistas2/tbl_cultivos_medicion.php");
    exit();
}
?>

