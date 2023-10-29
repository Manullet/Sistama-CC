<?php

include "../php/conexion_be.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_completo=$_POST["nombre_completo"];
    $correo=$_POST["correo"];
    $usuario=$_POST["usuario"];
    $contrasena=$_POST["contrasena"];
 


    $sql = "CALL InsertUsuario('$nombre_completo', '$correo', '$usuario', '$contrasena')";

    if (mysqli_query($conexion,$sql)) {
        header("Location: ../bienvenida.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error ID Ya Existente</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Algunos Campos Estan Vacios</div>';
        }
        
    }
    
    mysqli_close($conexion);
}

?>