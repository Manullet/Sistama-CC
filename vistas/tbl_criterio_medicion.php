<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_criterio_medicion.php';
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
            <h1 class="poppins-font mb-2">CRITERIO DE MEDICIÓN</h1>
            <br>
            <a href="#" data-bs-toggle="modal" data-bs-target="#modalForm" class="btn btn-info">
                <i class="nav-icon bi bi-people-fill"></i> Crear
            </a>
        </div>

        <div class="mb-4 border-bottom">
            <form class="d-flex" role="search">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchInput" type="search" placeholder="Buscar ..." aria-label="Search">
                </div>
            </form>
        </div>
    </div>

     <!--  descargar excel -->
     <div class="center-vertical">
            </div>
            <!--  fin de descargar -->

             <!-- descargar PDF-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

            <script>
                document.getElementById("pdfButton").addEventListener("click", function() {
                    // Código para generar el PDF usando jsPDF
                    const pdf = new jsPDF();
                    pdf.text("Contenido del PDF", 10, 10);
                    pdf.save("documento.pdf");
                });
            </script>
             <!--  fin de descargar PDF-->

                 <!-- descargar EXCEL -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.8/xlsx.full.min.js"></script>

                <script>
                    document.getElementById("excelButton").addEventListener("click", function() {
                        // Código para generar el archivo Excel usando SheetJS
                        const data = [
                            ["Nombre", "Edad"],
                            ["Juan", 30],
                            ["María", 25],
                            ["Pedro", 28]
                        ];
                        const ws = XLSX.utils.aoa_to_sheet(data);
                        const wb = XLSX.utils.book_new();
                        XLSX.utils.book_append_sheet(wb, ws, "Hoja1");
                        XLSX.writeFile(wb, "datos.xlsx");
                    });
                </script>

                  <!-- Fin descargar EXCEL-->



    <div class="table-responsive">

        <table class="table table-hover">
            <thead class="table-dark text-center" style="background-color: #343A40;">
                <tr>
                    
                    <th scope="col">Id Criterio de Medición</th>
                    <th scope="col">Criterio Medicion</th>
                    <th scope="col">Nivel Medicion</th>
                    <th scope="col">Categoria Ficha</th>
                    <th scope="col">Unidad Medicion</th>
                    <th scope="col">Encabezado Segun Categoria</th>
                    <th scope="col">Sigla</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th> 

                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_criterio_medicion.id_criterios_medicion, tbl_criterio_medicion.criterio_medicion, tbl_criterio_medicion.nivel_medicion, tbl_categorias_fichas.categoria_ficha, tbl_criterio_medicion.unidad_medicion, tbl_criterio_medicion.encabezado_segun_categoria, tbl_criterio_medicion.sigla, tbl_criterio_medicion.descripcion, tbl_criterio_medicion.estado 
                FROM tbl_criterio_medicion INNER JOIN tbl_categorias_fichas ON tbl_criterio_medicion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_criterios_medicion?></td>
                        <td><?= $datos->criterio_medicion?></td>
                        <td><?= $datos->nivel_medicion?></td>
                        <td><?= $datos->categoria_ficha?></td>
                        <td><?= $datos->unidad_medicion?></td>
                        <td><?= $datos->encabezado_segun_categoria?></td>
                        <td><?= $datos->sigla?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_criterios_medicion ?>', '<?= $datos->criterio_medicion ?>', '<?= $datos->nivel_medicion ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->unidad_medicion ?>', '<?= $datos->encabezado_segun_categoria ?>', '<?= $datos->sigla ?>', '<?= $datos->descripcion ?>', '<?= $datos->modificado_por ?>', '<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_criterios_med.php" style="display: inline;">
                                <input type="hidden" name="id_criterios_medicion" value="<?= $datos->id_criterios_medicion ?>">
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

<!-- Modal para editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">EDITAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formularioEditar" method="POST" action="modelos/update_criterio_med.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_criterios_medicion">ID Criterio de Medicion</label>
                                <input type="text" class="form-control" id="id_criterios_medicion" name="id_criterios_medicion" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="criterio_medicion_edit">Criterio de Medicion</label>
                                <input type="text" class="form-control" id="criterio_medicion_edit" name="criterio_medicion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nivel_medicion_edit">Nivel de Medicion </label>
                                <input type="text" class="form-control" id="nivel_medicion_edit" name="nivel_medicion" required>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">    
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_categoria_ficha_edit">Categoria de ficha:</label>
                                <select class="form-control" id="id_categoria_ficha_edit" name="id_categoria_ficha" required>
                                    <?php
                                    // Conexión a la base de datos
                                    include '../php/conexion_be.php';

                                    // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                    $sql = "SELECT id_categoria_ficha,categoria_ficha FROM tbl_categorias_fichas";

                                    // Ejecutar la consulta
                                    $result = mysqli_query($conexion, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    // Genera opciones para cada valor de id_sector
                                    echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value="">No hay categorias de ficha disponibles</option>';
                                    }

                                    // Cierra la conexión a la base de datos
                                    mysqli_close($conexion);
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="criterio_medicion_edit">Criterio de Medicion</label>
                                <input type="text" class="form-control" id="criterio_medicion_edit" name="criterio_medicion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="unidad_medicion_edit">Unidad de Medicion</label>
                                <input type="text" class="form-control" id="unidad_medicion_edit" name="unidad_medicion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="encabezado_segun_categoria_edit">>Encabezado Segun Categoria</label>
                                <input type="text" class="form-control" id="encabezado_segun_categoria_edit" name="encabezado_segun_categoria" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="sigla_edit">Siglas </label>
                                <input type="text" class="form-control" id="sigla_edit" name="sigla" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion_edit" name="descripcion" rows="4"></textarea>
          </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="modificado_por_edit">Modificado Por</label>
                                <input type="text" class="form-control" id="modificado_por_edit" name="modificado_por" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado_edit">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                                <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" id="actualizarBtn">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para crear -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" role="document">
            <div class="modal-header" style="background-color: #17A2B8;">
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">CREAR CRITERIOS MEDICION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modelos/insert_criterio_med.php" method="POST">
                    <div class="row">
                        <div class="col-8">
                            <label for="criterio_medicion" class="form-label">Criterio de medicion</label>
                            <input type="text" class="form-control" id="criterio_medicion" name="criterio_medicion" required>
                        </div>
                        <div class="col-8">
                            <label for="nivel_medicion" class="form-label">Nivel de medicion</label>
                            <input type="text" class="form-control" id="nivel_medicion" name="nivel_medicion" required>
                        </div>
                        <div class="col-8">
                            <label for="id_categoria_ficha">Categoria de Ficha:</label>
                            <select class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" required>
                                <?php
                                // Conexión a la base de datos
                                include '../php/conexion_be.php';

                                // Consulta SQL para obtener los valores disponibles de id_sector desde tbl_sector
                                $sql = "SELECT id_categoria_ficha,categoria_ficha FROM tbl_categorias_fichas";

                                // Ejecutar la consulta
                                $result = mysqli_query($conexion, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                // Genera opciones para cada valor de id_sector
                                echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
                                }
                                } else {
                                echo '<option value="">No hay categorias de ficha disponibles</option>';
                                }

                                // Cierra la conexión a la base de datos
                                mysqli_close($conexion);
                                ?>
                            </select>
                        </div>
                        <div class="col-8">
                            <label for="criterio_medicion" class="form-label">Criterio de Medicion</label>
                            <input type="text" class="form-control" id="criterio_medicion" name="criterio_medicion" required>
                        </div>
                        <div class="col-8">
                            <label for="unidad_medicion" class="form-label">Unidad de medicion</label>
                            <input type="text" class="form-control" id="unidad_medicion" name="unidad_medicion" required>
                        </div>
                        <div class="col-8">
                            <label for="encabezado_segun_categoria" class="form-label">Encabezado segun categoria</label>
                            <input type="text" class="form-control" id="encabezado_segun_categoria" name="encabezado_segun_categoria" required>
                        </div>
                        <div class="col-8">
                            <label for="sigla" class="form-label">Sigla</label>
                            <input type="text" class="form-control" id="sigla" name="sigla" required>
                        </div>
                        <div class="col-8">
          <label for="descripcion" class="form-label">Descripción</label>
          <textarea class="form-control" id="descripcion" name="descripcion" rows="4"></textarea>
          </div>
                        <div class="col-8">
                            <label for="creado_por" class="form-label">Creado Por</label>
                            <input type="text" class="form-control" id="creado_por" name="creado_por" required>
                        </div>
                        <div class="col-8">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">Activo</option>
                                <option value="INACTIVO">Inactivo</option>
                            </select>
                        </div>
                    </div>
                 <br>
                    
                    <button type="submit" class="btn btn-success" name="btnnuevo" value="ok">Crear</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para manejar la edición de usuarios -->
<script>
    // Función para abrir el modal de edición
    function modalEditar(id_criterios_medicion, nivel_medicion, id_categoria_ficha, criterio_medicion, unidad_medicion, encabezado_segun_categoria, sigla, descripcion, modificado_por, estado) {
        document.getElementById("id_criterios_medicion").value = id_criterios_medicion;
        document.getElementById("nivel_medicion_edit").value = nivel_medicion;
        document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
        document.getElementById("criterio_medicion_edit").value = criterio_medicion;
        document.getElementById("unidad_medicion_edit").value = unidad_medicion;
        document.getElementById("encabezado_segun_categoria_edit").value = encabezado_segun_categoria;
        document.getElementById("sigla_edit").value = sigla;
        document.getElementById("descripcion_edit").value = descripcion;
        document.getElementById("modificado_por_edit").value = modificado_por;
        document.getElementById("estado_edit").value = estado;
        
        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>


<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos/update_criterio_med.php",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response == "success") {
                        Swal.fire({
                            title: "Registro actualizado correctamente",
                            text: "El Registro se ha actualizado correctamente.",
                            icon: "success",
                            showCancelButton: false,
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            $("#modalEditar").modal("hide");
                            location.reload(); // Recarga la página
                        });
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: "Hubo un problema al actualizar el registro.",
                            icon: "error",
                            confirmButtonText: "Cerrar"
                        }).then(function() {
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
                text: "Esta acción eliminará el periodo. Esta acción no se puede deshacer.",
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
                                    title: "Registro eliminado correctamente",
                                    text: "El Registro se ha eliminado correctamente.",
                                    icon: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "Cerrar"
                                }).then(function() {
                                    location.reload(); // Recarga la página
                                });
                            } else {
                                Swal.fire({
                                    title: "Error",
                                    text: "Hubo un problema al eliminar el Registro.",
                                    icon: "error",
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