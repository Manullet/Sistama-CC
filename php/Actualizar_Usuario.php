<?php
// Incluye el archivo de conexión a la base de datos
include 'conexion_be.php';

// Verifica si se ha enviado un formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $id = $_POST["id"];
    $nombre_completo = $_POST["nombre_completo"];
    $usuario = $_POST["usuario"];
    $correo = $_POST["correo"];
    $Estado = $_POST["Estado"];
  
    
    // Llama al procedimiento almacenado con 4 argumentos
    $sql = "CALL UpdateUsuario('$id', '$nombre_completo', '$usuario','$correo','$Estado')";

    if (mysqli_query($conexion, $sql)) {
      header("Location: ../bienvenida.php?success=true"); // Redirige a index.php con el parámetro success=true
      exit(); // Detiene la ejecución del script
  } else {
      echo "Error al actualizar el usuario: " . mysqli_error($conexion);
  }
  
    mysqli_close($conexion);
}
?>
