<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $Nombre = $_POST["Nombre"];
    $Descripcion = $_POST["Descripcion"];

    // Llama al procedimiento almacenado
    $sql = "CALL InsertRoles('$Nombre', '$Descripcion')";

    if (mysqli_query($conexion, $sql)) {
<<<<<<< Updated upstream
        header("Location: ../vistas/Mantenimiento_roles.php?success=true");
=======
<<<<<<< HEAD
        header("Location: ..\bienvenida.php?success=true");
=======
        header("Location: ../vistas/Mantenimiento_roles.php?success=true");
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
        exit(); // Detener la ejecución del script
    } else {
            echo "Error al insertar el nuevo rol: " . mysqli_error($conexion);
        }
    mysqli_close($conexion);
}
?>
