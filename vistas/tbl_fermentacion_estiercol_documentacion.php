<?php 
session_start();
 $_SESSION['url'] = 'vistas/tbl_fermentacion_estiercol.php';
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
            <h1 class="poppins-font mb-2">Fermentación Estiércol Documentación</h1>
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
            <button type="button" class="btn btn-danger" id="pdfButton">PDF</button>
            <button type="button" class="btn btn-success" id="excelButton">EXCEL</button>
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
                    <th scope="col">Id Fermentación estiercol doc.</th>
                    <th scope="col">Id Ficha</th>
                    <th scope="col">Categoria Ficha</th>
                    <th scope="col">Fermentacion</th>
                    <th scope="col">Descripcion Documentacion</th>
                    <th scope="col">URL</th>
                    <th scope="col">Carpeta</th>
                    <th scope="col">Binario</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-center">
            <?php
                include "../php/conexion_be.php";
                $sql = $conexion->query("SELECT tbl_fermentacion_estiercol_documentacion.id_fermentacion_estiercol_documentacion, tbl_fichas.id_ficha, tbl_categorias_fichas.categoria_ficha, tbl_fermentacion_estiercol.id_fermentacion, tbl_fermentacion_estiercol_documentacion.descripcion_documentacion, tbl_fermentacion_estiercol_documentacion.url, tbl_fermentacion_estiercol_documentacion.carpeta, tbl_fermentacion_estiercol_documentacion.binario, tbl_fermentacion_estiercol_documentacion.descripcion, tbl_fermentacion_estiercol_documentacion.estado
                FROM tbl_fermentacion_estiercol_documentacion INNER JOIN tbl_fichas ON tbl_fermentacion_estiercol_documentacion.id_ficha = tbl_fichas.id_ficha 
                INNER JOIN tbl_categorias_fichas ON tbl_fermentacion_estiercol_documentacion.id_categoria_ficha = tbl_categorias_fichas.id_categoria_ficha 
                INNER JOIN tbl_fermentacion_estiercol ON tbl_fermentacion_estiercol_documentacion.id_fermentacion = tbl_fermentacion_estiercol.id_fermentacion");
                while ($datos = $sql->fetch_object()) { ?>
                    <tr>
                        <!--  AQUI PONEN SUS VARIABLES COMO ESTAN EN LA BASE DE DATOS    -->
                        <td><?= $datos->id_fermentacion_estiercol_documentacion ?></td>
                        <td><?= $datos->id_ficha ?></td>
                        <td><?= $datos->categoria_ficha ?></td>
                        <td><?= $datos->id_fermentacion?></td>
                        <td><?= $datos->descripcion_documentacion?></td>
                        <td><?= $datos->url?></td>
                        <td><?= $datos->carpeta?></td>
                        <td><?= $datos->binario?></td>
                        <td><?= $datos->descripcion?></td>
                        <td><?= $datos->estado?></td>
                        <td><?php
                            if ($datos->estado == "ACTIVO") {
                                echo '<span class="badge bg-success">Activo</span>';
                            } else {
                                echo '<span class="badge bg-danger">Inactivo</span>';
                            }
                            ?></td>
                        <td>
                            <button type="button" class="btn btn-editar" data-toggle="modal" data-target="#modalEditar" onclick="abrirModalEditar
                            ('<?= $datos->id_fermentacion_estiercol_doc ?>', <?= $datos->id_ficha ?>', '<?= $datos->categoria_ficha ?>', '<?= $datos->id_fermentacion ?>', '<?= $datos->descripcion_documentacion ?>', '<?= $datos->url ?>', '<?= $datos->carpeta ?>', '<?= $datos->binario ?>', '<?= $datos->descripcion ?>' ,'<?= $datos->estado ?>' )">
                                <i class="bi bi-pencil-square"></i>
                                Editar
                            </button>
                            <form id="deleteForm" method="POST" action="modelos_Doc/delete_fermentacion_estiercol_doc.php" style="display: inline;">
                                <input type="hidden" name="id_fermentacion_estiercol_doc" value="<?= $datos->id_fermentacion_estiercol_doc ?>">
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
        <table>
        <thead class="table-dark text-center" style="background-color: #343A40;">
        <tr>
        <th scope="col">Totales</th>

        </tr>
        </thead>

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
                <form id="formularioEditar" method="POST" action="modelos_Doc/update_fermentacion_estiercol_doc.php">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_fermentacion_estiercol_doc">Id Fermentación Estiercol Doc</label>
                                <input type="text" class="form-control" id="id_fermentacion_estiercol_doc" name="id_fermentacion_estiercol_doc" readonly>
                           </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id_ficha">Id Ficha </label>
                                <select class="form-control" id="id_ficha_edit" name="id_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_ficha FROM tbl_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
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
                                <label for="id_categoria_ficha">Id Categoria Ficha</label>
                                <select class="form-control" id="id_categoria_ficha_edit" name="id_categoria_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_categoria_ficha, categoria_ficha FROM tbl_categorias_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
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
                                <label for="id_fermentacion">Id Fermentación</label>
                                <select class="form-control" id="id_fermentacion_edit" name="id_fermentacion" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles 
        $sql = "SELECT id_fermentacion FROM tbl_fermentacion_estiercol";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_fermentacion"] . '">' . $row["id_fermentacion"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
                            </div>
                        </div>
                    </div>
                  
                            
                    <div class="form-group">
                        <label for="descripcion_documentacion">Descripcion de la documentación:</label>
                        <input type="text" class="form-control" id="descripcion_documentacion_edit" name="descripcion_documentacion" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" class="form-control" id="url_edit" name="url" required>
                    </div>
                    <div class="form-group">
                        <label for="carpeta">Carpeta:</label>
                        <input type="text" class="form-control" id="carpeta_edit" name="carpeta" required>
                    </div>
                    <div class="form-group">
                        <label for="binario">Binario:</label>
                        <input type="text" class="form-control" id="binario_edit" name="binario" required>
                    </div>
                    <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                    </div>
                        
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado_edit" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
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
                <h5 class="poppins-modal mb-2" id="exampleModalLabel">Crear</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="modelos_Doc/insert_fermentacion_estiercol_doc.php" method="POST">
                    <div class="row mb-3">
                        <div class="col">
                        <label for="id_ficha">Id Ficha:</label>
                            <select class="form-control" id="id_ficha" name="id_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_ficha FROM tbl_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_ficha"] . '">' . $row["id_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>
    </div>
    <div class="col">
        <label for="id_categoria_ficha">ID Categoria Ficha:</label>
        <select class="form-control" id="id_categoria_ficha" name="id_categoria_ficha" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_categoria_ficha, categoria_ficha FROM tbl_categorias_fichas";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_categoria_ficha"] . '">' . $row["categoria_ficha"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
            </select>
    </div>
    <div class="col">
        <label for="id_fermentacion">Id Fermentación:</label>
        <select class="form-control" id="id_fermentacion" name="id_fermentacion" required>
        <?php
        // Conexión a la base de datos
        include '../php/conexion_be.php';

        // Consulta SQL para obtener los valores disponibles de ID y Nombre de Departamento
        $sql = "SELECT id_fermentacion FROM tbl_fermentacion_estiercol";

        // Ejecutar la consulta
        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Genera opciones con el nombre del departamento como etiqueta y el ID como valor
                echo '<option value="' . $row["id_fermentacion"] . '">' . $row["id_fermentacion"] . '</option>';
            }
        } else {
            echo '<option value="">No hay campos disponibles</option>';
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
        ?>
    </select>  
                        </div>
                        <div class="col">
                           <label for="descripcion_documentacion">Descripción de la documentación:</label>
                            <input type="text" class="form-control" id="descripcion_documentacion" name="descripcion_documentacion" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL:</label>
                            <input type="text" class="form-control" id="url" name="url" required>
                        </div>
                        <div class="form-group">
                            <label for="carpeta">Carpeta:</label>
                            <input type="text" class="form-control" id="carpeta" name="carpeta" required>
                        </div>
                        <div class="form-group">
                            <label for="binario">Binario:</label>
                            <input type="text" class="form-control" id="binario" name="binario" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado" required>
                            <option value="" disabled selected>Selecciona un estado</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>
                        </div>
                    </div>
                 
                    
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
    function abrirModalEditar(id_fermentacion_estiercol_doc, id_ficha, id_categoria_ficha, id_fermentacion, descripcion_documentacion, url, carpeta, binario, descripcion,estado) {
        document.getElementById("id_fermentacion_estiercol_doc").value = id_fermentacion_estiercol_doc;
        document.getElementById("id_ficha_edit").value = id_ficha;
        document.getElementById("id_categoria_ficha_edit").value = id_categoria_ficha;
        document.getElementById("id_fermentacion_edit").value = id_fermentacion;
        document.getElementById("descripcion_documentacion_edit").value = descripcion_documentacion;
        document.getElementById("url_edit").value = url;
        document.getElementById("carpeta_edit").value = carpeta;
        document.getElementById("binario_edit").value = binario;
        document.getElementById("descripcion_edit").value = descripcion;
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
                url: "modelos_Doc/update_fermentacion_estiercol_doc.php",
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