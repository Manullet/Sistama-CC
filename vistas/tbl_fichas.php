<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_fichas.php';
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
            <h1 class="poppins-font mb-2">Fichas</h1>
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
                <th scope="col">Id_Ficha</th>
                    <th scope="col">Fecha Solicitud</th>
                    <th scope="col">Año Solicitud</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Creado Por</th>
                    <th scope="col">Fecha Creacion</th>
                    <th scope="col">Actualizado Por</th>
                    <th scope="col">Fecha Actualizacion</th>
                    <th scope="col">Fecha Entrevista</th>
                    <th scope="col">Nombre Encuentador</th>
                    <th scope="col">Firma Productor</th>
                    <th scope="col">Nombre Encuestador</th>
                    <th scope="col">Firma Encuestador</th>
                    <th scope="col">Nombre Supervisor</th>
                    <th scope="col">Firma Supervisor</th>
                    <th scope="col">Estado</th>

                    <th scope="col">Acciones</th> <!-- Added text-center class here -->
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT * FROM tbl_fichas");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->fecha_solicitud ?></td>
                        <td><?= $datos->anio_solicitud?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?= $datos->creado_por ?></td>
                        <td><?= $datos->fecha_creacion?></td>
                        <td><?= $datos->actualizado_por ?></td>
                        <td><?= $datos->fecha_actualizacion?></td>
                        <td><?= $datos->fecha_entrevista?></td>
                        <td><?= $datos->nombre_encuentador?></td>
                        <td><?= $datos->firma_productor?></td>
                        <td><?= $datos->nombre_encuestador?></td>
                        <td><?= $datos->firma_encuestador?></td>
                        <td><?= $datos->nombre_supervisor?></td>
                        <td><?= $datos->firma_supervisor?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_ficha ?>', '<?= $datos->fecha_solicitud ?>', '<?= $datos->anio_solicitud ?>', '<?= $datos->descripcion ?>', '<?= $datos->creado_por ?>', '<?= $datos->fecha_creacion ?>', '<?= $datos->actualizado_por ?>', '<?= $datos->fecha_actualizacion ?>', '<?= $datos->fecha_entrevista ?>', '<?= $datos->nombre_encuentador ?>', '<?= $datos->firma_productor ?>', '<?= $datos->nombre_encuestador ?>', '<?= $datos->firma_encuestador ?>', '<?= $datos->nombre_supervisor ?>', '<?= $datos->firma_supervisor ?>', '<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos/delete_fichas.php" style="display: inline;">
                                <input type="hidden" name="id_ficha" value="<?= $datos->id_ficha ?>">
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
                <form id="formularioEditar" method="POST" action="modelos/update_fichas.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="id_ficha">Id Ficha:</label>
                            <input type="text" class="form-control" id="id_ficha" name="id_ficha" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                            <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="newdescripcion" name="descripcion" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="nombre_encuentador">Nombre Encuentador:</label>
                            <input type="text" class="form-control" id="newnombre_encuentador" name="nombre_encuentador" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="newestado" name="estado" required>
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
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">CREAR FICHA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modelos/insert_fichas.php" method="POST">
                    <div class="row">
                        <div class="col-8">
                        <label for="descripcion">Descripcion:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                        <div class="col-8">
                        <label for="fecha_entrevista">Fecha Entrevista:</label>
                            <input type="date" class="form-control" id="fecha_entrevista" name="fecha_entrevista" required>
                        </div>
                        <div class="col-8">
                            <label for="nombre_encuentador">Nombre Encuentador:</label>
                            <input type="text" class="form-control" id="nombre_encuentador" name="nombre_encuentador" required>
                        </div>
                        <div class="col-8">
                            <label for="firma_productor">Firma Productor:</label>
                            <input type="text" class="form-control" id="firma_productor" name="firma_productor" required>
                        </div>
                        <div class="col-8">
                            <label for="nombre_encuestador">Nombre Encuestador:</label>
                            <input type="text" class="form-control" id="nombre_encuestador" name="nombre_encuestador" required>
                        </div>
                        <div class="col-8">
                            <label for="firma_encuestador">Firma Encuestador:</label>
                            <input type="text" class="form-control" id="firma_encuestador" name="firma_encuestador" required>
                        </div>
                        <div class="col-8">
                            <label for="nombre_supervisor">Nombre Supervisor:</label>
                            <input type="text" class="form-control" id="nombre_supervisor" name="nombre_supervisor" required>
                        </div>
                        <div class="col-8">
                        <label for="firma_supervisor">Firma Supervisor:</label>
                            <input type="text" class="form-control" id="firma_supervisor" name="firma_supervisor" required>
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
    function abrirModalEditar(id_ficha, fecha_solicitud, anio_solicitud, descripcion, creado_por, fecha_creacion, actualizado_por, fecha_actualizacion, fecha_entrevista, nombre_encuentador, firma_productor, nombre_encuestador, firma_encuestador, nombre_supervisor, firma_supervisor, estado) {
        document.getElementById("id_ficha").value = id_ficha;
        document.getElementById("fecha_solicitud").value = fecha_solicitud;
        document.getElementById("anio_solicitud").value = anio_solicitud;
        document.getElementById("newdescripcion").value = descripcion;
        document.getElementById("creado_por").value = creado_por;
        document.getElementById("fecha_creacion").value = fecha_creacion;
        document.getElementById("newactualizado_por").value = actualizado_por;
        document.getElementById("fecha_actualizacion").value = fecha_actualizacion;
        document.getElementById("fecha_entrevista").value = fecha_entrevista;
        document.getElementById("newnombre_encuentador").value = nombre_encuentador;
        document.getElementById("firma_productor").value = firma_productor;
        document.getElementById("nombre_encuestador").value = nombre_encuestador;
        document.getElementById("firma_encuestador").value = firma_encuestador;
        document.getElementById("nombre_supervisor").value = nombre_supervisor;
        document.getElementById("firma_supervisor").value = firma_supervisor;
        document.getElementById("newestado").value = estado;


        $('#modalEditar').modal('show'); // Mostrar el modal de edición
    }
</script>


<!-- Script para mostrar el mensaje al momento de editar un usuario-->
<script>
    $(document).ready(function() {
        $("#formularioEditar").on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "modelos/update_fichas.php",
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