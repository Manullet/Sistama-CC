<?php
// Incluye el archivo de conexión a la base de datos
include '../php/conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $Id_Permisos = $_POST["Id_Permisos"]; 
<<<<<<< Updated upstream
    $Nombre = $_POST["Nombre"];
    $Nombre_Guard = $_POST["Nombre_Guard"];
    $Fecha_Actualizacion = $_POST["Fecha_Actualizacion"];
=======
<<<<<<< HEAD
    $permiso_eliminacion = $_POST["permiso_eliminacion"];
    $permiso_actualizacion = $_POST["permiso_actualizacion"];
    $permiso_consulta = $_POST["permiso_consulta"];
    $permiso_insercion = $_POST["permiso_insercion"];
    $Actualizado_Por = $_POST["Actualizado_Por"];
    $Estado = $_POST["Estado"];
=======
    $Nombre = $_POST["Nombre"];
    $Nombre_Guard = $_POST["Nombre_Guard"];
    $Fecha_Actualizacion = $_POST["Fecha_Actualizacion"];
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
    // Obtener la fecha y hora actual en el formato deseado (YYYY-MM-DD HH:MM:SS)
  //  $Fecha_Actualizacion = date("Y-m-d H:i:s");

    // Llama al procedimiento almacenado con 4 argumentos
<<<<<<< Updated upstream
    $sql = "CALL UpdatePermiso('$Id_Permisos','$Nombre', '$Nombre_Guard','$Fecha_Actualizacion')";
=======
<<<<<<< HEAD
    $sql = "CALL UpdatePermiso('$Id_Permisos','$permiso_eliminacion', '$permiso_actualizacion','$permiso_consulta','$permiso_insercion','$Actualizado_Por','$Estado')";
=======
    $sql = "CALL UpdatePermiso('$Id_Permisos','$Nombre', '$Nombre_Guard','$Fecha_Actualizacion')";
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes

    if (mysqli_query($conexion, $sql)) {
        header("Location: ../bienvenida.php?success=true&message=El Permiso se actualizó correctamente");
        exit(); // Detener la ejecución del script
    } else {
        echo "Error al actualizar el rol: " . mysqli_error($conexion);
    }
    mysqli_close($conexion);
}
?>
