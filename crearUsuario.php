<?php

    session_start();
    if(isset($_SESSION['usuario'])){
        header("location: index.php");

}

/*   session_start();
if(!isset($_SESSION['usuario'])) {
   header("Location:usuario.php");
}
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Formulario</title>
   <link rel="stylesheet" href="assets/css/crearUsuarioEstilos.css">
</head>
<body>

<<<<<<< Updated upstream
   <form action="/Sistema-CC/php/registro_usuario_be.php" method="post">
=======
<<<<<<< HEAD
   <form action="../SISTEMA-AF/php/registro_usuario_be.php" method="post">
=======
   <form action="/Sistema-CC/php/registro_usuario_be.php" method="post">
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
     <h2>CREAR USUARIO</h2>
     <input type="text" placeholder="Nombre completo" name="nombre_completo">
     <input type="text" placeholder="Correo Electronico" name="correo">
     <input type="text" placeholder="Usuario"name="usuario">
     <input type="password" placeholder="Contraseña"name="contrasena">
      <input type="submit" class="btn" value="Registrarse">

   </form>
   
</body>
</html>

