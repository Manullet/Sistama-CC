<?php

session_start();
if (isset($_SESSION['usuario'])) {
    header("location: bienvenida.php");
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
<<<<<<< Updated upstream
<meta charset="UTF-8" />
=======
<<<<<<< HEAD
    <meta charset="UTF-8" />
=======
<meta charset="UTF-8" />
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
    <link rel="icon" type="image/x-icon" href="/assets/logo-vt.svg" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" />

    <style>
        .custom-info-bg-color {
            background-color: #52C6DA !important;
        }

        .custom-info-text-color {
            color: #52C6DA !important;
        }
    </style>
<<<<<<< Updated upstream
</head>
=======
<<<<<<< HEAD

</head>

=======
</head>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
<body style="background-color: #e0e2e5;" class="d-flex justify-content-center align-items-center vh-100">
    <div class="bg-white p-5 rounded-5 text-secondary shadow" style="width: 25rem">
        <div class="d-flex justify-content-center">
            <img src="./assets/images/Recurso 3.png" alt="login-icon" style="height: 7rem" />
        </div>
        <br>
<<<<<<< Updated upstream
        <form action="../Sistema-CC/php/login_usuario_be.php" method="post">
=======
<<<<<<< HEAD
        <form action="../Sistema-AF/php/login_usuario_be.php" method="post">
=======
        <form action="../Sistema-CC/php/login_usuario_be.php" method="post">
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
            <h1 class="text-center fs-1 fw-bold"></h1>
            <div class="input-group mt-4">
                <div class="input-group-text custom-info-bg-color">
                    <img src="./assets/images/username-icon.svg" alt="username-icon" style="height: 1rem" />
                </div>
                <input class="form-control bg-light" type="text" placeholder="Usuario" name="correo" />
            </div>
            <div class="input-group mt-1">
                <div class="input-group-text custom-info-bg-color">
                    <img src="./assets/images/password-icon.svg" alt="password-icon" style="height: 1rem" />
                </div>
                <input class="form-control bg-light" type="password" placeholder="Contraseña" name="contrasena" />
            </div>
            <div class="d-flex justify-content-between mt-1">
                <div class="d-flex align-items-center gap-1">
                    <input class="form-check-input" type="checkbox" />
                    <div class="pt-1" style="font-size: 0.9rem">Recordar Usuario</div>
                </div>
                <div class="pt-1">
<<<<<<< Updated upstream
                    <a href="../Sistema-CC/modelos/cambio_contrasena_respuesta_S.php" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">¿Olvidaste tu contraseña?</a>
=======
<<<<<<< HEAD
                    <a href="../Sistema-AF/modelos/cambio_contrasena_respuesta_S.php" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">¿Olvidaste tu contraseña?</a>
=======
                    <a href="../Sistema-CC/modelos/cambio_contrasena_respuesta_S.php" class="text-decoration-none text-info fw-semibold fst-italic" style="font-size: 0.9rem">¿Olvidaste tu contraseña?</a>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                </div>
            </div>
            <button type="submit" class="btn custom-info-bg-color text-white w-100 mt-4 fw-semibold shadow-sm">INGRESAR</button>
            <div class="d-flex gap-1 justify-content-center mt-1">
                <div>¿No tienes una cuenta?</div>
<<<<<<< Updated upstream
                <a href="crearUsuario.php" class="text-decoration-none text-info fw-semibold">Registrate</a>
=======
<<<<<<< HEAD
                <a href="../SISTEMA-AF/crearUsuario.php" class="text-decoration-none text-info fw-semibold">Registrate</a>
=======
                <a href="crearUsuario.php" class="text-decoration-none text-info fw-semibold">Registrate</a>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
            </div>
        </form>
    </div>
</body>

</html>