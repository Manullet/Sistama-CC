<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/estilos.css">

<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">MANTENIMIENTO USUARIOS</h1>
            <br>
            <a href="php\crear.php" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Crear usuario
<<<<<<< Updated upstream
                
=======
<<<<<<< HEAD
=======
                
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
            </a>
        </div>

        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar usuarios..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="table-dark text-center" style="background-color: #343A40;">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
<<<<<<< Updated upstream
                    <th scope="col">Rol</th>
                    <th scope="col">Fecha Creación</th>
                    <th scope="col">Vencimiento</th>
=======
<<<<<<< HEAD

=======
                    <th scope="col">Rol</th>
                    <th scope="col">Fecha Creación</th>
                    <th scope="col">Vencimiento</th>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT * FROM usuario");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
                        <td><?= $datos->id ?></td>
                        <td><?= $datos-> nombre_completo ?></td>
                        <td><?= $datos-> usuario?></td>
                        <td><?= $datos-> correo ?></td>
                        <td><?= $datos->Estado ?></td>
                        <td>
                        <button class="btn btn-primary btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar('<?= $datos->id ?>', '<?= $datos->nombre_completo ?>', '<?= $datos->usuario ?>', '<?= $datos->correo ?>', '<?= $datos->Estado ?>')">Editar</button>
                                <form method="POST" action="../SISTEMA-AF/modelos/delete_usuario.php" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $datos->id ?>">
                                <button type="submit" class="btn btn-danger btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</button>
                                </form>

=======
>>>>>>> Stashed changes
                        <td><?= $datos->Nombre ?></td>
                        <td><?= $datos->Id_Usuario ?></td>
                        <td><?= $datos->Usuario ?></td>
                        <td><?= $datos->Correo ?></td>
                        <td><?= $datos->Estado ?></td>
                        <td>"Pendiente"</td>
                        <td>"Pendiente"</td>
                        <td>"Pendiente"</td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar()">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form method="POST" action="delete_usuario.php" style="display: inline;">
                                <!--<input type="hidden" name="id" value="<?= $row['id'] ?>">-->
                                <button type="button" class="btn btn-eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
<<<<<<< Updated upstream
=======
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                        </td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link">Anterior</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Siguiente</a>
            </li>
        </ul>
    </nav>
</div>

<!-- Modal para editar usuarios -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<<<<<<< Updated upstream
                <form id="formularioEditar" method="POST" action="Actualizar_Usuario.php">
=======
<<<<<<< HEAD
                <form id="formularioEditar" method="POST" action="php/Actualizar_Usuario.php">
=======
                <form id="formularioEditar" method="POST" action="Actualizar_Usuario.php">
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                    <div class="form-group">
                        <label for="id">ID del usuario:</label>
                        <input type="text" class="form-control" id="id" name="id" readonly>
                    </div>
                    <div class="form-group">
<<<<<<< Updated upstream
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
=======
<<<<<<< HEAD
                        <label for="nombre_completo">Nombre:</label>
                        <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" required>
=======
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                    </div>
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="form-group">
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
                        <label for="contraseña">Contraseña:</label>
                        <input type="text" class="form-control" id="contraseña" name="contraseña" required>
                    </div>
                    <div class="form-group">
<<<<<<< Updated upstream
=======
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                        <label for="correo">Correo:</label>
                        <input type="text" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
<<<<<<< Updated upstream
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" required>
=======
<<<<<<< HEAD
                        <label for="Estado">Estado:</label>
                        <input type="text" class="form-control" id="Estado" name="Estado" required>
=======
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" required>
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de éxito -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Usuario actualizado correctamente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>El usuario se ha actualizado correctamente.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <a href="index.php" class="btn btn-primary">Ir a la página principal</a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
<<<<<<< Updated upstream
=======
<<<<<<< HEAD
    function abrirModalEditar(id, nombre_completo, usuario, correo, Estado) {
        document.getElementById("id").value = id;
        document.getElementById("nombre_completo").value = nombre_completo;
        document.getElementById("usuario").value = usuario;
        document.getElementById("correo").value = correo;
        document.getElementById("Estado").value = Estado;
=======
>>>>>>> Stashed changes
    function abrirModalEditar(id, nombre, usuario, contraseña, correo, estado) {
        document.getElementById("id").value = id;
        document.getElementById("nombre").value = nombre;
        document.getElementById("usuario").value = usuario;
        document.getElementById("contraseña").value = contraseña;
        document.getElementById("correo").value = correo;
        document.getElementById("estado").value = estado;
<<<<<<< Updated upstream
=======
>>>>>>> 53bc7ead2f5e77e0ad7d460e8d45ab69de85d577
>>>>>>> Stashed changes

        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>

<!-- Código JavaScript para mostrar el modal de éxito después de actualizar -->
<?php
if (isset($_GET['success']) && $_GET['success'] === 'true') {
    echo '<script>
                    $(document).ready(function(){
                        $("#myModal").modal("show");
                    });
                  </script>';
}
?>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $(".table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>