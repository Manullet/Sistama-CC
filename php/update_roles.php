<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $Id_rol = $_POST["Id_rol"];
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];
    $STATUS = $_POST["STATUS"];
    


    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateRole('$Id_rol', '$Nombre', '$Descripcion','$STATUS')";

    if (mysqli_query($conexion, $sql)) {
<<<<<<< Updated upstream
        header("Location: ../vistas/Mantenimiento_roles.php?success=true&message=El rol se actualizó correctamente");
=======
<<<<<<< HEAD
        header("Location: ../bienvenida.php?success=true&message=El rol se actualizó correctamente");
=======
        header("Location: ../vistas/Mantenimiento_roles.php?success=true&message=El rol se actualizó correctamente");
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al actualizar el rol: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>



