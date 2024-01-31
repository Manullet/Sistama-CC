<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_gestionmms_estiercol.php';
 $_SESSION['content-wrapper'] = 'content-wrapper';
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/estilos.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<div class="containertable">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h1 class="poppins-font mb-2">Gestion MMS Estiercol</h1>
            <br>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Agregar Gestion
            </a>
        </div>

        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar Gestion..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="table-dark text-center" style="background-color: #343A40;">
                <tr>
                    <th scope="col">Id_Gestion</th>
                    <th scope="col">Id_Sector</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Especie</th>
                    <th scope="col">Gestion Estiercol</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("
                SELECT 
                    tbl_gestion_mms_estiercol.id_gestion_estiercol_mms,
                    tbl_sector.sector,
                    tbl_categorias_especies.categoria_especie,
                    tbl_especie.especie,
                    tbl_gestion_mms_estiercol.gestion_estiercol,
                    tbl_gestion_mms_estiercol.sigla,
                    tbl_gestion_mms_estiercol.descripcion,
                    tbl_gestion_mms_estiercol.creado_por,
                    tbl_gestion_mms_estiercol.fecha_creacion,
                    tbl_gestion_mms_estiercol.actualizado_por,
                    tbl_gestion_mms_estiercol.fecha_actualizacion,
                    tbl_gestion_mms_estiercol.estado
                FROM tbl_gestion_mms_estiercol
                INNER JOIN tbl_sector ON tbl_gestion_mms_estiercol.id_sector = tbl_sector.id_sector
                INNER JOIN tbl_categorias_especies ON tbl_gestion_mms_estiercol.id_categoria_especie = tbl_categorias_especies.id_categoria_especie
                INNER JOIN tbl_especie ON tbl_gestion_mms_estiercol.id_especie = tbl_especie.id_especie
            ");
            
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_gestion_estiercol_mms ?></td>
                        <td><?= $datos->sector ?></td>
                        <td><?= $datos->categoria_especie ?></td>
                        <td><?= $datos->especie?></td>
                        <td><?= $datos->gestion_estiercol?></td>
                        <td><?= $datos->sigla?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?= $datos->creado_por?></td>
                        <td><?= $datos->fecha_creacion ?></td>
                        <td><?= $datos->actualizado_por?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_gestion_estiercol_mms ?>', '<?= $datos->sector ?>', '<?= $datos->categoria_especie ?>',
                        '<?= $datos->especie ?>', '<?= $datos->gestion_estiercol ?>', '<?= $datos->sigla ?>', '<?= $datos->descripcion ?>', 
                        '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>', '<?= $datos->fecha_actualizacion ?>', 
                        '<?= $datos->estado ?>')">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos2\delete_gestion_estiercol_mms.php" style="display: inline;">
                                <input type="hidden" name="id_gestion_estiercol_mms" value="<?= $datos->id_gestion_estiercol_mms ?>">
                                <button type="submit" class="btn btn-eliminar">
                                    <i class="bi bi-trash"></i>
                                    Eliminar
                                </button>
                            </form>
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

<!-- Modal para editar gestion -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">EDITAR GESTION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioEditar" method="POST" action="modelos2\update_gestion_estiercol_mms.php">

                <div class="form-group" style="display: none;">
                        <label for="id_gestion_estiercol_mms">ID Gestion</label>
                        <input type="text" class="form-control" id="id_gestion_estiercol_mms" name="id_gestion_estiercol_mms" readonly>
                    </div>
                    <div class="form-group">
                            <label for="id_sector">Sector:</label>
                            <select class="form-control" id="sector" name="id_sector" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_sector , sector FROM tbl_sector";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay sectores disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="id_categoria_especie">Categoria Especie:</label>
                            <select class="form-control" id="categoria_especie" name="id_categoria_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_categoria_especie , categoria_especie FROM tbl_categorias_especies";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_categoria_especie"] . '">' . $row["categoria_especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Categorias disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_especie">Especie:</label>
                            <select class="form-control" id="especie" name="id_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_especie , especie FROM tbl_especie";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_especie"] . '">' . $row["especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Especies disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gestion_estiercol">Gestion Estiercol:</label>
                            <input type="text" class="form-control" id="gestion_estiercol" name="gestion_estiercol" required>
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla:</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
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

<!-- Modal para crear gestion-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" role="document">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">Gestion </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <form method="POST" action="modelos2\agregar_gestion_estiercol_mms.php">
                        <div class="form-group">
                            <label for="id_sector">Sector:</label>
                            <select class="form-control" id="id_sector" name="id_sector" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_sector , sector FROM tbl_sector";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_sector"] . '">' . $row["sector"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay sectores disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
 
                        <div class="form-group">
                            <label for="id_categoria_especie">Id Categoria Especie:</label>
                            <select class="form-control" id="id_categoria_especie" name="id_categoria_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_categoria_especie , categoria_especie FROM tbl_categorias_especies";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_categoria_especie"] . '">' . $row["categoria_especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Categorias disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_especie">Especie:</label>
                            <select class="form-control" id="id_especie" name="id_especie" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_especie , especie FROM tbl_especie";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_especie"] . '">' . $row["especie"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay Especies disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="gestion_estiercol">Gestion Estiercol:</label>
                            <input type="text" class="form-control" id="gestion_estiercol" name="gestion_estiercol" required>
                        </div>
                        <div class="form-group">
                            <label for="sigla">Sigla:</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado:</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function abrirModalEditar(id_gestion_estiercol_mms,sector,categoria_especie,especie,gestion_estiercol,sigla, descripcion, creado_por, fecha_creacion, modificado_por, fecha_actualizacion, estado) {
    document.getElementById("id_gestion_estiercol_mms").value = id_gestion_estiercol_mms;
    document.getElementById("id_sector").value = sector;
    document.getElementById("id_categoria_especie").value = categoria_especie;
    document.getElementById("id_especie").value = especie;
    document.getElementById("gestion_estiercol").value = gestion_estiercol;
    document.getElementById("sigla").value = sigla;
    document.getElementById("descripcion").value = descripcion;
    document.getElementById("creado_por").value = creado_por;
    document.getElementById("fecha_creacion").value = fecha_creacion;
    document.getElementById("modificado_por").value = modificado_por;
    document.getElementById("fecha_modificacion").value = fecha_modificacion;
    document.getElementById("estado").value = estado;
    $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>

<!--------------------------------------------------------------------------------------
---------------------------------ALERTAS----------------------------------------------
---------------------------------------------------------------------------------------->

<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos2/update_gestion_estiercol_mms.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                            title: "Error",
                            text: "Hubo un problema al actualizar.",
                            icon: "error",
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            location.reload(); // Recarga la página
                        });
                    } else {
                        Swal.fire({
                            title: "Actualizado correctamente",
                            text: "se ha actualizado correctamente.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            $("#modalEditar").modal("hide");
                            location.reload(); // Recarga la página
                        });
                    }
                }
            });
        });
    });
</script>

<!-- Script para mostrar el mensaje al momento de eliminar un usuario-->
<script>
    $(document).ready(function() {
        $("form#deleteForm").on("submit", function(event) {
            event.preventDefault();

            var form = $(this);

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción eliminará la gestion. Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then(function(result) {
                if (result.isConfirmed) {
                    $.ajax({
                        url: form.attr("action"),
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            if (response == "success") {

                                Swal.fire({
                                    title: "Error",
                                    text: "Hubo un problema al eliminar.",
                                    icon: "error",
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                                
                            } else {
                                Swal.fire({
                                    title: "Eliminado correctamente",
                                    text: "Se ha eliminado correctamente.",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            }
                        }
                    });
                }
            });
        });
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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

<script>
    $(document).ready(function() {
        $('.table').DataTable({
            "lengthChange": false,
            "pageLength": 10
        });
    });
</script>